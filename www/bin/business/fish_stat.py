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
	host_global = "127.0.0.1"
	host_stat = "127.0.0.1"
else:
	hosts = ["192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6"]
	hosts_usergameinfo = ["192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.5","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6","192.168.111.6"]
	host_gamehis = "192.168.111.7"
	host_buyhis = "192.168.111.6"
	host_stat = "192.168.111.5"
	host_stat_write = "192.168.111.5"
	
stat_items = []

now_time = datetime.datetime.now()
stat_time = now_time + datetime.timedelta(days = -previous_days)
stat_date = stat_time.strftime("%Y%m%d")

yesterday_time = stat_time + datetime.timedelta(days = -1)
yesterday_date = yesterday_time.strftime("%Y%m%d")

set_login_user = set()
set_game_user = set()
set_upgradegun_user = set()
set_emotion_user = set()
set_skill_user = set()
set_yesterday_game_user = set()

file_name = "fish_stat_%s.txt"%(stat_date)
output = codecs.open(file_name, 'w', 'utf-8')

conn = MySQLdb.connect(host=host_gamehis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGAMEHISDB')
cursor = conn.cursor()

def get_user_by_condition(sql, set_user):
	print sql
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		userid = row[0]
		set_user.add(userid)

login_table_name = "CASINOLOGINHISTORY%s"%(stat_date)
sql = "select distinct userid from %s where gamecode = 13"%(login_table_name)
get_user_by_condition(sql, set_login_user)

game_table_name = "CASINOFISHGAMERECORD%s"%(stat_date)
sql = "select distinct userid from %s"%(game_table_name)
get_user_by_condition(sql, set_game_user)

yesterday_game_table_name = "CASINOFISHGAMERECORD%s"%(yesterday_date)
sql = "select distinct userid from %s"%(yesterday_game_table_name)
get_user_by_condition(sql, set_yesterday_game_user)

#upgradegun_table_name = "CASINOFISHUPGRADEGUNRECORD%s"%(stat_date)
#sql = "select distinct userid from %s"%(upgradegun_table_name)
#get_user_by_condition(sql, set_upgradegun_user)

#emotion_table_name = "CASINOANIMATIONEMOTIONRECORD%s"%(stat_date)
#sql = "select distinct userid from %s where gametype = 193"%(emotion_table_name)
#get_user_by_condition(sql, set_emotion_user)

skill_table_name = "CASINOFISHSKILLRECORD%s"%(stat_date)
sql = "select distinct userid from %s"%(skill_table_name)
get_user_by_condition(sql, set_skill_user) 

dict_first_record = {}
dict_last_record = {}

dict_room_play_score_id = {}
dict_room_win_score_id = {}

dict_room_score_id = {}
dict_room_score_id[-1] = (29, 30)
dict_room_score_id[1] = (59, 60)
dict_room_score_id[2] = (61, 62)
dict_room_score_id[3] = (63, 64)
dict_room_score_id[4] = (65, 66)
dict_room_score_id[0] = (67, 68)

for room_id in dict_room_score_id:
	dict_first_record[room_id] = {}
	dict_last_record[room_id] = {}

sql = "select userid, totalplayscore, totalwinscore, roomid, unix_timestamp(recordtime) from %s"%(game_table_name)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	user_id = row[0]
	room_id = row[3]
	
	dict_last_record[-1][user_id] = row
	dict_last_record[room_id][user_id] = row
	if user_id not in dict_first_record[-1]:
		dict_first_record[-1][user_id] = row
	if user_id not in dict_first_record[room_id]:
		dict_first_record[room_id][user_id] =row
	
dict_dropitem = {}
dict_dropitem[3] = [0, 0, 0, 0, 0, 0, 0]
dict_dropitem[4] = [0, 0, 0, 0, 0, 0, 0]
sql = "select count(distinct userid), itemtype from CASINOFISHDROPITEMRECORD%s where itemtype in (3, 4) group by itemtype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	dict_dropitem[row[1]] = [row[0], 0, 0, 0, 0, 0, 0]

sql = "select sum(dropitemcount), itemtype from CASINOFISHDROPITEMRECORD%s where itemtype in (3, 4) and subpaycontribution > 0 group by itemtype"%(stat_date)	
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	if row[1] in dict_dropitem:
		dict_dropitem[row[1]][1] = row[0]
	else:
		dict_dropitem[row[1]] = [0, row[0], 0, 0, 0, 0, 0]

sql = "select sum(dropitemcount), itemtype from CASINOFISHDROPITEMRECORD%s where itemtype in (3, 4) and subpaycontribution = 0 group by itemtype"%(stat_date)	
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	if row[1] in dict_dropitem:
		dict_dropitem[row[1]][2] = row[0]
	else:
		dict_dropitem[row[1]] = [0, 0, row[0], 0, 0, 0, 0]

total_drop_coupon = 0
sql = "select sum(dropitemcount) from CASINOFISHDROPITEMRECORD%s where itemtype = 5"%(stat_date)	
cursor.execute(sql)
#print cursor.fetchone()
#sys.exit()
records = cursor.fetchall()
for row in records:		
    if row[0] != None:
        total_drop_coupon += row[0]
		
dict_total_win = {}
dict_total_play_score = {}
dict_total_win_score = {}
total_game_time = 0

for room_id in dict_room_score_id:
	dict_total_play_score[room_id] = 0
	dict_total_win_score[room_id] = 0

for room_id in dict_room_score_id:
	dict_room_first_record = dict_first_record[room_id]
	dict_room_last_record = dict_last_record[room_id]

	for user_id in dict_room_first_record:
		first_record = dict_room_first_record[user_id]
		last_record = dict_room_last_record[user_id]
		play_score = first_record[1] - last_record[1]
		win_score = last_record[2] - first_record[2]
		dict_total_play_score[room_id] += play_score
		dict_total_win_score[room_id] += win_score
		if room_id == -1:
			if user_id in dict_total_win:
				dict_total_win[user_id] += (win_score - play_score)
			else:
				dict_total_win[user_id] = (win_score - play_score)
			total_game_time += (last_record[4] - first_record[4])
			
	
sql = "select userid, itemtype, sum(dropitemcount) from CASINOFISHDROPITEMRECORD%s where itemtype in (3, 4) group by userid, itemtype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	userid = row[0]
	itemtype = row[1]
	if userid in dict_total_win:
		score = 0
		if itemtype == 3:
			score = 50000
		elif itemtype == 4:
			score = 500000
		dict_total_win[userid] += (score * row[2]) 

win_user_count = 0
lose_user_count = 0
for userid in dict_total_win:
	if dict_total_win[userid] > 0:
		win_user_count += 1
	else:
		lose_user_count += 1

total_fish_boss_count = 0
dict_fishtype_boss_count_id = {}
dict_fishtype_boss_count_id[20] = 70
dict_fishtype_boss_count_id[70] = 71
dict_fishtype_boss_count_id[69] = 72
dict_fishtype_boss_count_id[44] = 73

total_fish_elite_count = 0
dict_fishtype_elite_count_id = {}
dict_fishtype_elite_count_id[26] = 74
dict_fishtype_elite_count_id[38] = 75
dict_fishtype_elite_count_id[72] = 76
dict_fishtype_elite_count_id[71] = 77
dict_fishtype_elite_count_id[63] = 78
dict_fishtype_elite_count_id[49] = 79
dict_fishtype_elite_count_id[4] = 80
dict_fishtype_elite_count_id[52] = 81
dict_fishtype_elite_count_id[68] = 82
dict_fishtype_elite_count_id[74] = 83
dict_fishtype_elite_count_id[80] = 84

sql = "select fishtype, count(*) from CASINOFISHDROPITEMRECORD%s group by fishtype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	fish_type = row[0]
	count = row[1]
	line = "击杀鱼类型[%d]:[%d]\r\n"%(fish_type, count)
	output.write(unicode(line, "utf-8"))
	if fish_type in dict_fishtype_boss_count_id:
		stat_items.append((stat_date, dict_fishtype_boss_count_id[fish_type], count))
		total_fish_boss_count += count
	elif fish_type in dict_fishtype_elite_count_id:
		stat_items.append((stat_date, dict_fishtype_elite_count_id[fish_type], count))
		total_fish_elite_count += count	

stat_items.append((stat_date, 97, total_fish_boss_count))
stat_items.append((stat_date, 98, total_fish_elite_count))		

total_use_secondmoney = 0
dict_secondmoney_change_id = {}
dict_secondmoney_change_id[7] = 85
dict_secondmoney_change_id[4] = 86
dict_secondmoney_change_id[5] = 87
dict_secondmoney_change_id[6] = 88
sql = "select eventtype, sum(countafter - countbefore) from CASINOSECONDMONEYCHANGEHISTORY%s group by eventtype"%(stat_date)		
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	event_type = row[0]
	count = row[1]
	if count < 0:
		count = -count
		total_use_secondmoney += count
	line = "钻石变化类型[%d]:[%d]\r\n"%(event_type, count)
	output.write(unicode(line, "utf-8"))
	if event_type in dict_secondmoney_change_id:
		stat_items.append((stat_date, dict_secondmoney_change_id[event_type], count))		
		
stat_items.append((stat_date, 99, total_use_secondmoney))			
		
dict_use_skill_id = {}
dict_use_skill_id[1] = 90
dict_use_skill_id[2] = 91
dict_use_skill_id[3] = 92
total_skill_count = 0
sql = "select skilltype, sum(skillnumberbefore - skillnumberafter) from CASINOFISHSKILLRECORD%s group by skilltype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	skill_type = row[0]
	count = row[1]
	total_skill_count += count
	line = "技能类型[%d]:[%d]\r\n"%(skill_type, count)
	output.write(unicode(line, "utf-8"))
	if skill_type in dict_use_skill_id:
		stat_items.append((stat_date, dict_use_skill_id[skill_type], count))
		
stat_items.append((stat_date, 89, total_skill_count))
	
sql = "select rewardtype, sum(rewardcountafter - rewardcountbefore) from CASINOLOTTERYGAMERECORD%s where gametype = 193 and rewardtype in (3, 4) and paycontributionafter = paycontributionbefore group by rewardtype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	reward_type = row[0]
	count = row[1]
	if reward_type in dict_dropitem:
		dict_dropitem[reward_type][3] = count
	else:
		dict_dropitem[reward_type] = [0, 0, 0, count, 0, 0, 0]

sql = "select rewardtype, sum(rewardcountafter - rewardcountbefore) from CASINOLOTTERYGAMERECORD%s where gametype = 193 and rewardtype in (3, 4) and paycontributionafter <> paycontributionbefore group by rewardtype"%(stat_date)
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
	reward_type = row[0]
	count = row[1]
	if reward_type in dict_dropitem:
		dict_dropitem[reward_type][4] = count
	else:
		dict_dropitem[reward_type] = [0, 0, 0, 0, count, 0, 0]
		

#sql = "select rewarditemtype, sum(rewarditemnum) from CASINOFISHINGLOBBYPLAYLOTTERYRECORD%s where rewarditemtype in (3, 4) and afterpaycontribution = beforepaycontribution group by rewarditemtype"%(stat_date)
#cursor.execute(sql)
#records = cursor.fetchall()
#for row in records:
#	reward_type = row[0]
#	count = row[1]
#	if reward_type in dict_dropitem:
#		dict_dropitem[reward_type][5] = count
#	else:
#		dict_dropitem[reward_type] = [0, 0, 0, 0, 0, count, 0]
		
#sql = "select rewarditemtype, sum(rewarditemnum) from CASINOFISHINGLOBBYPLAYLOTTERYRECORD%s where rewarditemtype in (3, 4) and afterpaycontribution <> beforepaycontribution group by rewarditemtype"%(stat_date)
#cursor.execute(sql)
#records = cursor.fetchall()
#for row in records:
#	reward_type = row[0]
#	count = row[1]
#	if reward_type in dict_dropitem:
#		dict_dropitem[reward_type][6] = count
#	else:
#		dict_dropitem[reward_type] = [0, 0, 0, 0, 0, 0, count]		
		
		
stat_date = stat_time.strftime("%Y-%m-%d")
stat_time_begin = "%s 00:00:00"%(stat_date)
stat_time_end = "%s 23:59:59"%(stat_date)

conn.close()

conn = MySQLdb.connect(host=host_buyhis, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', db='CASINOGLOBALINFO')
sql = "select max(usercount) from (select sum(roomusercount) as usercount from CASINODETAILONLINESTATISTICS where statistics_time >= '%s' and statistics_time <= '%s' and gametype = 193 group by statistics_time) as usercounttime"%(stat_time_begin, stat_time_end)
cursor = conn.cursor()
cursor.execute(sql)
result = cursor.fetchone()
max_user_count = result[0]
line = "最高在线人数:%s\r\n"%(max_user_count)
output.write(unicode(line, "utf-8"))

stat_items.append((stat_date, 1, max_user_count))

cursor.close()
conn.close()

set_firstgame_user = set()
set_1day_firstgame_user = set()
set_all_user = set()

today = datetime.date.today()
today_timestamp = int(time.mktime(today.timetuple()))
stat_begin_timestamp = today_timestamp - previous_days * 24 * 3600
stat_end_timestamp = stat_begin_timestamp + 24 * 3600
stat_yesterday_begin_timestamp = stat_begin_timestamp - 24 * 3600
stat_yesterday_end_timestamp = stat_begin_timestamp	

def get_table_data(conn, table_pos):
	cursor = conn.cursor()
	
	sql = "select userid, unix_timestamp(firstgametime) from CASINOUSERGAMEINFO_%d where gametype = 193"%(table_pos)
	cursor.execute(sql)
	records = cursor.fetchall()
	for row in records:
		userid = row[0]
		firsttimestamp = row[1]
		if firsttimestamp >= stat_begin_timestamp and firsttimestamp < stat_end_timestamp:
			set_firstgame_user.add(userid)
		if firsttimestamp >= stat_yesterday_begin_timestamp and firsttimestamp < stat_yesterday_end_timestamp:
			set_1day_firstgame_user.add(userid)
		set_all_user.add(userid)

def get_db_data(conn, db_pos):
	db_name = "CASINOUSERDB_%d"%db_pos
	conn.select_db(db_name)
	for table_pos in range(0, 16):
		get_table_data(conn, table_pos)

for db_pos in range(0, 16):
	conn = MySQLdb.connect(host=hosts_usergameinfo[db_pos], port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx')
	get_db_data(conn, db_pos)
	conn.close()

login_user_count = len(set_login_user)
line = "登录用户数量:%s\r\n"%(login_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 2, login_user_count))

game_user_count = len(set_game_user)
line = "游戏用户数量:%s\r\n"%(game_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 3, game_user_count))

upgradegun_user_count = len(set_upgradegun_user)
line = "升级炮台用户数量:%s\r\n"%(upgradegun_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 4, upgradegun_user_count))

