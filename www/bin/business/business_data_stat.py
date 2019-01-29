#!/usr/bin/env python
#coding=utf-8

from __future__ import division
import codecs
import sys
import MySQLdb
import datetime
import time

previous_days = 1
if len(sys.argv) >= 2:
	previous_days = int(sys.argv[1])

mainDB1 = "192.168.111.5"
mainDB1_slave = "192.168.111.5"
mainDB2 = "192.168.111.6"
mainDB2_slave = "192.168.111.6"
hisDB = "192.168.111.7"
hisDB_slave = "192.168.111.7"

if False:
    mainDB1 = "54.179.168.6"
    mainDB1_slave = "54.179.168.6"
    mainDB2 = "127.0.0.1"
    mainDB2_slave = "127.0.0.1"
    hisDB = "127.0.0.1"
    hisDB_slave = "127.0.0.1"

hosts = [mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1, mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2]
hosts_usergameinfo = [mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1, mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2]
host_gamehis = hisDB
host_buyhis = mainDB2
host_stat = mainDB1_slave
host_stat_write = mainDB1
	
def get_real_game_code(game_code):
	return game_code
	
def check_table_exists(cursor, table_name):
	sql = "select table_name from information_schema.tables where table_name = '%s'"%(table_name)
	cursor.execute(sql)
	result = cursor.fetchone()
	if not result is None:
		return 1
		
	#print "table[%s] not exists"%(table_name)	
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
			
	#print sql
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

stat_time_1day_before = now_time + datetime.timedelta(days = -(previous_days + 1))
stat_date_1day_before = stat_time_1day_before.strftime("%Y%m%d")

stat_time_7day_before = now_time + datetime.timedelta(days = -(previous_days + 7))
stat_date_7day_before = stat_time_7day_before.strftime("%Y%m%d")


dict_stat = {}
dict_field_name_pos = {}
set_table_name = set()

conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOSTATDB')
cursor = conn.cursor()

stat_date_yesterday = stat_time_1day_before.strftime("%Y-%m-%d")

