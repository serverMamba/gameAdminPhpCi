#!/usr/bin/env python
#coding=utf-8

from __future__ import division
import codecs
import sys
import MySQLdb
import datetime
import time

test = 0
previous_days = 1
if len(sys.argv) >= 2:
	previous_days = int(sys.argv[1])

if test == 1:
	hosts = ["127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1"]
	hosts_usergameinfo = ["127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1"]
	host_gamehis = "127.0.0.1"
	host_buyhis = "127.0.0.1"
	host_stat = "127.0.0.1"
	host_stat_write = "127.0.0.1"
else:
	hosts = ["192.168.111.5"]
	hosts_usergameinfo = ["192.168.111.5"]
	host_gamehis = "192.168.111.7"
	host_buyhis = "192.168.111.6"
	host_stat = "192.168.111.5"
	host_stat_write = "192.168.111.5"
	
def get_real_game_code(game_code):
	return game_code
	
def check_table_exists(cursor, table_name):
	sql = "select table_name from information_schema.tables where table_name = '%s'"%(table_name)
	cursor.execute(sql)
	result = cursor.fetchone()
	if not result is None:
		return 1
		
	print "table[%s] not exists"%(table_name)	
	return 0
	
def update_stat(dict_stat, channel_id, field_name, field_value):
	if channel_id in dict_stat:
		channel_stat = dict_stat[channel_id]
		if field_name in channel_stat:
			dict_stat[channel_id][field_name] += field_value
		else:
			dict_stat[channel_id][field_name] = field_value
	else:
		channel_stat = {}
		channel_stat[field_name] = field_value
		dict_stat[channel_id] = channel_stat

def do_single_stat(cursor, set_table_name, sql, channel_id_pos, dict_field_name_pos):
	for table_name in set_table_name:
		if check_table_exists(cursor, table_name) == 0:
			return
			
	# print sql
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		channel_id = int(row[channel_id_pos])
		for field_name in dict_field_name_pos:
			field_pos = dict_field_name_pos[field_name]
			update_stat(dict_stat, channel_id, field_name, row[field_pos])		
		

now_time = datetime.datetime.now()
stat_time = now_time + datetime.timedelta(days = -previous_days)
stat_date = stat_time.strftime("%Y%m%d")



dict_stat = {}
dict_field_name_pos = {}
set_table_name = set()

# 得到水果机抽水
conn = MySQLdb.connect(host=host_gamehis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGAMEHISDB') 
cursor = conn.cursor()

table_name_fruit = "CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_fruit)
sql = "select SUM(l.realwinscore*-1) as fruit_money, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.userid group by c.channel_id"%(table_name_fruit)
dict_field_name_pos.clear()
dict_field_name_pos["fruit_money"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_fruit = "CASINOFRUITMACHINECOMPAREGAMERECORD%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_fruit)
sql = "select SUM(scorebefore - scoreafter) as fruit_compare_money, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.userid group by c.channel_id"%(table_name_fruit)
dict_field_name_pos.clear()
dict_field_name_pos["fruit_compare_money"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

cursor.close		
conn.close


# 最后的运算
updateSql = "";
stat_date = stat_time.strftime("%Y-%m-%d")
for channel_id in dict_stat:
	channel_stat = dict_stat[channel_id]
	for field_name in channel_stat:
		value = channel_stat[field_name]
		# print "channel id[%s], field[%s], value[%s]"%(channel_id, field_name, value)
		updateSql += "update CASINOBUSINESSSTATISTICS set %s=%s where statistics_date='%s' and channelid=%s;"%(field_name, value, stat_date, channel_id)

conn = MySQLdb.connect(host=host_stat_write, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOSTATDB')
cursor = conn.cursor()

print updateSql

cursor.execute(updateSql)
cursor.close()

conn.commit()
conn.close()

