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

host_gamehis = "192.168.111.7"
host_global = "192.168.111.6"
host_stat = "192.168.111.5"
hosts_usergameinfo = ["192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6"]

stat_items = []

now_time = datetime.datetime.now()
stat_time = now_time + datetime.timedelta(days = -previous_days)
stat_date = stat_time.strftime("%Y%m%d")

stat_time_1day_before = now_time + datetime.timedelta(days = -(previous_days + 1))
stat_date_1day_before = stat_time_1day_before.strftime("%Y%m%d")

#在线人数
dict_room_name = {}
dict_room_name[1] = "水果机"
dict_room_name[2] = "寻宝"

dict_room_item_id = {}
dict_room_item_id[1] = 1
dict_room_item_id[2] = 2

dict_room_user_max_count = {}


stat_online_date = stat_time.strftime("%Y-%m-%d")
conn = MySQLdb.connect(host=host_global, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGLOBALINFO')
sql = "select roomid, max(count) from (select sum(roomusercount) count, roomid, statistics_time from CASINODETAILONLINESTATISTICS where statistics_time >= '%s 00:00:00' and statistics_time <= '%s 23:59:59' and gameserverport = 9107 group by statistics_time, roomid) online group by roomid"%(stat_online_date, stat_online_date)
cursor = conn.cursor()
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	dict_room_user_max_count[row[0]] = row[1]

for room_id in dict_room_name:
	room_user_max_count = 0
	if room_id in dict_room_user_max_count:
		room_user_max_count = dict_room_user_max_count[room_id]
		if room_id in dict_room_item_id:
			stat_items.append((stat_date, dict_room_item_id[room_id], room_user_max_count))
	
cursor.close()
conn.close()

#首次游戏玩家
set_firstgame_user = set()
set_firstgame_user_1day_before = set()

today = datetime.date.today()
today_timestamp = int(time.mktime(today.timetuple()))
stat_begin_timestamp = today_timestamp - previous_days * 24 * 3600
stat_end_timestamp = stat_begin_timestamp + 24 * 3600
stat_yesterday_begin_timestamp = stat_begin_timestamp - 24 * 3600
stat_yesterday_end_timestamp = stat_begin_timestamp	
def get_table_data_first_game(conn, table_pos, game_type):
	cursor = conn.cursor()
	
	sql = "select userid, unix_timestamp(firstgametime) from CASINOUSERGAMEINFO_%d where gametype = %d"%(table_pos, game_type)
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		userid = row[0]
		firsttimestamp = row[1]
		if firsttimestamp >= stat_begin_timestamp and firsttimestamp < stat_end_timestamp:
			set_firstgame_user.add(userid)
		if firsttimestamp >= stat_yesterday_begin_timestamp and firsttimestamp < stat_yesterday_end_timestamp:
			set_firstgame_user_1day_before.add(userid)

def get_db_data(conn, db_pos):
	db_name = "CASINOUSERDB_%d"%db_pos
	conn.select_db(db_name)
	for table_pos in range(0, 16):
		get_table_data_first_game(conn, table_pos, 28901)

for db_pos in range(0, 16):
	conn = MySQLdb.connect(host=hosts_usergameinfo[db_pos], port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx')
	get_db_data(conn, db_pos)
	conn.close()



conn = MySQLdb.connect(host=host_gamehis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGAMEHISDB')

def get_single_stat_value(conn, sql):
	print sql
	cursor = conn.cursor()
	cursor.execute(sql)
	result = cursor.fetchone()
	cursor.close()
	if not result is None:
		if not result[0] is None:
			return result[0]
	
	return 0
	
def get_user_set(conn, sql, set_result):
	cursor = conn.cursor()
	cursor.execute(sql)	
	records = cursor.fetchall()
	for row in records:
		set_result.add(row[0])
	cursor.close()
	
def check_table_exists(conn, table_name):
	cursor = conn.cursor()
	sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES where TABLE_NAME = '%s'"%(table_name)
	cursor.execute(sql)
	result = cursor.fetchone()
	cursor.close()
	if not result is None:
		return 1
	return 0
	
set_game_user = set()
set_game_user_1day_before = set()

sql = "select distinct userid from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
get_user_set(conn, sql, set_game_user)

# 判断前一天的日志表存不存在
if check_table_exists(conn,"CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date_1day_before)) == 1:
	sql = "select distinct userid from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date_1day_before)
	get_user_set(conn, sql, set_game_user_1day_before)


fruit_normal_game_count = 0;
fruit_compare_game_count = 0;
fruit_total_playscore = 0;
fruit_total_winscore = 0;
if check_table_exists(conn,"CASINOFRUITMACHINENORMALGAMERECORD"+stat_date) == 1:
    sql = "select count(*) from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
    fruit_normal_game_count = get_single_stat_value(conn, sql)

if check_table_exists(conn,"CASINOFRUITMACHINECOMPAREGAMERECORD"+stat_date) == 1:
    sql = "select count(*) from CASINOFRUITMACHINECOMPAREGAMERECORD%s"%(stat_date)
    fruit_compare_game_count = get_single_stat_value(conn, sql)

if check_table_exists(conn,"CASINOFRUITMACHINENORMALGAMERECORD"+stat_date) == 1:
    sql = "select sum(totalbetscore) from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
    fruit_total_playscore = get_single_stat_value(conn, sql)
    sql = "select sum(winscore) from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
    fruit_total_winscore = get_single_stat_value(conn, sql)

fruit_total_systemwinscore = 0
if check_table_exists(conn,"CASINOFRUITMACHINENORMALGAMERECORD"+stat_date) == 1:
    sql = "select sum(scorebefore - scoreafter) from CASINOFRUITMACHINENORMALGAMERECORD%s"%(stat_date)
    fruit_total_systemwinscore += get_single_stat_value(conn, sql)
    
if check_table_exists(conn,"CASINOFRUITMACHINECOMPAREGAMERECORD"+stat_date) == 1:
    sql = "select sum(scorebefore - scoreafter) from CASINOFRUITMACHINECOMPAREGAMERECORD%s"%(stat_date)
    fruit_total_systemwinscore += get_single_stat_value(conn, sql)


fruit_game_user_count = len(set_game_user)
fruit_game_1day_retain_user_count = len(set_game_user_1day_before & set_game_user)
fruit_first_game_user_count = len(set_firstgame_user)
fruit_first_game_1day_retain_user_count = len(set_firstgame_user_1day_before & set_game_user)

fruit_first_game_1day_user_count = len(set_firstgame_user_1day_before)
if fruit_first_game_1day_user_count != 0:
	retain_game_1day_rate = 100 * fruit_first_game_1day_retain_user_count / fruit_first_game_1day_user_count
	retain_game_1day_rate_display = "%.2f%%"%(retain_game_1day_rate)
else:
	retain_game_1day_rate_display = "-"
	
average_game_count = fruit_normal_game_count / fruit_game_user_count
average_game_count_display = "%.2f"%(average_game_count)
dau_without_new = fruit_game_user_count - fruit_first_game_user_count

stat_items.append((stat_date, 3, format(fruit_game_user_count, ',')))
stat_items.append((stat_date_1day_before, 4, format(fruit_game_1day_retain_user_count, ',')))
stat_items.append((stat_date, 5, format(fruit_first_game_user_count, ',')))
stat_items.append((stat_date_1day_before, 6, format(fruit_first_game_1day_retain_user_count, ',')))
stat_items.append((stat_date_1day_before, 7, retain_game_1day_rate_display))
stat_items.append((stat_date, 8, format(fruit_normal_game_count, ',')))
stat_items.append((stat_date, 9, average_game_count_display))
stat_items.append((stat_date, 10, format(fruit_compare_game_count, ',')))
stat_items.append((stat_date, 11, format(fruit_total_playscore, ',')))
stat_items.append((stat_date, 12, format(fruit_total_winscore, ',')))
stat_items.append((stat_date, 13, format(fruit_total_systemwinscore, ',')))
stat_items.append((stat_date, 30, format(dau_without_new, ',')))


#dict_item_type_name = {}
#dict_item_type_name[1] = "金豆"
#dict_item_type_name[2] = "钻石"
#dict_item_type_name[3] = "银宝盒"
#dict_item_type_name[4] = "金宝盒"
#dict_item_type_name[5] = "兑奖券"
#dict_item_type_name[6] = "小喇叭"
#dict_item_type_name[7] = "补签卡"


def stat_treasurehunt(conn, stat_date, cost_item_type, array_stat_item_id, dict_reward_stat_item_id):
    game_count = 0;
    player_count = 0;
    cost_item_count = 0;
    if check_table_exists(conn,"CASINOTREASUREHUNTGAMERECORD"+stat_date) == 1:
	    sql = "select count(*) from CASINOTREASUREHUNTGAMERECORD%s where costitemtype = %d"%(stat_date, cost_item_type)
	    game_count = get_single_stat_value(conn, sql)
	    sql = "select count(distinct userid) from CASINOTREASUREHUNTGAMERECORD%s where costitemtype = %d"%(stat_date, cost_item_type)
	    player_count = get_single_stat_value(conn, sql) 
	    sql = "select sum(costitemcount) from CASINOTREASUREHUNTGAMERECORD%s where costitemtype = %d"%(stat_date, cost_item_type)
	    cost_item_count = get_single_stat_value(conn, sql)
	    
    stat_items.append((stat_date, array_stat_item_id[0], format(game_count, ',')))
    stat_items.append((stat_date, array_stat_item_id[1], format(player_count, ',')))
    stat_items.append((stat_date, array_stat_item_id[2], format(cost_item_count, ',')))
	
    dict_item_count = {}
    if check_table_exists(conn,"CASINOTREASUREHUNTGAMERECORD"+stat_date) == 1:
        sql = "select rewarditemtype, sum(rewarditemcount) from CASINOTREASUREHUNTGAMERECORD%s where costitemtype = %d group by rewarditemtype"%(stat_date, cost_item_type)
        cursor = conn.cursor()
        cursor.execute(sql)
        records = cursor.fetchall()
        for row in records:
	        dict_item_count[row[0]] = row[1]
        cursor.close()
	
        for item_type in dict_reward_stat_item_id:
	        item_count = 0
	        if item_type in dict_item_count:
		        item_count = dict_item_count[item_type]

	        stat_items.append((stat_date, dict_reward_stat_item_id[item_type], format(item_count, ',')))

dict_common_stat_item_id = {}
dict_common_stat_item_id[1] = [14, 15, 16]
dict_common_stat_item_id[5] = [17, 18, 19]

dict_cost_item_reward_stat_item_id = {}
dict_cost_item_reward_stat_item_id[1] = {}
dict_cost_item_reward_stat_item_id[1][1] = 20
dict_cost_item_reward_stat_item_id[1][2] = 21
dict_cost_item_reward_stat_item_id[1][3] = 22
dict_cost_item_reward_stat_item_id[1][4] = 23
dict_cost_item_reward_stat_item_id[1][5] = 24
dict_cost_item_reward_stat_item_id[5] = {}
dict_cost_item_reward_stat_item_id[5][1] = 25
dict_cost_item_reward_stat_item_id[5][2] = 26
dict_cost_item_reward_stat_item_id[5][3] = 27
dict_cost_item_reward_stat_item_id[5][4] = 28
dict_cost_item_reward_stat_item_id[5][5] = 29

stat_treasurehunt(conn, stat_date, 1, dict_common_stat_item_id[1], dict_cost_item_reward_stat_item_id[1])
stat_treasurehunt(conn, stat_date, 5, dict_common_stat_item_id[5], dict_cost_item_reward_stat_item_id[5])			
conn.close()


conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', charset="utf8", db='CASINOSTATDB')
cursor = conn.cursor()

sql = "delete from CASINOVIDEOARCADESTAT where statistics_date = '%s'"%(stat_date)
cursor.execute(sql)

sql = "delete from CASINOVIDEOARCADESTAT where statistics_date = '%s' and name in (4, 6, 7)"%(stat_date_1day_before)
cursor.execute(sql)


sql = "insert into CASINOVIDEOARCADESTAT (statistics_date, name, value) values (%s, %s, %s)"
cursor.executemany(sql, stat_items)
conn.commit()
cursor.close()
conn.close()
