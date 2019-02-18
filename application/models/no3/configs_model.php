<?php

if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Configs_model extends CI_Model {
    var $totaldb = null;

    public function __construct() {
        parent::__construct();
    }

    public function get_navmenu() {
        $nav_menu ["运维管理"] = array(
            "url" => "#",
            "ns" => "ywgl",
            "cls" => "icon-desktop",
            "child" => array(
// 						array (
// 								"name" => "系统监控",
// 								"ns" => "ywgl_xitongjiankong",
// 								"url" => site_url('no3/xitongjiankong'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "Proxy服务器切换",
// 								"ns" => "ywgl_proxyfordds",
// 								"url" => site_url('no3/proxyfordds'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "js系统打包升级管理",
// 								"ns" => "ywgl_jzsd",
// 								"url" => site_url('no3/typegame'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "apk渠道包生成系统",
// 								"ns" => "ywgl_fjsd",
// 								"url" => site_url('no3/typeroom'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "gamesever切换",
// 								"ns" => "ywgl_switch",
// 								"url" => site_url('no3/typeserver'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "版本控制",
// 								"ns" => "ywgl_version",
// 								"url" => site_url('no3/typeversion'),
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "管理员列表",
                    "ns" => "amdin_list_manage",
                    "url" => site_url('no3/admin/adminList'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "角色列表",
                    "ns" => "admin_priv",
                    "url" => site_url('no3/role/roleList'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "管理员登录日志",
                    "ns" => "admin_login_log",
                    "url" => site_url('no3/admin/loginLog'),
                    "cls" => "icon-double-angle-right"
                ),
            )
        );
        $nav_menu ["财务管理"] = array(
            "url" => "#",
            "ns" => "yygl",
            "cls" => "icon-double-angle-right",
            "child" => array(
                array(
                    "name" => "财务统计",
                    "ns" => "cwtj",
                    "url" => site_url('no3/finStatistics'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "支付统计",
                    "ns" => "paycwtj",
                    "url" => site_url('no3/payStatistics'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "提现总额统计",
                    "ns" => "cwgl_withdrawal_total",
                    "url" => site_url('no3/withdrawalTotal'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "运营统计",
                    "ns" => "yingyingtongji",
                    "url" => site_url('no3/caiwuReport'),
                    "cls" => "icon-double-angle-right"
                ), array(
                    "name" => "对账统计",
                    "ns" => "duizhangtongji",
                    "url" => site_url('no3/duizhangReport'),
                    "cls" => "icon-double-angle-right"
                ), array(
                    "name" => "代付帐户管理",
                    "ns" => "cwgl_card",
                    "url" => site_url('task/cardmgr'),
                    "cls" => "icon-double-angle-right"
                ), array(
                    "name" => "代付订单管理",
                    "ns" => "cwgl_task",
                    "url" => site_url('task/taskmgr'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家订单查询",
                    "ns" => "kfgl_wjddcx",
                    "url" => site_url('no3/infodindan'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "提现订单",
                    "ns" => "cash_order",
                    "url" => site_url('no3/cashOrder'),
                    "cls" => "icon-double-angle-right"
                ),
            )
        );
        $nav_menu ["运营管理"] = array(
            "url" => "#",
            "ns" => "yygl",
            "cls" => "icon-double-angle-right",
            "child" => array(
                array(
                    "name" => "系统公告",
                    "ns" => "yygl_xtgg",
                    "url" => site_url('no3/sysnotice'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "系统维护",
                    "ns" => "yygl_xtwh",
                    "url" => site_url('no3/sysmaintenance'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "系统广播",
// 								"ns" => "yygl_xtgb",
// 								"url" => "castgb.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "活动设定",
// 								"ns" => "yygl_hdsd",
// 								"url" => "castactive.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "任务设定",
// 								"ns" => "yygl_rwsd",
// 								"url" => "casttask.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "游戏消息",
// 								"ns" => "yygl_gamemessage",
// 								"url" => "gamemessagecct.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "斗地主比赛场奖项",
// 								"ns" => "yygl_gameddzbisai1",
// 								"url" => "gameddzbisai1.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "斗地主比赛场",
// 								"ns" => "yygl_gameddzbisai",
// 								"url" => "gameddzbisai.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "斗地主升级管理",
// 								"ns" => "yygl_gameddzupload",
// 								"url" => "gameddzupload.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "斗地主排行奖励",
// 								"ns" => "yygl_gameddzpaihang",
// 								"url" => "gameddzpaihang.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "销售商品管理",
// 								"ns" => "yygl_xsspgl",
// 								"url" => "castgood.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "实物订单管理(话费)",
// 								"ns" => "yygl_swddgl",
// 								"url" => "castshoporder.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "实物订单管理(实物)",
// 								"ns" => "yygl_swddglsw",
// 								"url" => "castshopordersw.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "一元话费管理",
// 								"ns" => "yygl_yyhfgl",
// 								"url" => "castshoporder1.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "卡密管理管理",
// 								"ns" => "yygl_kamigl",
// 								"url" => "castkami.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "广告墙开关",
// 								"ns" => "yygl_ggqsd",
// 								"url" => "castadv.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "新广告墙开关",
// 								"ns" => "yygl_nggqsd",
// 								"url" => "castnewadv.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "js平台升级版本管理",
// 								"ns" => "yygl_jsupload",
// 								"url" => "jsversion.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "js平台升级版本管理EX",
// 								"ns" => "yygl_jsupload",
// 								"url" => "jsversionex.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "IOS升级服务器管理",
// 								"ns" => "yygl_ioszhenbaoshenji",
// 								"url" => "packetupgradeios.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "整包升级服务器管理",
                    "ns" => "yygl_zhenbaoshenji",
                    "url" => site_url('no3/packetupgrade'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "模块升级服务器管理",
                    "ns" => "yygl_mokuaishenji",
                    "url" => site_url('no3/packetmodel'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "游戏开关管理",
                    "ns" => "yygl_gameswitch",
                    "url" => site_url('no3/gameswitch'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "转账支付宝管理",
                    "ns" => "yygl_alipaytransfer",
                    "url" => site_url('no3/alipaytransferswitch'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "支付管理",
                    "ns" => "yygl_formalalipay",
                    "url" => site_url('no3/alipayformal'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "Proxy IP管理",
                    "ns" => "proxy_ip",
                    "url" => site_url('no3/proxyIp'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "代理帐号管理",
                    "ns" => "agent_account",
                    "url" => site_url('no3/agentAccount'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "紧急停服",
                    "ns" => "stop_server",
                    "url" => site_url('no3/stopServer'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "增加金币记录",
                    "ns" => "yygl_chipslog",
                    "url" => site_url('no3/chipslog'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "绑定手机记录",
                    "ns" => "yygl_bindphonelog",
                    "url" => site_url('no3/bindphonelog'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "绑定支付宝记录",
                    "ns" => "yygl_bindaliaccountlog",
                    "url" => site_url('no3/bindaliaccountlog'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "禁止支付管理",
                    "ns" => "yygl_paylimit",
                    "url" => site_url('no3/paylimit'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "帐号及充值查询",
                    "ns" => "kfgl_rechargesee",
                    "url" => site_url('no3/rechargesee'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "充领开关",
                    "ns" => "yygl_chonglingswitch",
                    "url" => site_url('no3/chonglingswitch'),
                    "cls" => "icon-double-angle-right"
                )
            )
        );
        $nav_menu ["推广管理"] = array(
            "url" => "#",
            "ns" => "tggl",
            "cls" => "icon-double-angle-right",
            "child" => array(
                array(
                    "name" => "推广账号",
                    "ns" => "tg_account",
                    "url" => site_url('no3/tgAccount'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "推广信用金日志",
                    "ns" => "tg_agentblancelog",
                    "url" => site_url('no3/tgAgentBlanceLog'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "推广统计",
                    "ns" => "tg_account_promotion",
                    "url" => site_url('no3/tgPromotion'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "推广ID修正",
                    "ns" => "tg_correction",
                    "url" => site_url('no3/tgCorrection'),
                    "cls" => "icon-double-angle-right"
                )
            )
        );
        $nav_menu ["用户管理"] = array(
            "url" => "#",
            "ns" => "tggl",
            "cls" => "icon-double-angle-right",
            "child" => array(
                array(
                    "name" => "用户列表",
                    "ns" => "userList",
                    "url" => site_url('no3/userList'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "用户登录日志",
                    "ns" => "userLoginLog",
                    "url" => site_url('no3/userLoginLog'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "用户标签",
                    "ns" => "userTag",
                    "url" => site_url('no3/userTag'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "用户等级",
                    "ns" => "userLv",
                    "url" => site_url('no3/userLv'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "投注记录",
                    "ns" => "userBetRecord",
                    "url" => site_url('no3/userBetRecord'),
                    "cls" => "icon-double-angle-right"
                )
            )
        );
        $nav_menu ["运营报表"] = array(
            "url" => "#",
            "ns" => "yybb",
            "cls" => "icon-list",
            "child" => array(
                // array("name"=>"运营渠道分析","ns"=>"yybb_yyqdfx"
                // ,"url"=>"reportanaly.html","cls"=>"icon-double-angle-right"),
                // array("name"=>"运营渠道管理","ns"=>"yybb_yyqdgl"
                // ,"url"=>"reportmanage.html","cls"=>"icon-double-angle-right"),
                array(
                    "name" => "运营数据总表",
                    "ns" => "yybb_yysjzb",
                    "url" => site_url('no3/reporttotal'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "充提抽水曲线",
                    "ns" => "yybb_pccsj",
                    "url" => site_url('no3/reportpcchis'),
                    "cls" => "icon-double-angle-right"
                ),
                /* array (
                        "name" => "userpaycash",
                        "ns" => "yybb_userpaycash",
                        "url" => site_url('no3/userpaycash'),
                        "cls" => "icon-double-angle-right"
                ), */
                array(
                    "name" => "渠道统计",
                    "ns" => "yybb_qdtj",
                    "url" => site_url('no3/channelFinancialStatistics'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "运营数据总表(月)",
// 								"ns" => "yybb_yysjzbm",
// 								"url" => "reporttotalm.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						// array("name"=>"平台数据总表","ns"=>"yybb_ptsjzb"
// 						// ,"url"=>"reportsys.html","cls"=>"icon-double-angle-right"),
// 						array (
// 								"name" => "游戏数据报表",
// 								"ns" => "yybb_yxsjbb",
// 								"url" => "reportgame.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "捕鱼运营总表",
                    "ns" => "yybb_buyyzb",
                    "url" => site_url('no3/wanshunfish8'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "电玩城运营总表",
                    "ns" => "yybb_buyyzb",
                    "url" => site_url('no3/wanshunfish8dw'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "当前在线人数",
                    "ns" => "yybb_ddzxrs",
                    "url" => site_url('no3/reportonline'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "历史在线人数",
                    "ns" => "yybb_lszxsj",
                    "url" => site_url('no3/reporthis'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼历史在线人数",
                    "ns" => "yybb_bulizxs",
                    "url" => site_url('no3/reporthisfish'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "历史链接人数",
// 								"ns" => "yybb_lsljsj",
// 								"url" => "reportlink.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "金豆和保险箱变化表",
                    "ns" => "yybb_coffee",
                    "url" => site_url('no3/reportcoffee'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "充值数据分析",
// 								"ns" => "yybb_czsjfx",
// 								"url" => "reportmoney.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "商城报表",
// 								"ns" => "yybb_scbb",
// 								"url" => "reportshop.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						// array("name"=>"输赢机器人统计","ns"=>"yybb_syjqr"
// 						// ,"url"=>"reportsyjqr.html","cls"=>"icon-double-angle-right"),
// 						array (
// 								"name" => "净分统计",
// 								"ns" => "yybb_cstj",
// 								"url" => site_url('no3/reportcs'),
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "月充值统计",
// 								"ns" => "yybb_ycztj",
// 								"url" => "reportycz.html",
// 								"cls" => "icon-double-angle-right" 
// 						),

// 						array (
// 								"name" => "玩家每日净分分布",
// 								"ns" => "yybb_wanshun1",
// 								"url" => "wanshun1.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家每日净分排名100名",
// 								"ns" => "yybb_wanshun2",
// 								"url" => "wanshun2.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "金豆和兑换卷全服分布",
// 								"ns" => "yybb_wanshun3",
// 								"url" => "wanshun3.html",
// 								"cls" => "icon-double-angle-right" 
// 						),

// 						array (
// 								"name" => "游戏净分排名",
// 								"ns" => "yybb_wanshun4",
// 								"url" => "wanshun4.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "充值贡献度排名",
// 								"ns" => "yybb_wanshun5",
// 								"url" => "wanshun5.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "游戏版本运营数据分析",
// 								"ns" => "yybb_wanshun8",
// 								"url" => "wanshun8.html",
// 								"cls" => "icon-double-angle-right" 
// 						) 
                array(
                    "name" => "充值数据统计",
                    "ns" => "recharge_statistics",
                    "url" => site_url('no3/rechargeStatistsics'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "提现数据统计",
// 								"ns" => "order_statistics",
// 								"url" => site_url('no3/orderStatistics'),
// 								"cls" => "icon-double-angle-right"
// 						),
// 						array (
// 								"name" => "用户数据统计",
// 								"ns" => "user_statistics",
// 								"url" => site_url('no3/userStatistics'),
// 								"cls" => "icon-double-angle-right"
// 						),
                array(
                    "name" => "客服数据统计",
                    "ns" => "kefu_statistics",
                    "url" => site_url('no3/kefuStatistsics'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家IP区域统计",
                    "ns" => "user_areaStatisticsChannel",
                    "url" => site_url('no3/areaStatisticsChannel'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "充值提现记录",
                    "ns" => "yybb_charge_withdrawal",
                    "url" => site_url('no3/userchargewithdrawal'),
                    "cls" => "icon-double-angle-right"
                ),

            )
        );
        $nav_menu ["客服管理"] = array(
            "url" => "#",
            "ns" => "kfgl",
            "cls" => "icon-edit",
            "child" => array(
                array(
                    "name" => "用户信息管理",
                    "ns" => "kfgl_wjxxxx",
                    "url" => site_url('no3/infodetail'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "用户注册列表",
                    "ns" => "register_list",
                    "url" => site_url('no3/userRegisterList'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "黑名单信息管理",
                    "ns" => "kfgl_hmdjl",
                    "url" => site_url('no3/infoblack'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家游戏记录",
                    "ns" => "kfgl_wjyyjl",
                    "url" => site_url('no3/inforecord'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "玩家竞分报表",
// 								"ns" => "kfgl_wjjfbg",
// 								"url" => "infojinfen.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家PK赛记录",
// 								"ns" => "kfgl_wjpksjl",
// 								"url" => "infopk.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家话费赛记录",
// 								"ns" => "kfgl_wjhfsjl",
// 								"url" => "infohf.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "玩家金豆变化记录",
                    "ns" => "kfgl_wjjdbh",
                    "url" => site_url('no3/infojindubianhua'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家金豆变化(24小时内)",
                    "ns" => "kfgl_wjjdbh_gs",
                    "url" => site_url('no3/infojindoubianhua_gs'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "玩家赠送记录",
// 								"ns" => "kfgl_wjzsjl",
// 								"url" => "infogive.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "宝盒赠送记录",
// 								"ns" => "kfgl_byzszsjl",
// 								"url" => "infogivefish.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "幸运抽奖记录",
// 								"ns" => "kfgl_xycjjl",
// 								"url" => "infogivefishjiang.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家赠送记录排行",
// 								"ns" => "kfgl_wjzsjlph",
// 								"url" => "infogive1.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家输赢记录排行",
// 								"ns" => "kfgl_wjsyjlph",
// 								"url" => "infogive2.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家兑换记录",
// 								"ns" => "kfgl_wjdhjl",
// 								"url" => "infoexchange.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家任务记录",
// 								"ns" => "kfgl_wjrwjl",
// 								"url" => "infotask.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家商城记录",
// 								"ns" => "kfgl_wjscjl",
// 								"url" => "infoshop.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "大玩家充值排名",
// 								"ns" => "kfgl_dwjczpm",
// 								"url" => "infogreatplay.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
                array(
                    "name" => "支付宝转账订单审核",
                    "ns" => "kfgl_zfg_transfer",
                    "url" => site_url('no3/alipaytransfercheck'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "支付宝转账出错报告",
                    "ns" => "kfgl_zfg_transfer_fail_report",
                    "url" => site_url('no3/alipaytransfer_failreport'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "支付宝转账卡号卡密",
                    "ns" => "kfgl_alipay_transfer_card",
                    "url" => site_url('no3/alipaytransfercard'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "客户端缺陷工单",
                    "ns" => "kfgl_clientbug",
                    "url" => site_url('no3/clientbug'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "玩家充值排行",
// 								"ns" => "kfgl_wjczph",
// 								"url" => "infomoney.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家金豆排行",
// 								"ns" => "kfgl_wjjdph",
// 								"url" => "infojindu.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "玩家等级排行",
// 								"ns" => "kfgl_wjdjph",
// 								"url" => "infolevel.html",
// 								"cls" => "icon-double-angle-right" 
// 						),
// 						array (
// 								"name" => "开洗分记录",
// 								"ns" => "kfgl_kxfjl",
// 								"url" => "infokaixi.html",
// 								"cls" => "icon-double-angle-right" 
// 						) ,
                array(
                    "name" => "举报管理",
                    "ns" => "user_report",
                    "url" => site_url('no3/userReport'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "在线客服",
                    "ns" => "kefu_chat",
                    "url" => site_url('no3/chat'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "提现支付宝管理",
                    "ns" => "yygl_alipaycashmgr",
                    "url" => site_url('task/alipaycashswtichmgr'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "参数设置",
                    "ns" => "param_config",
                    "url" => site_url('no3/paramConfig'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "支付宝黑名单",
                    "ns" => "black_alipay",
                    "url" => site_url('no3/alipayBlackList'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "自动回复设置",
                    "ns" => "chat_auto_reply",
                    "url" => site_url('no3/chatAutoReply'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "游戏代理查询",
                    "ns" => "yygl_gameagentapply",
                    "url" => site_url('no3/gameagentapply'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "客服手工充值",
                    "ns" => "kefu_recharge",
                    "url" => site_url('no3/brecharge'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "客服手工充值查询",
                    "ns" => "kefu_recharge_list",
                    "url" => site_url('no3/brechargel'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "客服代理充值注册",
                    "ns" => "kfgl_dailipay",
                    "url" => site_url('no3/dailipaymgr'),
                    "cls" => "icon-double-angle-right"
                ),
// 						array (
// 								"name" => "支付账号",
// 								"ns" => "pay_config",
// 								"url" => site_url('no3/payConfig'),
// 								"cls" => "icon-double-angle-right"
// 						)
            )

        );

        $nav_menu ["捕鱼项目"] = array(
            "url" => "#",
            "ns" => "buyuxianmu",
            "cls" => "icon-edit",
            "child" => array(
                array(
                    "name" => "捕鱼游戏记录",
                    "ns" => "yybb_wanshunfish1",
                    "url" => site_url('no3/wanshunfish1'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼使用技能记录",
                    "ns" => "yybb_wanshunfish2",
                    "url" => site_url('no3/wanshunfish2'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼解锁炮台记录",
                    "ns" => "yybb_wanshunfish3",
                    "url" => site_url('no3/wanshunfish3'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼使用互动表情记录",
                    "ns" => "yybb_wanshunfish4",
                    "url" => site_url('no3/wanshunfish4'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家使用宝盒记录",
                    "ns" => "yybb_wanshunfish5",
                    "url" => site_url('no3/wanshunfish5'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "掉落道具记录",
                    "ns" => "yybb_wanshunfish6",
                    "url" => site_url('no3/wanshunfish6'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "钻石报表",
                    "ns" => "yybb_zsbb",
                    "url" => site_url('no3/wanshunfish7'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "玩家意见统计",
                    "ns" => "yybb_wanjiayijian",
                    "url" => site_url('no3/wanshunfish9'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼任务查询",
                    "ns" => "yybb_puyurenwuchaxun",
                    "url" => site_url('no3/wanshunfish10'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "一网打尽翻翻乐查询",
                    "ns" => "yybb_yiwandajin",
                    "url" => site_url('no3/wanshunfish11'),
                    "cls" => "icon-double-angle-right"
                ),
                array(
                    "name" => "捕鱼大厅钻石抽奖查询",
                    "ns" => "yybb_puyudatinzhshi",
                    "url" => site_url('no3/wanshunfish12'),
                    "cls" => "icon-double-angle-right"
                )
            )
        );

//        $nav_menu ["电玩城项目"] = array(
//            "url" => "#",
//            "ns" => "dianwanchengxianmu",
//            "cls" => "icon-edit",
//            "child" => array(
//                array(
//                    "name" => "抽水监控",
//                    "ns" => "dwcxianmu_choushui",
//                    "url" => site_url('no3/arcadechoushui'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "水果机游戏记录",
//                    "ns" => "dwcxianmu_wanshunfish1",
//                    "url" => site_url('no3/wanshunfish1dw'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "水果机猜大小记录",
//                    "ns" => "dwcxianmu_wanshunfish2",
//                    "url" => site_url('no3/wanshunfish2dw'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "寻宝记录",
//                    "ns" => "dwcxianmu_wanshunfish3",
//                    "url" => site_url('no3/wanshunfish3dw'),
//                    "cls" => "icon-double-angle-right"
//                )
//            )
//
//        );
//
//        $nav_menu ["平安游戏项目"] = array(
//            "url" => "#",
//            "ns" => "lhpxiangmu",
//            "cls" => "icon-edit",
//            "child" => array(
//                /**
//                 * array (
//                 * "name" => "抽水监控",
//                 * "ns" => "lhp_choushui",
//                 * "url" => site_url('no3/lhpchoushui'),
//                 * "cls" => "icon-double-angle-right"
//                 * ),
//                 * array (
//                 * "name" => "连环炮游戏记录",
//                 * "ns" => "lhp_gamerecord",
//                 * "url" => site_url('no3/lhpgamerecord'),
//                 * "cls" => "icon-double-angle-right"
//                 * ),
//                 * array (
//                 * "name" => "运营总表",
//                 * "ns" => "lhp_operation_summary",
//                 * "url" => site_url('no3/lhpoperation'),
//                 * "cls" => "icon-double-angle-right"
//                 * ),**/
//                array(
//                    "name" => "游戏开关",
//                    "ns" => "lhp_gameswitch",
//                    "url" => site_url('no3/lhpgameswitch'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "财务统计",
//                    "ns" => "lhp_cwtongji",
//                    "url" => site_url('no3/lhpcaiwuReport'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "玩家兑换统计",
//                    "ns" => "lhp_golduser",
//                    "url" => site_url('no3/lhpgolduser'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "金币兑换记录",
//                    "ns" => "lhp_goldrecord",
//                    "url" => site_url('no3/lhpgoldrecord'),
//                    "cls" => "icon-double-angle-right"
//                ),
//                array(
//                    "name" => "金币兑换曲线",
//                    "ns" => "lhpgold_statistics",
//                    "url" => site_url('no3/lhpgoldStatistsics'),
//                    "cls" => "icon-double-angle-right"
//                ),
//            )
//
//        );


        // $nav_menu["渠道管理"] =array("url"=>"qudao.html","cls"=>"icon-edit");
        // $nav_menu["合作伙伴"] =array("url"=>"hezuo.html","cls"=>"icon-list-alt");

        return $nav_menu;
    }
}