emotion_user_count = len(set_emotion_user)
line = "使用表情用户数量:%s\r\n"%(emotion_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 5, emotion_user_count))

skill_user_count = len(set_skill_user)
line = "使用技能用户数量:%s\r\n"%(skill_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 6, skill_user_count))

yesterday_game_user_count = len(set_yesterday_game_user)
print "yesterday game user count:%s"%(yesterday_game_user_count)
set_retain_game_user = set_game_user & set_yesterday_game_user
retain_game_user_count = len(set_retain_game_user)
line = "昨日今日均游戏用户数量:%s\r\n"%(retain_game_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 7, retain_game_user_count))

line = "首次游戏用户数量:%s\r\n"%(len(set_firstgame_user))
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 8, len(set_firstgame_user)))

set_firstgame_upgradegun_user = set_firstgame_user & set_upgradegun_user
firstgame_upgradegun_user_count = len(set_firstgame_upgradegun_user)
line = "首次游戏用户升级炮台数量:%s\r\n"%(firstgame_upgradegun_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 9, firstgame_upgradegun_user_count))

set_firstgame_emotion_user = set_firstgame_user & set_emotion_user
firstgame_emotion_user_count = len(set_firstgame_emotion_user)
line = "首次游戏用户使用表情数量:%s\r\n"%(firstgame_emotion_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 10, firstgame_emotion_user_count))

