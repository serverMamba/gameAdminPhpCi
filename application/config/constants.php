<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//我的常量定义
define('CSS_VERSION', 2011043001);
define('JS_VERSION', 2011043001);
define('SITE_NAME', 'GuoGuo CMS SYSTEM');
define('LOGIN_URI', '');
define('DEFAULT_PAGE_URI', '');

define('DEV_ENV', true);

if (DEV_ENV)
{
	define('DDZ_SERVER_IP','127.0.0.1');
	define('DDZ_SERVER_PORT',9102);
	define('TEXAS_SERVER_IP','127.0.0.1');
	define('TEXAS_SERVER_PORT',9104);
	define('NIUNIU_SERVER_IP','127.0.0.1');
	define('NIUNIU_SERVER_PORT',9103);
	define('ZJH_SERVER_IP','127.0.0.1');
	define('ZJH_SERVER_PORT',9105);
	define('FISH_SERVER_IP','127.0.0.1');
	define('FISH_SERVER_PORT',9106);
	define('ARCADE_SERVER_IP','127.0.0.1');
	define('ARCADE_SERVER_PORT',9107);
	define('MID_SERVER_IP','127.0.0.1');
	define('MID_SERVER_PORT',10004);
	define('HASH_SERVER_IP','127.0.0.1');
	define('HASH_SERVER_PORT',9109);
//	define('DISPATCH_SERVER_IP','127.0.0.1');
    define('DISPATCH_SERVER_IP','192.168.1.58');
	define('DISPATCH_SERVER_PORT',10003);
	define('LHP_SERVER_IP','127.0.0.1');
	define('LHP_SERVER_PORT',12301);
	define('NIUNIUML_SERVER_IP','127.0.0.1');
	define('NIUNIUML_SERVER_PORT',9103);
	define('SANGONG_SERVER_IP','127.0.0.1');
	define('SANGONG_SERVER_PORT',9120);
}
else
{
	define('DDZ_SERVER_IP','192.168.222.2');
	define('DDZ_SERVER_PORT',9102);
	define('TEXAS_SERVER_IP','192.168.222.2');
	define('TEXAS_SERVER_PORT',9104);
	define('NIUNIU_SERVER_IP','192.168.222.2');
	define('NIUNIU_SERVER_PORT',9103);
	define('ZJH_SERVER_IP','192.168.222.2');
	define('ZJH_SERVER_PORT',9105);
	define('FISH_SERVER_IP','192.168.222.2');
	define('FISH_SERVER_PORT',9106);
	define('ARCADE_SERVER_IP','192.168.222.2');
	define('ARCADE_SERVER_PORT',9107);
	define('MID_SERVER_IP','192.168.111.3');
	define('MID_SERVER_PORT',10004);
	define('HASH_SERVER_IP','192.168.222.2');
	define('HASH_SERVER_PORT',9109);
	define('DISPATCH_SERVER_IP','192.168.111.2');
	define('DISPATCH_SERVER_PORT',10004);
	define('LHP_SERVER_IP','13.124.46.158');
	define('LHP_SERVER_PORT',12301);
	define('NIUNIUML_SERVER_IP','192.168.222.2');
	define('NIUNIUML_SERVER_PORT',9103);
	define('SANGONG_SERVER_IP','192.168.222.2');
	define('SANGONG_SERVER_PORT',9120);
}

// 提现订单状态定义
define('CASH_ORDER_STATUS_NEW', 0);		// 新订单
define('CASH_ORDER_STATUS_SUCCESS', 1);	// 提现成功
define('CASH_ORDER_STATUS_FAIL', 2);	// 提现失败
define('CASH_ORDER_STATUS_WAIT_REVIEW', 3);	// 等待审核
define('CASH_ORDER_STATUS_REVIEW_PASS', 4);	// 审核通过
define('CASH_ORDER_STATUS_UNKNOWN', 5);	// 未知状态
define('CASH_ORDER_STATUS_DEALING', 6);	// 处理中
define('CASH_ORDER_STATUS_NOT_COMPLETE', 100); // 未完成(包含0，3，4，5，6)
define('CASH_ORDER_STATUS_ALL', 101); // 全部订单

