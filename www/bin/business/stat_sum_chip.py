#!/usr/bin/env python
#coding=utf-8

import codecs
import MySQLdb

test = 0
if test == 1:
	host1 = "127.0.0.1"
	host2 = "127.0.0.1"
	hosts = ["127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1","127.0.0.1"]
	host_gamehis = "127.0.0.1"
	host_stat = "127.0.0.1"
else:
	host1 = "192.168.111.5"
	host2 = "192.168.111.6"
	hosts = ["192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6"]
	host_gamehis = "192.168.111.7"
	host_stat = "192.168.111.5"

total_chips = 0
total_coffer_chips = 0


def get_table_data(conn, table_pos):
	cursor = conn.cursor()
	sql="select sum(user_chips) from CASINOUSER_%d where user_email not like 'ygrobot_%%'"%(table_pos)
	cursor.execute(sql)
	result = cursor.fetchone()
	if not result is None:
		global total_chips
		if result[0] != None:
		    total_chips += result[0]
	sql="select sum(cofferchips) from CASINOUSERBAGGAGEINFO_%d"%(table_pos)
	cursor.execute(sql)
	result = cursor.fetchone()
	if not result is None:
		global total_coffer_chips
		if result[0] != None:
		    total_coffer_chips += result[0]
	cursor.close()

def get_db_data(conn, db_pos):
	db_name = "CASINOUSERDB_%d"%db_pos
	conn.select_db(db_name)
	for table_pos in range(0, 16):
		get_table_data(conn, table_pos)

for db_pos in range(0, 16):
	conn = MySQLdb.connect(host=hosts[db_pos], port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx')
	get_db_data(conn, db_pos)
	conn.close()

file_name = "platform_sum_chip.txt"
output = codecs.open(file_name, 'w', 'utf-8')

line = "全部玩家金豆总和(不包括保险箱):%s\r\n"%(total_chips)
output.write(unicode(line, "utf-8"))

line = "全部玩家保险箱金豆总和:%s\r\n"%(total_coffer_chips)
output.write(unicode(line, "utf-8"))	
	
	
conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOSTATDB')
cursor = conn.cursor()
sql = "insert into CASINOSUMCHIPHISTORY (sumchips, sumcofferchips) values (%s, %s)"%(total_chips, total_coffer_chips)
cursor.execute(sql)
conn.commit()
cursor.close()
conn.close()