set_firstgame_skill_user = set_firstgame_user & set_skill_user
firstgame_skill_user_count = len(set_firstgame_skill_user)
line = "首次游戏用户使用技能数量:%s\r\n"%(firstgame_skill_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 11, firstgame_skill_user_count))

set_1day_retaingame_user = set_1day_firstgame_user & set_game_user
retaingame_1day_user_count = len(set_1day_retaingame_user)
line = "前日首次游戏用户今天游戏数量:%s\r\n"%(retaingame_1day_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 12, retaingame_1day_user_count))

if len(set_1day_firstgame_user) == 0:
    stat_items.append((stat_date, 13, 0))
else:
    retaingame_1day_rate = 100 * retaingame_1day_user_count / len(set_1day_firstgame_user)
    retaingame_1day_rate_display = "%.2f%%"%(retaingame_1day_rate)
    stat_items.append((stat_date, 13, retaingame_1day_rate_display))

line = "所有捕鱼游戏玩家数量:%s\r\n"%(len(set_all_user))
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 14, len(set_all_user)))

line = "银宝箱发放数(扣贡献度):%s\r\n"%(dict_dropitem[3][1])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 17, dict_dropitem[3][1]))

line = "银宝箱发放数(不扣贡献度):%s\r\n"%(dict_dropitem[3][2])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 16, dict_dropitem[3][2]))

