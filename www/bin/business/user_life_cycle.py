#!/usr/bin/env python
#coding=utf-8

from __future__ import division
import codecs
import sys
import MySQLdb
import datetime
import time

test = 0
year = 2016
month = 1
day = 1
if len(sys.argv) >= 4:
	year = int(sys.argv[1])
	month = int(sys.argv[2])
	day = int(sys.argv[3])
else:
	print "input params: year month day"
	sys.exit()
	
	
if test == 1:
	hosts = ["127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1"]
	host_gamehis = "127.0.0.1"
	host_buyhis = "127.0.0.1"
	host_stat = "127.0.0.1"
	host_stat_write = "127.0.0.1"
else:
	hosts = ["54.169.16.158"]
	host_gamehis = "54.169.16.158"
	host_buyhis = "54.169.16.158"
	host_stat = "54.169.16.158"
	host_stat_write = "54.169.16.158"
	
	
def check_table_exists(cursor, table_name):
	sql = "select table_name from information_schema.tables where table_name = '%s'"%(table_name)
	cursor.execute(sql)
	result = cursor.fetchone()
	if not result is None:
		return 1
		
	print "table[%s] not exists"%(table_name)	
	return 0
	
	
dict_user_pay = {}
dict_user_game_code = {}
dict_user_channel_id = {}	
	
conn = MySQLdb.connect(host=host_buyhis, port=3306, user='coffee', passwd='coffee123456', db='CASINOBUYHISDB')
cursor = conn.cursor()
table_name = "CASINOTABLECUSTOMPAYORDER%s_%s"%(year, month)
date = "%04d-%02d-%02d"%(year, month, day)
sql = "select userid, sum(realmoney) as paymoney, gamecode, channel from %s where callbacktime >= '%s 00:00:00' and callbacktime <= '%s 23:59:59' group by userid"%(table_name, date, date)
print sql
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	user_id = row[0]
	pay = row[1]
	game_code = row[2]
	channel_id = row[3]
	dict_user_pay[user_id] = pay
	dict_user_game_code[user_id] = game_code
	dict_user_channel_id[user_id] = channel_id
cursor.close()
conn.close


dict_user_register_year = {}
dict_user_register_month = {}

def get_user_pos(user_id):
	user_id = 0xFF & user_id;
	db_pos = (user_id & 0xF0) >> 4
	table_pos = (user_id & 0x0F)
	return (db_pos, table_pos)
	
	
def update_user_pos_dict(dict_pos, db_pos, table_pos, user_id):
	if db_pos in dict_pos:
		if table_pos in dict_pos[db_pos]:
			dict_pos[db_pos][table_pos].add(user_id)
		else:
			set_table = set()
			set_table.add(user_id)
			dict_pos[db_pos][table_pos] = set_table
	else:
		dict_db = {}
		set_table = set()
		set_table.add(user_id)	
		dict_db[table_pos] = set_table
		dict_pos[db_pos] = dict_db

def get_user_table_pos(conn, dict_pos, table_pos, set_user):
	cursor = conn.cursor()
	table_name = "CASINOUSER2ACCOUNT_%d"%(table_pos)
	sql = "select userid, dbindex, tableindex from %s where userid in ("%(table_name)
	for user_id in set_user:
		sql = "%s%d,"%(sql, user_id)
	sql = sql[:-1]
	sql = "%s)"%(sql)

	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:		
		update_user_pos_dict(dict_pos, row[1], row[2], row[0])
	cursor.close()	
	
def get_table_data(conn, table_pos, set_user):
	cursor = conn.cursor()
	sql = "select id, year(registertime) as registeryear, month(registertime) as registermonth from CASINOUSER_%d where id in ("%(table_pos)
	for user_id in set_user:
		sql = "%s%d,"%(sql, user_id)
	sql = sql[:-1]
	sql = "%s)"%(sql)
	
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		user_id = row[0]
		dict_user_register_year[user_id] = row[1]
		dict_user_register_month[user_id] = row[2]
	
