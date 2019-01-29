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

print dict_room_name
print dict_room_item_id

stat_online_date = stat_time.strftime("%Y-%m-%d")
print stat_online_date

conn = MySQLdb.connect(host=host_global, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGLOBALINFO')
sql = "select roomid, max(count) from (select sum(roomusercount) count, roomid, statistics_time from CASINODETAILONLINESTATISTICS where statistics_time >= '%s 00:00:00' and statistics_time <= '%s 23:59:59' and gameserverport = 9107 group by statistics_time, roomid) online group by roomid"%(stat_online_date, stat_online_date)
cursor = conn.cursor()
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
        dict_room_user_max_count[row[0]] = row[1]
print dict_room_user_max_count

for room_id in dict_room_name:
        room_user_max_count = 0
        if room_id in dict_room_user_max_count:
                room_user_max_count = dict_room_user_max_count[room_id]
                if room_id in dict_room_item_id:
                        stat_items.append((stat_date, dict_room_item_id[room_id], room_user_max_count))

print stat_items

cursor.close()
conn.close()