line = "银宝箱发放数(天降鸿福不扣贡献度):%s\r\n"%(dict_dropitem[3][3])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 93, dict_dropitem[3][3]))

line = "银宝箱发放数(天降鸿福扣贡献度):%s\r\n"%(dict_dropitem[3][4])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 101, dict_dropitem[3][4]))

line = "银宝箱发放数(豪华抽奖不扣贡献度):%s\r\n"%(dict_dropitem[3][5])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 94, dict_dropitem[3][5]))

line = "银宝箱发放数(豪华抽奖扣贡献度):%s\r\n"%(dict_dropitem[3][6])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 102, dict_dropitem[3][6]))

silver_count = dict_dropitem[3][1] + dict_dropitem[3][2] + dict_dropitem[3][3] + dict_dropitem[3][4] + dict_dropitem[3][5] + dict_dropitem[3][6]
silver_value = 50000 * silver_count
stat_items.append((stat_date, 15, silver_count))
stat_items.append((stat_date, 18, silver_value))

line = "掉落银宝盒人数:%s\r\n"%(dict_dropitem[3][0])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 19, dict_dropitem[3][0]))

line = "金宝箱发放数(扣贡献度):%s\r\n"%(dict_dropitem[4][1])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 22, dict_dropitem[4][1]))

line = "金宝箱发放数(不扣贡献度):%s\r\n"%(dict_dropitem[4][2])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 21, dict_dropitem[4][2]))

