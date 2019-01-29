#!/usr/bin/env python
#coding=utf-8

from __future__ import division
import codecs
import sys
import MySQLdb
import datetime
import time
from datetime import datetime
from datetime import timedelta

hisDB = "192.168.1.119"
basetablename="CASINOBINDALIPAYACCOUNT"	
conn= MySQLdb.connect(
        host=hisDB,
        port = 3306,
        user='RoamGame',
        passwd='Xmpx3hTpYujflCgbRkJV1',
        db ='CASINOGAMEHISDB',
        )
cur = conn.cursor()

day0 = datetime.now()

dayx = day0
tableName = basetablename+dayx.strftime('%Y%m%d')
sql = "CREATE TABLE IF NOT EXISTS `"+tableName+"` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `userid` bigint(20) unsigned NOT NULL,  `alipay_account` varchar(128) DEFAULT NULL,  `bind` tinyint(1) NOT NULL DEFAULT '0',  `recordtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  PRIMARY KEY (`id`),  KEY `userid` (`userid`,`recordtime`),  KEY `alipay_account` (`alipay_account`)) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;"
#创建数据表
print sql
cur.execute(sql)

dayx = day0 + timedelta(days=1)
tableName = basetablename+dayx.strftime('%Y%m%d')
sql = "CREATE TABLE IF NOT EXISTS `"+tableName+"` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `userid` bigint(20) unsigned NOT NULL,  `alipay_account` varchar(128) DEFAULT NULL,  `bind` tinyint(1) NOT NULL DEFAULT '0',  `recordtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  PRIMARY KEY (`id`),  KEY `userid` (`userid`,`recordtime`),  KEY `alipay_account` (`alipay_account`)) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;"
#创建数据表
print sql
cur.execute(sql)

dayx = day0 + timedelta(days=2)
tableName = basetablename+dayx.strftime('%Y%m%d')
sql = "CREATE TABLE IF NOT EXISTS `"+tableName+"` (  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `userid` bigint(20) unsigned NOT NULL,  `alipay_account` varchar(128) DEFAULT NULL,  `bind` tinyint(1) NOT NULL DEFAULT '0',  `recordtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  PRIMARY KEY (`id`),  KEY `userid` (`userid`,`recordtime`),  KEY `alipay_account` (`alipay_account`)) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;"
#创建数据表
print sql
cur.execute(sql)

cur.close()
conn.commit()
conn.close()	
	
