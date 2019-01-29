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

if True:
    mainDB1 = "54.179.168.6"
    mainDB1_slave = "54.179.168.6"
    mainDB2 = "127.0.0.1"
    mainDB2_slave = "127.0.0.1"
    hisDB = "127.0.0.1"
    hisDB_slave = "127.0.0.1"


host_gamehis = hisDB
host_global = mainDB2
host_stat = mainDB1
hosts_usergameinfo = [mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1,mainDB1, mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2,mainDB2]

# 结果存在这个数组中
stat_items = []

# 统计时用到的时间
now_time = datetime.datetime.now()
stat_time = now_time + datetime.timedelta(days = -previous_days)
stat_date = stat_time.strftime("%Y%m%d")

stat_time_1day_before = now_time + datetime.timedelta(days = -(previous_days + 1))
stat_date_1day_before = stat_time_1day_before.strftime("%Y%m%d")

####################################
# 在线人数峰值
####################################
stat_online_date = stat_time.strftime("%Y-%m-%d")
conn = MySQLdb.connect(host=host_global, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGLOBALINFO')
sql = "select max(count) from (select sum(roomusercount) count from CASINODETAILONLINESTATISTICS where statistics_time >= '%s 00:00:00' and statistics_time <= '%s 23:59:59' and gametype = 322 group by statistics_time) as maxonline" % (stat_online_date, stat_online_date)
cursor = conn.cursor()
cursor.execute(sql)
result = cursor.fetchone()
max_user_count = 0 if result[0] == None else result[0]    # 在线峰值[4]
cursor.close()
conn.close()

####################################
# 数据获取
####################################
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

# 这里存所有登录的userId
set_game_user = set()
# 这里存所有昨天登录的userId
set_game_user_1day_before = set()

# 从连环炮的日志表中查
conn = MySQLdb.connect(host=host_gamehis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGAMEHISDB')
sql = "select distinct userid from CASINOGAMERECORD_LHP_%s"%(stat_date)
if check_table_exists(conn,"CASINOGAMERECORD_LHP_%s"%(stat_date)) == 1:
    get_user_set(conn, sql, set_game_user)

game_user_count = len(set_game_user) # 总游戏人数[1]

# 判断前一天的日志表存不存在
if check_table_exists(conn,"CASINOGAMERECORD_LHP_%s"%(stat_date_1day_before)) == 1:
    sql = "select distinct userid from CASINOGAMERECORD_LHP_%s"%(stat_date_1day_before)
    get_user_set(conn, sql, set_game_user_1day_before)

today_remain_user_num = len(set_game_user & set_game_user_1day_before) # 昨日游戏用户今日再次游戏人数[2]
game_num = 0    # 总游戏局数[3]
game_num_per_user = 0    # 每人平均游戏局数[5]
compare_times = 0 # 比倍次数[6]
total_up_gold = 0 # 总上分金币数[7]
total_down_gold = 0 # 总下分金币数[8]
total_choushui = 0 # 总抽水[9]
game_result_field_id_start_num = 20 # 游戏结果的field id起始数
dict_game_result_num = {}
if check_table_exists(conn,"CASINOGAMERECORD_LHP_"+stat_date) == 1:
    sql = "select count(*) from CASINOGAMERECORD_LHP_%s where action=3"%(stat_date)
    game_num = get_single_stat_value(conn, sql)
    game_num_per_user = round(game_num / game_user_count, 2)
    # 表中的comparewinratio为非1表示进行过比倍
    sql = "select count(*) from CASINOGAMERECORD_LHP_%s where comparewinratio!=1"%(stat_date)
    compare_times = get_single_stat_value(conn, sql)
    sql = "select sum(goldchange) from CASINOGAMERECORD_LHP_%s where action=1"%(stat_date)
    total_up_gold = 0 - get_single_stat_value(conn, sql)  # 上分时的goldchange为负数
    sql = "select sum(goldchange) from CASINOGAMERECORD_LHP_%s where action=2"%(stat_date)
    total_down_gold = get_single_stat_value(conn, sql)
    total_choushui = total_up_gold - total_down_gold
    
    # 查询每种牌出现几次
    sql = "select count(*) as num, gameresult from CASINOGAMERECORD_LHP_%s where gameresult>0 group by gameresult"%(stat_date)
    cursor = conn.cursor()
    cursor.execute(sql)    
    records = cursor.fetchall()
    for row in records:
        dict_game_result_num[game_result_field_id_start_num + int(row[1])] = row[0]
    cursor.close()

####################################
# 数据存储
####################################
conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', charset="utf8", db='CASINOSTATDB')
cursor = conn.cursor()

sql = "delete from CASINOLHPSTAT where statistics_date = '%s'"%(stat_date)
cursor.execute(sql)

stat_items.append((stat_date, 1, format(game_user_count, ',')))
stat_items.append((stat_date, 2, format(today_remain_user_num, ',')))
stat_items.append((stat_date, 3, format(game_num, ',')))
stat_items.append((stat_date, 4, format(max_user_count, ',')))
stat_items.append((stat_date, 5, game_num_per_user))
stat_items.append((stat_date, 6, format(compare_times, ',')))
stat_items.append((stat_date, 7, format(total_up_gold, ',')))
stat_items.append((stat_date, 8, format(total_down_gold, ',')))
stat_items.append((stat_date, 9, format(total_choushui, ',')))

for (k,v) in dict_game_result_num.items(): 
    stat_items.append((stat_date, k, format(v, ',')))

# print stat_items

sql = "insert into CASINOLHPSTAT (statistics_date, name, value) values (%s, %s, %s)"
cursor.executemany(sql, stat_items)
conn.commit()
cursor.close()
conn.close()