line = "金宝箱发放数(天降鸿福不扣贡献度):%s\r\n"%(dict_dropitem[4][3])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 95, dict_dropitem[4][3]))

line = "金宝箱发放数(天降鸿福扣贡献度):%s\r\n"%(dict_dropitem[4][4])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 103, dict_dropitem[4][4]))

line = "金宝箱发放数(豪华抽奖不扣贡献度):%s\r\n"%(dict_dropitem[4][5])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 96, dict_dropitem[4][5]))

line = "金宝箱发放数(豪华抽奖扣贡献度):%s\r\n"%(dict_dropitem[4][6])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 104, dict_dropitem[4][6]))

golden_count = dict_dropitem[4][1] + dict_dropitem[4][2] + dict_dropitem[4][3] + dict_dropitem[4][4] + dict_dropitem[4][5] + dict_dropitem[4][6]
golden_value = 500000 * golden_count
stat_items.append((stat_date, 20, golden_count))
stat_items.append((stat_date, 23, golden_value))

line = "掉落金宝盒人数:%s\r\n"%(dict_dropitem[4][0])
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 24, dict_dropitem[4][0]))

line = "捕鱼赢分玩家人数:%s\r\n"%(win_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 25, win_user_count))

line = "捕鱼输分玩家人数:%s\r\n"%(lose_user_count)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 26, lose_user_count))

