#!/bin/bash

#**************GLOBALDEFINE***************************
HOSTNAME="192.168.111.11"
PORT="3306"
USERNAME="dbuserx"
PASSWORD="dbpwdxxxxxxxxxxxxxxx"
PREFIX="CASINO"

#**************DEFINE OF DATABASE NAME****************
DATABASEGAMEHIS="GAMEHISDB"

MYSQL_CMD="mysql -h${HOSTNAME}  -P${PORT}  -u${USERNAME} -p${PASSWORD}"
OPTIONSKIP="--skip-column-names"

dump_date=`date +%Y%m%d`

totalDouDiZhuTableFee=0
table_name="CASINOGAMERECORD_DDZ_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
ddzJingDianTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
sql="select sum(user_score_end - user_score_begin + user_table_fee) from ${table_name} where isrobot = 1"
ddzJingDianRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
	
table_name="CASINOGAMERECORD_DDZHUANLE_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
ddzHuanLeTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
sql="select sum(user_score_end - user_score_begin + user_table_fee) from ${table_name} where isrobot = 1"
ddzHuanLeRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
	
table_name="CASINOGAMERECORD_DDZLAIZI_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
ddzLaiZiTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
let "totalDouDiZhuTableFee=ddzJingDianTableFee+ddzHuanLeTableFee+ddzHuanLeTableFee"
	
totalNiuNiuTableFee=0
table_name="CASINOGAMERECORD_NiuNiu_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
niuniuPuTongTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
niuniuPuTongTableFee=0

table_name="CASINOGAMERECORD_NiuNiuQiangZhuang_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
niuniuQiangZhuangTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
sql="select sum(user_score_end - user_score_begin) from ${table_name} where isrobot = 1"
niuniuQiangZhuangRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	

table_name="CASINOGAMERECORD_NiuNiuSeenCardQZ_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
niuniuSeenCardTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
sql="select sum(user_score_end - user_score_begin) from ${table_name} where isrobot = 1"
niuniuSeenCardRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`		

let "totalNiuNiuTableFee=niuniuPuTongTableFee+niuniuQiangZhuangTableFee+niuniuSeenCardTableFee"

table_name="CASINOGAMERECORD_ZJH_"${dump_date}
sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
totalZhaJinHuaTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
sql="select sum(user_score_end - user_score_begin) from ${table_name} where isrobot = 1"
zhaJinHuaRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	

#table_name="CASINOGAMERECORD_GUANDAN_"${dump_date}
#sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
#totalGuanDanTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
#sql="select sum(user_score_end - user_score_begin + user_table_fee) from ${table_name} where isrobot = 1"
#guanDanRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	

#table_name="CASINOGAMERECORD_TexasPoker_"${dump_date}
#sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
#totalTexasPokerTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
#sql="select sum(user_score_end - user_score_begin) from ${table_name} where isrobot = 1"
#texasPokerRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	

#totalMaJiangTableFee=0
#table_name="CASINOGAMERECORD_MJ2P_"${dump_date}
#sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
#totalMaJiang2PTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
#sql="select sum(user_score_end - user_score_begin + user_table_fee) from ${table_name} where isrobot = 1"
#mj2pRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
#table_name="CASINOGAMERECORD_MJ_"${dump_date}
#sql="select sum(user_table_fee) from ${table_name} where isrobot = 0"
#totalMaJiang4PTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
#sql="select sum(user_score_end - user_score_begin + user_table_fee) from ${table_name} where isrobot = 1"
#mj4pRobotWinScore=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	
#let "totalMaJiangTableFee=totalMaJiang2PTableFee+totalMaJiang4PTableFee"
#let "maJiangRobotWinScore=mj2pRobotWinScore+mj4pRobotWinScore"

#sql="select sum(scorelost) - sum(scorewin) from CASINOLAOHUJIGAMERECORD${dump_date}"
#fruitTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
#sql="select sum(chipcost) from CASINOROULETTEHISTORY${dump_date}"
#rouletteChipCost=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
#sql="select sum(winchips) from CASINOROULETTEHISTORY${dump_date}"
#rouletteRewardChips=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`
#sql="select sum((wincoupons) ) from CASINOROULETTEHISTORY${dump_date}"
#rouletteRewardCoupons=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`

#table_name="CASINOROULETTEHISTORY"${dump_date}
#sql="select sum(chipcost) - sum(winchips) from ${table_name}"
#rouletteTableFee=`echo ${sql} | ${MYSQL_CMD} ${OPTIONSKIP} "CASINOGAMEHISDB"`	

let "totalTableFee=${totalTexasPokerTableFee}+${totalNiuNiuTableFee}+${totalZhaJinHuaTableFee}+${totalDouDiZhuTableFee}+${totalGuanDanTableFee}+${totalMaJiangTableFee}+${rouletteTableFee}"
let "totalRobotWinScore=${texasPokerRobotWinScore}+${niuniuQiangZhuangRobotWinScore}+${niuniuSeenCardRobotWinScore}+${zhaJinHuaRobotWinScore}+${ddzJingDianRobotWinScore}+${ddzHuanLeRobotWinScore}
	+${guanDanRobotWinScore}+${mj2pRobotWinScore}+${mj4pRobotWinScore}"

sql="insert into CASINOSERVICEFEESTAT (item_id, service_fee, stat_date) values 
	(0, ${totalTexasPokerTableFee}, ${dump_date}), 
	(1, ${totalNiuNiuTableFee}, ${dump_date}),
	(3, ${totalZhaJinHuaTableFee}, ${dump_date}),
	(5, ${rouletteTableFee}, ${dump_date}),
	(1005, ${rouletteChipCost}, ${dump_date}),
	(2005, ${rouletteRewardChips}, ${dump_date}),
	(3005, ${rouletteRewardCoupons}, ${dump_date}),
	(6, ${totalDouDiZhuTableFee}, ${dump_date}),
	(8, ${totalGuanDanTableFee}, ${dump_date}),
	(14, ${totalMaJiang2PTableFee}, ${dump_date}),
	(18, ${totalMaJiang4PTableFee}, ${dump_date}),
	(10001, ${texasPokerRobotWinScore}, ${dump_date}),
	(10018, ${niuniuQiangZhuangRobotWinScore}, ${dump_date}),
	(10020, ${niuniuSeenCardRobotWinScore}, ${dump_date}),
	(10049, ${zhaJinHuaRobotWinScore}, ${dump_date}),
	(10097, ${ddzJingDianRobotWinScore}, ${dump_date}),
	(10098, ${ddzHuanLeRobotWinScore}, ${dump_date}),
	(10145, ${guanDanRobotWinScore}, ${dump_date}),
	(10177, ${mj2pRobotWinScore}, ${dump_date}),
	(10178, ${mj4pRobotWinScore}, ${dump_date}),
	(19999, ${totalRobotWinScore}, ${dump_date}),
	(9999, ${totalTableFee}, ${dump_date})
	 on duplicate key update service_fee = values(service_fee)
	"
echo ${sql} | ${MYSQL_CMD} "CASINOGLOBALINFO"