dict_user2account = {}
for user_id in dict_user_pay:
	(db_pos, table_pos) = get_user_pos(user_id)
	update_user_pos_dict(dict_user2account, db_pos, table_pos, user_id)

dict_usertable = {}
for db_pos in dict_user2account:
	conn = MySQLdb.connect(host=hosts[db_pos], port=3306, user='coffee', passwd='coffee123456')
	db_name = "CASINOUSERDB_%d"%db_pos
	conn.select_db(db_name)
	for table_pos in dict_user2account[db_pos]:
		get_user_table_pos(conn, dict_usertable, table_pos, dict_user2account[db_pos][table_pos])
	conn.close()


for db_pos in dict_usertable:
	conn = MySQLdb.connect(host=hosts[db_pos], port=3306, user='coffee', passwd='coffee123456')
	db_name = "CASINOUSERDB_%d"%db_pos
	conn.select_db(db_name)
	for table_pos in dict_usertable[db_pos]:
		get_table_data(conn, table_pos, dict_usertable[db_pos][table_pos])

	conn.close()
	
dict_pay_stat = {}
for user_id in dict_user_register_year:
	register_year = dict_user_register_year[user_id]
	register_month = dict_user_register_month[user_id]
	game_code = dict_user_game_code[user_id]
	channel_id = dict_user_channel_id[user_id]
	pay = dict_user_pay[user_id]
	if register_year in dict_pay_stat:
		dict_year = dict_pay_stat[register_year]
		if register_month in dict_year:
			dict_month = dict_year[register_month]
			if game_code in dict_month:
				dict_game = dict_month[game_code]
				if channel_id in dict_game:
					dict_pay_stat[register_year][register_month][game_code][channel_id] += pay
				else:
					dict_pay_stat[register_year][register_month][game_code][channel_id] = pay
			else:
				dict_game = {}
				dict_game[channel_id] = pay
				dict_pay_stat[register_year][register_month][game_code] = dict_game
		else:
			dict_game = {}
			dict_game[channel_id] = pay
			dict_month = {}
			dict_month[game_code] = dict_game
			dict_pay_stat[register_year][register_month] = dict_month
	else:
		dict_game = {}
		dict_game[channel_id] = pay
		dict_month = {}
		dict_month[game_code] = dict_game
		dict_year = {}
		dict_year[register_month] = dict_month
		dict_pay_stat[register_year] = dict_year
		
conn = MySQLdb.connect(host=host_stat_write, port=3306, user='coffee', passwd='coffee123456', db='CASINOSTATDB')
cursor = conn.cursor()		
		
pay_month_first_date = "%04d-%02d-01"%(year, month)		
for register_year in dict_pay_stat:
	dict_year = dict_pay_stat[register_year]
	for register_month in dict_year:
		dict_month = dict_year[register_month]
		register_date = "%04d-%02d-01"%(register_year, register_month)
		for game_code in dict_month:
			dict_game = dict_month[game_code]
			for channel_id in dict_game:
				sql = "select pay_month_first_date from CASINOUSERLIFECYCLESTATISTICS where pay_month_first_date = '%s' and register_month_first_date = '%s' and gamecode = %s and channelid = %s"%(pay_month_first_date, register_date, game_code, channel_id)
				print sql
				cursor.execute(sql)
				result = cursor.fetchone()
				if not result is None:
					sql = "update CASINOUSERLIFECYCLESTATISTICS set pay_total_money = pay_total_money + %d, pay_total_money_oldclient = pay_total_money_oldclient + %d where pay_month_first_date = '%s' and register_month_first_date = '%s' and gamecode = %s and channelid = %s"%(pay, pay, pay_month_first_date, register_date, game_code, channel_id)
					print sql
					cursor.execute(sql)
				else:
					sql = "insert into CASINOUSERLIFECYCLESTATISTICS (pay_month_first_date, register_month_first_date, gamecode, channelid, pay_total_money, pay_total_money_oldclient) values ('%s', '%s', %s, %s, %s, %s)"%(pay_month_first_date, register_date, game_code, channel_id, pay, pay)
					print sql
					cursor.execute(sql)
				conn.commit()
cursor.close()
conn.close()				