total_user_count = win_user_count + lose_user_count

win_user_rate = 100 * win_user_count / total_user_count
win_user_rate_display = "%.2f%%"%(win_user_rate)
stat_items.append((stat_date, 27, win_user_rate_display))

lose_user_rate = 100 * lose_user_count / total_user_count
lose_user_rate_display = "%.2f%%"%(lose_user_rate)
stat_items.append((stat_date, 28, lose_user_rate_display))

average_game_time = total_game_time / 60 / total_user_count
line = "平均游戏时间:%s\r\n"%(average_game_time)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 69, average_game_time))


line = "掉落兑奖券:%s\r\n"%(total_drop_coupon)
output.write(unicode(line, "utf-8"))
stat_items.append((stat_date, 100, total_drop_coupon))

for room_id in dict_total_play_score:
	total_play_score = dict_total_play_score[room_id]
	if room_id == -1:
		line = "总玩分:%s\r\n"%(total_play_score)
	else:
		line = "房间[%d]总玩分:%s\r\n"%(room_id, total_play_score)
	
	output.write(unicode(line, "utf-8"))
	stat_items.append((stat_date, dict_room_score_id[room_id][0], total_play_score))
	
for room_id in dict_total_win_score:
	total_win_score = dict_total_win_score[room_id]
	if room_id == -1:
		line = "总赢分:%s\r\n"%(total_win_score)
	else:
		line = "房间[%d]总赢分:%s\r\n"%(room_id, total_win_score)
	
	output.write(unicode(line, "utf-8"))
	stat_items.append((stat_date, dict_room_score_id[room_id][1], total_win_score))
	
	
stat_items.append((stat_date, 31, total_play_score - total_win_score))
stat_items.append((stat_date, 32, total_play_score - total_win_score - silver_value - golden_value))

def get_user_pos(userid):
	userid = 0xFF & userid;
	db_pos = (userid & 0xF0) >> 4
	table_pos = (userid & 0x0F)
	return (db_pos, table_pos)

dict_user_score = {}
dict_user_gun = {}