define('CASH_ORDER_NEED_REVIEW_AMOUNT', 0); // 需要客服手动点击审核通过的提现订单

// 支付平台
define('PAY_PLATFORM_JUBAOYUN', 3);	// 聚宝云
define('PAY_PLATFORM_HUIONE', 4);	// 汇旺
define('PAY_PLATFORM_YUFU', 5);	// 裕付
define('PAY_PLATFORM_CHANGFU', 6);	// 畅付云
define('PAY_PLATFORM_PINFU', 11);	// 品付
define('PAY_PLATFORM_ZFB_LUOKE', 12);	// 支付宝洛客
define('PAY_PLATFORM_CAIHONG', 13);	// 彩虹
define('PAY_PLATFORM_ZFB_JUNYING', 14);	// 支付宝君赢
define('PAY_PLATFORM_ZFB_ZHIHUI', 15);	// 支付宝智慧
define('PAY_PLATFORM_TMPAY', 16);	// TMPay
define('PAY_PLATFORM_ABPAY', 17);	// 爱贝
define('PAY_PLATFORM_YUFU_CARD', 18);	// 裕付卡支付
define('PAY_PLATFORM_ZFB_QIANKUN', 19);	// 支付宝乾坤
define('PAY_PLATFORM_ZFB_TRANSFER', 20);	// 支付宝转账
define('PAY_PLATFORM_ZFB_TRANSFER_WEB', 21);	// 支付宝web转账
define('PAY_PLATFORM_CHANGFU_CARD', 22);	// 畅付卡支付
define('PAY_PLATFORM_ZFB_ZGY', 23);	// 支付宝众根源
define('PAY_PLATFORM_ZFB_YD', 24);	// 支付宝勇度
define('PAY_PLATFORM_ZFB_LEIZ', 25);	// 支付宝雷正
define('PAY_PLATFORM_ZFB_LONGZ', 26);	// 支付宝龙泽
define('PAY_PLATFORM_ZFB_MYW', 27);	// 支付宝蚂蚁王
define('PAY_PLATFORM_ZFB_SHDKJ', 28);	// 支付宝盛恒达科技
define('PAY_PLATFORM_ZFB_SKLKJ', 29);	// 支付宝顺科利科技
define('PAY_PLATFORM_JMPAY', 30);	// 聚米支付
define('PAY_PLATFORM_WEIPAY', 31);	// 微派支付
define('PAY_PLATFORM_KAIXIN', 32); // 凯新支付
define('PAY_PLATFORM_ZHONGTIETONG',33);  // 中铁通付
define('PAY_PLATFORM_ZHONGTIETONG_QQ',34);  // 中铁通付qq
define('PAY_PLATFORM_FANQIE',35);  // 番茄支付
define('PAY_PLATFORM_LUYI', 36); //路易支付
define('PAY_PLATFORM_CHANGCHENGYUN',37);//长城云支付
define('PAY_PLATFORM_ZFB_HYXXKJ',38); //支付宝汇亿信息科技
define('PAY_PLATFORM_ZFB_HCWLKJ',39); //支付宝宏潮网络科技
define('PAY_PLATFORM_ZFB_PXWLKJ',40); //支付宝鹏兴网络科技
define('PAY_PLATFORM_ZFB_XWWLKJ',41); //支付宝兴旺网络科技
define('PAY_PLATFORM_ZFB_XQXXKJ',42); //支付宝星祺信息科技
define('PAY_PLATFORM_ZFB_CYXXKJ',43); //支付宝长远信息科技
define('PAY_PLATFORM_ZFB_TSWLKJ',44); //支付宝天胜网络科技
define('PAY_PLATFORM_ZFB_JKWLKJ',45); //支付宝吉凯网络科技
define('PAY_PLATFORM_ZFB_XHWLKJ',46); //支付宝星瀚网络科技
define('PAY_PLATFORM_JUHE',47);//聚合支付
define('PAY_PLATFORM_HUIYI',48);//汇亿支付
define('PAY_PLATFORM_LUYI_QQWAP',49);//路易QQWAP
define('PAY_PLATFORM_ZFB_CSXXKJ',50);//支付宝常胜信息科技
define('PAY_PLATFORM_CHANGCHENGQQH5',51);//长城QQ钱包
define('PAY_PLATFORM_HAIFUPAY',52); //海富支付
define('PAY_PLATFORM_ZFB_CHWLKJ',53);//支付宝晨海网络科技
define('PAY_PLATFORM_ZFB_HYWLKJ',54); //支付宝红英网络科技
define('PAY_PLATFORM_ZFB_FBWLKJ',55); //支付宝风暴网络科技
define('PAY_PLATFORM_ZFB_MYWLKJ',56); //支付宝明月网络科技
define('PAY_PLATFORM_ZFB_WXWLKJ',57); //支付宝温馨网络科技
define('PAY_PLATFORM_HUICHAO_ALI',58); //汇潮支付
define('PAY_PLATFORM_DUODEBAO_ALI',59); //多得宝支付
define('PAY_PLATFORM_WEIQQ', 60);	// 微派QQ钱包
define('PAY_PLATFORM_ZFB_DETXXKJ', 61);	// 支付宝达尔特信息科技
define('PAY_PLATFORM_ZFB_KSYLWLKJ', 62);	// 支付宝凯盛亚利网络科技
define('PAY_PLATFORM_ZFB_OTGYWLKJ', 63);	// 支付宝欧特格雅网络科技
define('PAY_PLATFORM_LUYI_QQ99', 64);	// 路易QQ99
define('PAY_PLATFORM_LUYI_JD155', 65);	// 路易JD155
define('PAY_PLATFORM_CHANGCHENGYUN_JD', 66);	//长城云京东
define('PAY_PLATFORM_CHANGCHENGYUN_WX', 67);	//长城云微信
define('PAY_PLATFORM_YISHENG_JD', 68);	//易生京东
define('PAY_PLATFORM_ZFB_MJXXKJ',69); //支付宝淼吉信息科技
define('PAY_PLATFORM_ZFB_YYWLKJ',70); //支付宝盈悦网络科技
define('PAY_PLATFORM_ZFB_XSWLKJ',71); //支付宝晓胜网络科技
define('PAY_PLATFORM_JFT',72); //竣付通
define('PAY_PLATFORM_CHANGCHENGYUN_BANK', 73);	//长城云银联
define('PAY_PLATFORM_WEIPAY_5', 74);	// 微派支付
define('PAY_PLATFORM_ZFB_LGWLKJ',75); 	//广州流光网络科技有限公司
define('PAY_PLATFORM_DSPAY',76); 	//得仕支付
define('PAY_PLATFORM_ZFB_MENJUNWLKJ',77); // 梦君网络科技
define('PAY_PLATFORM_ZHIHUIFU',79); // 智汇付
define('PAY_PLATFORM_JUHENEW', 80);// 新聚合支付
define('PAY_PLATFORM_GUANGDA', 81);// 光大支付
define('PAY_PLATFORM_OFDSC', 82);// OF商城
define('PAY_PLATFORM_WEIJD', 83);	// 微派京东
define('PAY_PLATFORM_ZHJH', 84);	// 兆行聚合
define('PAY_PLATFORM_IMPAY', 85);	// im支付
define('PAY_PLATFORM_JMWXPAY', 86);	// 聚米微信
define('PAY_PLATFORM_PAIPAY', 87);	// 派支付
define('PAY_PLATFORM_PFWXSM', 88);	// 品付微信扫码
define('PAY_PLATFORM_WEENPAY', 89);	// ween支付
define('PAY_PLATFORM_ZFB_GZJXXXJS', 90); // 广州爵星信息技术有限公司
define('PAY_PLATFORM_RONGYINPAY', 91);	// 蓉银支付
define('PAY_PLATFORM_JKWLKJ', 92);	//会昶支付
define('PAY_PLATFORM_BLKYJF', 93);	//80卡云计费
define('PAY_PLATFORM_GXZF', 94);	//广讯支付
define('PAY_PLATFORM_BLKYJF_QQ', 95);	//80卡云计费QQ
define('PAY_PLATFORM_JSF_ZFB', 96);	//及时付支付宝
define('PAY_PLATFORM_JSF_BANK', 97);	//及时付银联
define('PAY_PLATFORM_HFT_ZFB', 98);	//合付通支付宝
define('PAY_PLATFORM_PROMOTION', 99);	//推广代理充值
define('PAY_PLATFORM_JHT_ZFB', 100);	//金汇通
define('PAY_PLATFORM_YUNBEI_ZFB', 101);	//云贝支付宝
define('PAY_PLATFORM_MOSHANG_ZFB', 102);	//陌上支付宝
define('PAY_PLATFORM_YBNEW_ZFB', 103);	//云贝新支付
define('PAY_PLATFORM_WEEN_ZFB', 104);	//WEEN支付宝
define('PAY_PLATFORM_YR_ZFB', 105);	// 永仁支付宝
define('PAY_PLATFORM_521JB_ZFB', 106);	// 521jb支付宝

