#!/usr/bin/python
# encoding=utf-8
# Filename: net_is_normal.py
import os
import socket
import subprocess

#判断网络是否正常
server='www.baidu.com'
#检测服务器是否能ping通，在程序运行时，会在标准输出中显示命令的运行信息
def pingServer(server):
    result=os.system('ping '+server+' -c 2')
    if result:
        print '服务器%s ping fail' % server
    else:
        print '服务器%s ping ok' % server
    print result
#把程序输出定位到/dev/null,否则会在程序运行时会在标准输出中显示命令的运行信息  
def pingServerCall(server):
    fnull = open(os.devnull, 'w')
    result = subprocess.call('ping '+server+' -c 2', shell = True, stdout = fnull, stderr = fnull)
    if result:
        print '服务器%s ping fail' % server
    else:
        print '服务器%s ping ok' % server
    fnull.close()

#可用于检测程序是否正常，如检测redis是否正常，即检测redis的6379端口是否正常
#检测ssh是否正常，即检测ssh的22端口是否正常
def check_aliveness(ip, port):
    sk = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sk.settimeout(1)
    try:
        sk.connect((ip,port))
        print 'server %s %d service is OK!' %(ip,port)
        return True
    except Exception:
        print 'server %s %d service is NOT OK!'  %(ip,port)
        return False
    finally:
        sk.close()
    return False

if __name__=='__main__':
    pingServerCall('120.24.164.63')
    #pingServer(server)
    check_aliveness('120.24.164.63', 9102)
    check_aliveness('112.74.89.90', 9102)
    check_aliveness('120.24.249.10', 9102)
    check_aliveness('120.25.101.31', 9102)
    check_aliveness('120.25.153.54', 9102)
    check_aliveness('120.25.60.231', 9102)
    check_aliveness('183.56.162.119', 9102)