dict_conn = {}
for db_pos in range(0, 16):		
	conn = MySQLdb.connect(host=hosts[db_pos], port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx')
	dict_conn[db_pos] = conn
	
def group_user(userid, db_pos, table_pos, dict):
	if db_pos in dict:
		if table_pos in dict[db_pos]:
			dict[db_pos][table_pos].add(userid)
		else:
			set_table = set()
			set_table.add(userid)
			dict[db_pos][table_pos] = set_table
	else:
		set_table = set()
		set_table.add(userid)
		dict[db_pos] = {table_pos : set_table}	

dict_account_pos = {}
for userid in set_all_user:
	(db_pos, table_pos) = get_user_pos(userid)
	group_user(userid, db_pos, table_pos, dict_account_pos)

dict_user_pos = {}
for db_pos in dict_account_pos:
	cursor = dict_conn[db_pos].cursor()
	for table_pos in dict_account_pos[db_pos]:
		sql = "select userid, dbindex, tableindex from CASINOUSERDB_%s.CASINOUSER2ACCOUNT_%s where userid in ("%(db_pos, table_pos)
		for userid in dict_account_pos[db_pos][table_pos]:
			sql = "%s%s,"%(sql, userid)
		sql = sql[:-1]
		sql = "%s)"%(sql)
		print sql
		cursor.execute(sql)
		records = cursor.fetchall()
		for row in records:
			userid = row[0]
			dbindex = row[1]
			tableindex = row[2]
			group_user(userid, dbindex, tableindex, dict_user_pos)
			
for db_pos in dict_user_pos:
	cursor = dict_conn[db_pos].cursor()
	for table_pos in dict_user_pos[db_pos]:
		sql = "select userid, gunindex from CASINOUSERDB_%s.CASINOUSERFISHINFO_%s where userid in ("%(db_pos, table_pos)
		for userid in dict_user_pos[db_pos][table_pos]:
			sql = "%s%s,"%(sql, userid)
		sql = sql[:-1]
		sql = "%s)"%(sql)			
		print sql
		cursor.execute(sql)
		records = cursor.fetchall()		
		for row in records:
			userid = row[0]
			gunindex = row[1]
			dict_user_gun[userid] = gunindex
		sql = "select id, user_chips from CASINOUSERDB_%s.CASINOUSER_%s where id in ("%(db_pos, table_pos)
		for userid in dict_user_pos[db_pos][table_pos]:
			sql = "%s%s,"%(sql, userid)
		sql = sql[:-1]
		sql = "%s)"%(sql)		
		print sql
		cursor.execute(sql)
		records = cursor.fetchall()		
		for row in records:
			userid = row[0]
			score = row[1]
			dict_user_score[userid] = score

for db_pos in dict_conn:
	dict_conn[db_pos].close()

dict_score_range = {}
dict_score_range[0] = "<1000"
dict_score_range[1] = "1000-5000"
dict_score_range[2] = "5000-20000"
dict_score_range[3] = "20000-50000"
dict_score_range[4] = "50000+"

dict_gun_range = {}
dict_gun_range[0] = "<=5"
dict_gun_range[1] = "5-10"
dict_gun_range[2] = "10-15"
dict_gun_range[3] = "15-20"
dict_gun_range[4] = "20-35"
dict_gun_range[5] = ">35"

def update_dict(dict, key):
	if key in dict:
		dict[key] = dict[key] + 1
	else:
		dict[key] = 1

def update_distribution_count(userid, dict_score, dict_gun):
	if userid in dict_user_score:
		score = dict_user_score[userid]
		if score < 1000:
			update_dict(dict_score, 0)
		elif score < 5000:
			update_dict(dict_score, 1)
		elif score < 20000:
			update_dict(dict_score, 2)
		elif score < 50000:
			update_dict(dict_score, 3)
		else:
			update_dict(dict_score, 4)
	if userid in dict_user_gun:
		gun = dict_user_gun[userid]
		if gun <= 5:
			update_dict(dict_gun, 0)
		elif gun <= 10:
			update_dict(dict_gun, 1)
		elif gun <= 15:
			update_dict(dict_gun, 2)
		elif gun <= 20:
			update_dict(dict_gun, 3)
		elif gun <= 35:
			update_dict(dict_gun, 4)
		else:
			update_dict(dict_gun, 5)
	
dict_score_distribution = {}
dict_gun_distribution = {}
dict_score_distribution_lost = {}
dict_gun_distribution_lost = {}

for userid in set_all_user:
	update_distribution_count(userid, dict_score_distribution, dict_gun_distribution)
	
set_lost_user = set_all_user - set_game_user
set_lost_user = set_lost_user - set_yesterday_game_user
for userid in set_lost_user:
	update_distribution_count(userid, dict_score_distribution_lost, dict_gun_distribution_lost)

dict_score_range_id = {}
dict_score_range_id[0] = 34
dict_score_range_id[1] = 35
dict_score_range_id[2] = 36
dict_score_range_id[3] = 37
dict_score_range_id[4] = 38	
	
dict_gun_range_id = {}
dict_gun_range_id[0] = 40
dict_gun_range_id[1] = 41
dict_gun_range_id[2] = 42
dict_gun_range_id[3] = 43
dict_gun_range_id[4] = 44
dict_gun_range_id[5] = 45	
	
line = "所有玩家金豆数分布\r\n"
output.write(unicode(line, "utf-8"))
score_user_count = 0
for key in dict_score_distribution:
	if key in dict_score_range:
		line = "%s:%s\r\n"%(dict_score_range[key], dict_score_distribution[key])
		output.write(unicode(line, "utf-8"))
		stat_items.append((stat_date, dict_score_range_id[key], dict_score_distribution[key]))
		score_user_count += dict_score_distribution[key]		
stat_items.append((stat_date, 33, score_user_count))

line = "所有玩家炮台等级分布\r\n"
output.write(unicode(line, "utf-8"))
gun_user_count = 0
for key in dict_gun_distribution:
	if key in dict_gun_range:
		line = "%s:%s\r\n"%(dict_gun_range[key], dict_gun_distribution[key])
		output.write(unicode(line, "utf-8"))
		stat_items.append((stat_date, dict_gun_range_id[key], dict_gun_distribution[key]))
		gun_user_count += dict_gun_distribution[key]
stat_items.append((stat_date, 39, gun_user_count))

dict_score_range_id = {}
dict_score_range_id[0] = 47
dict_score_range_id[1] = 48
dict_score_range_id[2] = 49
dict_score_range_id[3] = 50
dict_score_range_id[4] = 51	
	
dict_gun_range_id = {}
dict_gun_range_id[0] = 53
dict_gun_range_id[1] = 54
dict_gun_range_id[2] = 55
dict_gun_range_id[3] = 56
dict_gun_range_id[4] = 57
dict_gun_range_id[5] = 58	

line = "流失玩家金豆数分布\r\n"
output.write(unicode(line, "utf-8"))
score_user_count = 0	
for key in dict_score_distribution_lost:
	if key in dict_score_range:
		line = "%s:%s\r\n"%(dict_score_range[key], dict_score_distribution_lost[key])
		output.write(unicode(line, "utf-8"))
		stat_items.append((stat_date, dict_score_range_id[key], dict_score_distribution_lost[key]))
		score_user_count += dict_score_distribution_lost[key]
stat_items.append((stat_date, 46, score_user_count))
		
line = "流失玩家炮台等级分布\r\n"
output.write(unicode(line, "utf-8"))
gun_user_count = 0
for key in dict_gun_distribution_lost:
	if key in dict_gun_range:
		line = "%s:%s\r\n"%(dict_gun_range[key], dict_gun_distribution_lost[key])
		output.write(unicode(line, "utf-8"))
		stat_items.append((stat_date, dict_gun_range_id[key], dict_gun_distribution_lost[key]))
		gun_user_count += dict_gun_distribution_lost[key]	
stat_items.append((stat_date, 52, gun_user_count))

output.close();

conn = MySQLdb.connect(host=host_stat, port=3306, user='dbuserx', passwd='dbpwdxxxxxxxxxxxxxxx', charset="utf8", db='CASINOSTATDB')
cursor = conn.cursor()

sql = "delete from CASINOFISHSTAT where statistics_date = '%s'"%(stat_date)
cursor.execute(sql)

sql = "insert into CASINOFISHSTAT (statistics_date, name, value) values (%s, %s, %s)"
cursor.executemany(sql, stat_items)
conn.commit()
cursor.close()
conn.close()