// 订单状态的宏
define("ORDER_STATUS_NEW", 0);
define("ORDER_STATUS_SUCCESS", 1);
define("ORDER_STATUS_FAIL", 2);
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
/* End of file constants.php */
/* Location: ./application/config/constants.php */


/**
 * 用户管理
 */

// 投注记录表, 游戏id => 表
const gameHistoryTables = [
    1 => 'casinogamerecord_texaspoker_',
    18 => 'casinogamerecord_niuniuqiangzhuang_',
    20 => '',
    21 => 'casinogamerecord_bairenniuniu_',
    49 => 'casinogamerecord_zjh_',
    52 => '',
    97 => 'casinogamerecord_ddz_',
    98 => 'casinogamerecord_ddzhuanle_',
    161 => '',
    162 => '',
    321 => '',
    350 => '',
    351 => '',
    352 => ''
];

// 百人游戏底分, 数据库中格式: 真实底分 * 100
const baiRenBaseScore = 100;

// 游戏id
const gameIdTexasPokerPuTong = 1; // 德州扑克
const gameIdNiuNiuQiangZhuang = 18; // 抢庄牛牛
const gameIdNiuNiuSeenCardQZ = 20; // 看牌牛牛
const gameIdNiuNiuBaiRen = 21; // 百人牛牛
const gameIdZhaJinHua = 49; // 炸金花
const gameIdRedBlack = 52; // 红黑大战
const gameIdDouDiZhu = 97; // 经典斗地主
const gameIdDouDiZhuHuanLe = 98; // 欢乐斗地主
const gameIdShiSanZhang = 161; // 十三水
const gameIdShiSanZhang_5 = 162; // 十三水_5色
const gameIdPaoDeKuai = 321; // 跑得快
const gameIdBenChiBaoMa = 350; // 奔驰宝马
const gameIdDragonTiger = 351; // 龙虎斗
const gameIdBaiJiaLe = 352; // 百家乐
const gameId28Gang = 8888; // 二八杠 todo 暂无
const gameIdSanGong = 8889; // 三公 todo 暂无


// 游戏id => 游戏名
const gameIdName = [
    gameIdTexasPokerPuTong => '德州扑克',
    gameIdNiuNiuQiangZhuang => '抢庄牛牛',
    gameIdNiuNiuSeenCardQZ => '看牌牛牛',
    gameIdNiuNiuBaiRen => '百人牛牛',
    gameIdZhaJinHua => '炸金花',
    gameIdRedBlack => '红黑大战',
    gameIdDouDiZhu => '经典斗地主',
    gameIdDouDiZhuHuanLe => '欢乐斗地主',
    gameIdShiSanZhang => '十三水',
    gameIdShiSanZhang_5 => '十三水_5色',
    gameIdPaoDeKuai => '跑得快',
    gameIdBenChiBaoMa => '奔驰宝马',
    gameIdDragonTiger => '龙虎斗',
    gameIdBaiJiaLe => '百家乐',
    gameId28Gang => '二八杠',
    gameIdSanGong => '三公'
];

const maxQueryNum = 30; // 最大查询数量

const daySeconds = 86400; // 一天的秒数