table_name = "CASINOBUSINESSSTATISTICS"
sql = "select total_user_count, channelid from %s where statistics_date = '%s'"%(table_name, stat_date_yesterday)
set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["total_user_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)
cursor.close
conn.close		

conn = MySQLdb.connect(host=host_gamehis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGAMEHISDB')	
cursor = conn.cursor()


table_name_login = "CASINOLOGINHISTORY%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_login)
sql = "select count(distinct loginmac) as maccount, count(distinct userid) as count, channelid from %s group by channelid"%(table_name_login)
dict_field_name_pos.clear()
dict_field_name_pos["active_device_count"] = 0
dict_field_name_pos["active_user_count"] = 1
do_single_stat(cursor, set_table_name, sql, 2, dict_field_name_pos)
	
table_name_register_1day_before = "CASINOREGISTERHISTORY%s"%(stat_date_1day_before)
set_table_name.clear()
set_table_name.add(table_name_login)
set_table_name.add(table_name_register_1day_before)
sql = "select count(distinct registermac) as count, channelid from %s as registable where registable.newdevice = 1 and exists(select * from %s as logintable where logintable.loginmac = registable.registermac) group by channelid"%(table_name_register_1day_before, table_name_login)
dict_field_name_pos.clear()
dict_field_name_pos["retention_lastday_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_register_7day_before = "CASINOREGISTERHISTORY%s"%(stat_date_7day_before)
set_table_name.clear()
set_table_name.add(table_name_login)
set_table_name.add(table_name_register_7day_before)
sql = "select count(distinct registermac) as count, channelid from %s as registable where registable.newdevice = 1 and exists(select * from %s as logintable where logintable.loginmac = registable.registermac) group by channelid"%(table_name_register_7day_before, table_name_login)
dict_field_name_pos.clear()
dict_field_name_pos["retention_7day_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_register = "CASINOREGISTERHISTORY%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_register)
sql = "select count(*) as count, channelid from %s group by channelid"%(table_name_register)
dict_field_name_pos.clear()
dict_field_name_pos["new_user_count"] = 0
dict_field_name_pos["total_user_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

set_table_name.clear()
set_table_name.add(table_name_register)
sql = "select count(*) as count, channelid from %s where newdevice = 1 group by channelid"%(table_name_register)
dict_field_name_pos.clear()
dict_field_name_pos["new_device_count"] = 0
dict_field_name_pos["new_realuser_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

set_table_name.clear()
set_table_name.add(table_name_register)
sql = "select count(*) as count, channelid from %s where guest = 1 group by channelid"%(table_name_register)
dict_field_name_pos.clear()
dict_field_name_pos["new_guest_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_gamehis = "CASINOGAMEHISTORY%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_register)
set_table_name.add(table_name_gamehis)
sql = "select count(distinct userid) as count, channelid from %s as regishis where newdevice = 1 and exists (select * from %s as gamehis where eventtype in (1, 2) and gamehis.userid = regishis.userid) group by channelid"%(table_name_register, table_name_gamehis)
dict_field_name_pos.clear()
dict_field_name_pos["new_playgame_user_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_ddz = "CASINOGAMERECORD_DDZ_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_ddz)
sql = "select SUM(l.earn_score) as ddz_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id WHERE l.room_id > 0 group by c.channel_id"%(table_name_ddz)
dict_field_name_pos.clear()
dict_field_name_pos["ddz_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_ddz = "CASINOGAMERECORD_DDZHUANLE_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_ddz)
sql = "select SUM(l.earn_score) as huanle_ddz_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_ddz)
dict_field_name_pos.clear()
dict_field_name_pos["huanle_ddz_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_ddz = "CASINOGAMERECORD_DDZLAIZI_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_ddz)
sql = "select SUM(l.earn_score) as laizi_ddz_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_ddz)
dict_field_name_pos.clear()
dict_field_name_pos["laizi_ddz_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_zjh = "CASINOGAMERECORD_ZJH_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_zjh)
sql = "select SUM(l.earn_score) as zjh_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_zjh)
dict_field_name_pos.clear()
dict_field_name_pos["zjh_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_zjh = "CASINOGAMERECORD_BaiRenZhaJinHua_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_zjh)
sql = "select SUM(l.earn_score) as zjh_bairen_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_zjh)
dict_field_name_pos.clear()
dict_field_name_pos["zjh_bairen_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_hongheidz = "CASINOGAMERECORD_BaiRenZhaJinHuaRB_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_hongheidz)
sql = "select SUM(l.earn_score) as hongheidz_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_hongheidz)
dict_field_name_pos.clear()
dict_field_name_pos["hongheidz_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

table_name_niuniu = "CASINOGAMERECORD_NiuNiuQiangZhuang_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_niuniu)
sql = "select SUM(l.earn_score) as niuniu_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_niuniu)
dict_field_name_pos.clear()
dict_field_name_pos["niuniu_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_niuniuml = "CASINOGAMERECORD_NiuNiuMalai_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_niuniuml)
sql = "select SUM(l.earn_score) as malai_niuniu_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_niuniuml)
dict_field_name_pos.clear()
dict_field_name_pos["malai_niuniu_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_sangong = "CASINOGAMERECORD_SG_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_sangong)
sql = "select SUM(l.earn_score) as sangong_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_sangong)
dict_field_name_pos.clear()
dict_field_name_pos["sangong_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 


table_name_niuniu = "CASINOGAMERECORD_NiuNiuSeenCardQZ_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_niuniu)
sql = "select SUM(l.earn_score) as qiangzhuang_niuniu_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id group by c.channel_id"%(table_name_niuniu)
dict_field_name_pos.clear()
dict_field_name_pos["qiangzhuang_niuniu_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

table_name_buyu = "CASINOFISHINGENTERLEAVERECORD%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_buyu)
sql = "select SUM(l.earnscore*-1) as buyu_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.userid group by c.channel_id"%(table_name_buyu)
dict_field_name_pos.clear()
dict_field_name_pos["buyu_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 

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

table_name_bao = "CASINOTREASUREHUNTGAMERECORD%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_bao)
sql = "select SUM(l.costitemcountbefore-l.rewarditemcountafter) as bao_money, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.userid group by c.channel_id"%(table_name_bao)
dict_field_name_pos.clear()
dict_field_name_pos["bao_money"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

# 连环炮
'''
table_name_lhp = "CASINOGAMERECORD_LHP_%s"%(stat_date)
set_table_name.clear()
set_table_name.add(table_name_lhp)
sql = "select (0 - sum(l.goldchange)) as lhp_choushui, c.channel_id from %s l join CASINOUSERCHANNEL c on c.user_id = l.user_id WHERE goldchange != 0 group by c.channel_id"%(table_name_lhp)
dict_field_name_pos.clear()
dict_field_name_pos["lhp_choushui"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos) 
'''

dict_active_user_7_day = {}
dict_active_device_7_day = {}
for i in range(0, 7):
	stat_time_temp = stat_time + datetime.timedelta(days = -i)
	stat_date_temp = stat_time_temp.strftime("%Y%m%d")
	#print now_time
	table_name_temp = "CASINOLOGINHISTORY%s"%(stat_date_temp)
	if check_table_exists(cursor, table_name_temp) == 0:
		continue
	
	sql = "select distinct(userid) as userid, channelid from %s"%(table_name_temp)
	print sql
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		user_id = row[0]
		channel_id = row[1]
		if channel_id in dict_active_user_7_day:
			set_channel = dict_active_user_7_day[channel_id]
			dict_active_user_7_day[channel_id].add(user_id)
		else:
			set_channel = set()
			set_channel.add(user_id)
			dict_active_user_7_day[channel_id] = set_channel
	
	sql = "select distinct(loginmac) as device, channelid from %s"%(table_name_temp);
	print sql
	cursor.execute(sql)
	records = cursor.fetchall()	
	for row in records:
		device = row[0]
		channel_id = row[1]
		if channel_id in dict_active_device_7_day:
			set_channel = dict_active_device_7_day[channel_id]
			dict_active_device_7_day[channel_id].add(device)
		else:
			set_channel = set()
			set_channel.add(device)
			dict_active_device_7_day[channel_id] = set_channel
	
for channel_id in dict_active_user_7_day:
    set_channel = dict_active_user_7_day[channel_id]
    #print str(channel_id) + "---" + str(len(set_channel))
    update_stat(dict_stat, channel_id, "active_user_7day_count", len(set_channel))
			
for channel_id in dict_active_device_7_day:
	set_channel = dict_active_device_7_day[channel_id]
	update_stat(dict_stat, channel_id, "active_device_7day_count", len(set_channel))			

cursor.close
conn.close

if previous_days>0:
	print ">>>>>>>>>>>>>>>>";
	conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOSTATDB')
	cursor = conn.cursor()
	table_name = "CASINOPAYTOTALSTATISTICS"
	sql = "SELECT sum(pay_total_money) as pay_total_money,channelid  as channel_id from "+table_name+" where statistics_date>='"+ stat_time.strftime("%Y-%m-%d") + ' 00:00:00'+"' and statistics_date<='"+stat_time.strftime("%Y-%m-%d") + ' 23:59:59'+"' GROUP BY channelid" 
	set_table_name.clear()
	set_table_name.add(table_name)
	dict_field_name_pos.clear()
	dict_field_name_pos["pay_total_money"] = 0
	do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)
	cursor.close		
	conn.close


conn = MySQLdb.connect(host=host_buyhis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='db_smc')
cursor = conn.cursor()
year = stat_time.timetuple()[0]
month = stat_time.timetuple()[1]
pay_stat_date = stat_time.strftime("%Y%m%d")
'''
table_name = "smc_log_order"
sql = "select channel_id,SUM(choushui_money) AS choushui_money from %s where date1 = '%s' AND channel_id > 0 group by channel_id"%(table_name, pay_stat_date)

set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["choushui_money"] = 1
do_single_stat(cursor, set_table_name, sql, 0, dict_field_name_pos)
'''

today_time = int(time.mktime(time.strptime(pay_stat_date + ' 00:00:00', '%Y%m%d %H:%M:%S')))
today_time_end = int(time.mktime(time.strptime(pay_stat_date + ' 00:00:00', '%Y%m%d %H:%M:%S'))) + 3600*24

table_name = "smc_order"
if previous_days<=0:
	print "=========================";
	sql = "SELECT SUM(money) AS pay_total_money,channel_id FROM %s WHERE status = 1 AND add_time >= %s AND add_time < %s GROUP BY channel_id"%(table_name, today_time,today_time_end)
	set_table_name.clear()
	set_table_name.add(table_name)
	dict_field_name_pos.clear()
	dict_field_name_pos["pay_total_money"] = 0
	do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

#总付费用户
sql = "SELECT count(distinct(user_id)) AS pay_user_count,channel_id FROM %s WHERE status = 1 AND add_time >= %s AND add_time < %s GROUP BY channel_id"%(table_name, today_time,today_time_end)
set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["pay_user_count"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

sql = "SELECT count(id) AS pay_total_num,channel_id FROM %s WHERE status = 1 AND add_time >= %s AND add_time < %s GROUP BY channel_id"%(table_name, today_time,today_time_end)
set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["pay_total_num"] = 0
do_single_stat(cursor, set_table_name, sql, 1, dict_field_name_pos)

today_time = int(time.mktime(time.strptime(pay_stat_date + ' 00:00:00', '%Y%m%d %H:%M:%S')))
today_time_end = int(time.mktime(time.strptime(pay_stat_date + ' 23:59:59', '%Y%m%d %H:%M:%S')))

table_name = "smc_cash_order"
sql = "SELECT SUM(cash_money) AS cash_money,SUM(cash_money - real_cash_money) AS choushui_money, sum(alifee) as alifee, channel_id, SUM(cash_send_money) AS cash_send_money FROM %s WHERE status = 1 AND update_time >= %s AND update_time <= %s GROUP BY channel_id"%(table_name, today_time,today_time_end)
print "--------------------------------"+sql
set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["cash_money"] = 0
dict_field_name_pos["choushui_money"] = 1
dict_field_name_pos["alifee"] = 2
dict_field_name_pos["cash_send_money"] = 4
do_single_stat(cursor, set_table_name, sql, 3, dict_field_name_pos)

cursor.close
conn.close

conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='db_smc')
cursor = conn.cursor()
year = stat_time.timetuple()[0]
month = stat_time.timetuple()[1]
pay_stat_date = stat_time.strftime("%Y%m%d")
today_time = int(time.mktime(time.strptime(pay_stat_date + ' 00:00:00', '%Y%m%d %H:%M:%S')))
today_time_end_old = int(time.mktime(time.strptime(pay_stat_date + ' 00:00:00', '%Y%m%d %H:%M:%S'))) + 3600*24
today_time_end = int(time.mktime(time.strptime(pay_stat_date + ' 23:59:59', '%Y%m%d %H:%M:%S')))

table_name = "smc_cash_order"
sql = "SELECT SUM(cash_money) AS cash_money1,SUM(cash_money - real_cash_money) AS choushui_money1, sum(alifee) as alifee1, channel_id, SUM(cash_send_money) AS cash_send_money1 FROM %s WHERE status = 1 AND update_time >= %s AND update_time <= %s GROUP BY channel_id"%(table_name, today_time,today_time_end)

set_table_name.clear()
set_table_name.add(table_name)
dict_field_name_pos.clear()
dict_field_name_pos["cash_money1"] = 0
dict_field_name_pos["choushui_money1"] = 1
dict_field_name_pos["alifee1"] = 2
dict_field_name_pos["cash_send_money1"] = 4
do_single_stat(cursor, set_table_name, sql, 3, dict_field_name_pos)

cursor.close
conn.close



set_field_name = set()
for channel_id in dict_stat:
	channel_stat = dict_stat[channel_id]
	for field_name in channel_stat:
		value = channel_stat[field_name]
		print "channel id[%s], field[%s], value[%s]"%(channel_id, field_name, value)
		set_field_name.add(field_name)

insert_params = "(statistics_date, channelid"
insert_values = " values( %s, %s"		
for field_name in set_field_name:
	insert_params = "%s, %s"%(insert_params, field_name)
	insert_values = "%s, %%s"%(insert_values)
insert_params = "%s) %s)"%(insert_params, insert_values)


stat_date = stat_time.strftime("%Y-%m-%d")
insert_info = []	
for channel_id in dict_stat:
	channel_stat = dict_stat[channel_id]
	single_info = []
	single_info.append(stat_date)
	single_info.append(channel_id)
		
	for field_name in set_field_name:
		if field_name in channel_stat:
			value = channel_stat[field_name]
		else:
			value = 0
		single_info.append(value)
	single_info_tuple = tuple(single_info)
	insert_info.append(single_info_tuple)
	print single_info_tuple

conn = MySQLdb.connect(host=host_stat_write, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOSTATDB')
cursor = conn.cursor()
sql = "delete from CASINOBUSINESSSTATISTICS where statistics_date = '%s'"%(stat_date)
cursor.execute(sql)
conn.commit()

sql = "insert into CASINOBUSINESSSTATISTICS %s"%(insert_params)
print sql
print insert_info

#sys.exit();
cursor.executemany(sql, insert_info)

conn.commit()
cursor.close
conn.close()
