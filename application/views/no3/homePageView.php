<!DOCTYPE html>
<html lang="en">

<style>
    ul {
        /*float: left;*/
        /*width: 100px;*/
    }

    li {
        list-style: none;
    }
</style>
<?php $this->load->view('no3/common/header'); ?>

<body>
<?php $this->load->view('no3/common/message'); ?>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#"> <span
                    class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {
                }
            </script>

            <?php $this->load->view('no3/common/nav_shortcut'); ?>

            <?php $this->load->view('no3/common/nav_left1'); ?>

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left"
                   data-icon1="icon-double-angle-left"
                   data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
        </div>

        <div class="main-content">
            <?php $this->load->view('no3/common/nav_top'); ?>

            <div class="page-content">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success"
                         role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger"
                         role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 widget-container-span">
                                <div class="widget-box">
                                    <div class="widget-toolbox padding-8 clearfix">

                                        <table style="width: 100%;">
                                            <tr>
                                                <td valign="top">
                                                    <ul>
                                                        <li>游戏总营收:</li>
                                                    </ul>
                                                </td>

                                                <td valign="top">
                                                    <ul>
                                                        <li>总充值:</li>
                                                        <li>总ARPPU:</li>
                                                        <li>总付费率:</li>
                                                    </ul>
                                                </td>

                                                <td valign="top">
                                                    <ul>
                                                        <li>总兑换:</li>
                                                        <li>总兑换税收:</li>
                                                        <li>总游戏税收:</li>
                                                    </ul>
                                                </td>

                                                <td valign="top">
                                                    <ul>
                                                        <li>总税收:</li>
                                                        <li>百人牛牛总输赢:</li>
                                                        <li>捕鱼系统总输赢:</li>
                                                    </ul>
                                                </td>

                                                <td valign="top">
                                                    <ul>
                                                        <li>总注册:</li>
                                                        <li>总游客账号:</li>
                                                        <li>总正式账号:</li>
                                                    </ul>
                                                </td>

                                                <td valign="top">
                                                    <ul>
                                                        <li>总系统赠送金币:</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </table>

                                        <form action="<?php echo site_url('no3/cashOrder/index'); ?>" id="form"
                                              method="post">

                                            <div style="margin-bottom: 20px; margin-top: 20px; clear:both;">

                                                <div style="float:left; margin-right: 10px; height:34px;width:220px;">
                                                    <span style="margin-right: 10px">渠道</span>
                                                    <select name="channelId" id="channelId"
                                                            style="margin-left: 0px; width: 120px;height: 34px">
                                                        <option value="-1">全部</option>
                                                        <?php foreach ($channelList as $k => $v) {
                                                            if (isset($query['channelId']) && intval($k) === intval($query['channelId'])) {
                                                                ?>
                                                                <option value="<?php echo $k; ?>"
                                                                        selected><?php echo $v; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                统计时间<input value="<?php if ($query['dateTimeBegin']) {
                                                    echo $query['dateTimeBegin'];
                                                } ?>" name="dateTimeBegin" id="dateTimeBegin" placeholder="开始时间"
                                                           type="datetime-local"
                                                           style="margin-left:5px;height:34px;width:220px;"/>
                                                至<input value="<?php if ($query['dateTimeEnd']) {
                                                    echo $query['dateTimeEnd'];
                                                } ?>" name="dateTimeEnd" id="dateTimeEnd" placeholder="终止时间"
                                                        type="datetime-local"
                                                        style="margin-left:5px;height:34px;width:220px;"/>

                                                <button onclick="javascript:onSearch1(1)"
                                                        class="btn btn-xs btn-success "
                                                        style="margin-top:3px;">
                                                    <span class="bigger-110">查询</span>
                                                </button>

                                                <button onclick="javascript:onSearch1(2)"
                                                        class="btn btn-xs btn-success "
                                                        style="margin-top:3px;">
                                                    <span class="bigger-110">导出</span>
                                                </button>
                                            </div>
                                        </form>

                                        <div style="margin-bottom: 0px">
                                            <button onclick="javascript:onQuickSearch(1)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">今日</span>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(2)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">昨日</span>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(3)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">本周</span>
                                            </button>
                                        </div>

                                        <div style="margin-bottom: 20px">
                                            <button onclick="javascript:onQuickSearch(4)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">上周</span>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(5)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">本月</span>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(6)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">上月</span>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main" style="padding: 0;">
                                            <form action="" method="post" name="of" id="of">
                                                <table id="sample-table-2" width="100%"
                                                       class="table table-striped table-bordered table-hover"
                                                       style="margin-bottom: 10px; text-align: center">
                                                    <thead id="targethead">
                                                    <tr>
                                                        <th></th>
                                                        <th style="text-align: center">统计时间</th>
                                                        <th style="text-align: center">营收</th>
                                                        <th style="text-align: center">充值</th>
                                                        <th style="text-align: center">兑换</th>

                                                        <th style="text-align: center">总金币</th>
                                                        <th style="text-align: center">注册用户数</th>
                                                        <th style="text-align: center">登陆用户数</th>
                                                        <th style="text-align: center">总税收</th>

                                                        <th style="text-align: center">游戏记录</th>
                                                        <th style="text-align: center">最后更新时间</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    <?php if (!empty($timeData)) {
                                                        foreach ($timeData as $k => $v) { ?>
                                                            <tr id="<?php echo $k ?>">
                                                                <td width="50"><a
                                                                            href="javascript:onDetail(<?php echo $k ?>)"><span
                                                                                style="color: red" id="<?php echo $k . '_flagDetail' ?>">+</span></a></td>
                                                                <td id="<?php echo $k . '_dateTime' ?>"><?php echo $v['date']; ?></td>
                                                                <td>
                                                                    <?php echo $v['revenue']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['recharge']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['exchange']; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $v['totalGold']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['registerNum']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['loginNum']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['totalTax']; ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $v['gameRecord']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['lastUpdateTime']; ?>
                                                                </td>
                                                            </tr>

                                                            <tr id="<?php echo $k . '_son' ?>" style="display: none">
                                                                <td></td>
                                                                <td id="dateTest"><?php echo $v['date']; ?></td>
                                                                <td>
                                                                    <p>
                                                                        总营收: <span id="<?php echo $k . '_detailRevenueTotal'?>"></span><br>
                                                                        渠道分成: <span id="<?php echo $k . '_detailRevenueChannel' ?>"></span><br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        充值笔数: <span id="<?php echo $k . '_detailRechargeTimes' ?>"></span><br>
                                                                        充值总人数: <span id="<?php echo $k . '_detailRechargePersonNum' ?>"></span><br>
                                                                        老用户充值金额: <span id="<?php echo $k . '_detailRechargeOldAmount' ?>"></span><br>
                                                                        新用户充值金额: <span id="<?php echo $k . '_detailRechargeNewAmount' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        代理充值金额: <span id="<?php echo $k . '_detailRechargeAgentAmount' ?>"></span><br>
                                                                        老用户充值总人数: <span id="<?php echo $k . '_detailRechargeOldPersonNum' ?>"></span><br>
                                                                        新用户充值总人数: <span id="<?php echo $k . '_detailRechargeNewPersonNum' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        日ARPU: <span id="<?php echo $k . '_detailRechargeArpu' ?>"></span><br>
                                                                        日ARPPU: <span id="<?php echo $k . '_detailRechargeArppu' ?>"></span><br>
                                                                        日付费率: <span id="<?php echo $k . '_detailRechargeRate' ?>"></span>%<br>
                                                                        活跃用户付费率: <span id="<?php echo $k . '_detailRechargeActiveRate' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        在线充值: <span id="<?php echo $k . '_detailRechargeOnline' ?>"></span><br>
                                                                        在线充值笔数: <span id="<?php echo $k . '_detailRechargeOnlineTimes' ?>"></span><br>
                                                                        在线充值人数: <span id="<?php echo $k . '_detailRechargePersonNum' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        代理充值: <span id="<?php echo $k . '_detailRechargeAgent' ?>"></span><br>
                                                                        代理充值笔数: <span id="<?php echo $k . '_detailRechargeTimes' ?>"></span><br>
                                                                        代理充值人数: <span id="<?php echo $k . '_detailRechargePersonNum' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        当日破产用户: <span id="<?php echo $k . '_detailRechargeBankruptUser' ?>"></span><br>
                                                                        当日破产率: <span id="<?php echo $k . '_detailRechargeBankruptRate' ?>"></span><br>
                                                                        当日破产后充值用户: <span id="<?php echo $k . '_detailRechargeBankruptRechargeUser' ?>"></span><br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        老用户兑换金币: <span id="<?php echo $k . '_detailExchangeOldGold' ?>"></span><br>
                                                                        新用户兑换金币: <span id="<?php echo $k . '_detailExchangeNewGold' ?>"></span><br>
                                                                        老用户兑换总人数: <span id="<?php echo $k . '_detailExchangeOldPersonNum' ?>"></span><br>
                                                                        新用户兑换总人数: <span id="<?php echo $k . '_detailExchangeNewPersonNum' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        <span style="color: red">代理兑换:<span id="<?php echo $k . '_detailExchangeAgent' ?>"></span></span> <br>
                                                                        <span style="color: red">代理兑换人数:<span id="<?php echo $k . '_detailExchangeAgentPersonNum' ?>"></span></span> <br>
                                                                        <span style="color: red">银行卡兑换:<span id="<?php echo $k . '_detailExchangeBank' ?>"></span></span> <br>
                                                                        <span style="color: red">银行卡兑换人数:<span id="<?php echo $k . '_detailExchangeBankPersonNum' ?>"></span></span> <br>
                                                                        <span style="color: red">支付宝兑换:<span id="<?php echo $k . '_detailExchangeAlipay' ?>"></span></span> <br>
                                                                        <span style="color: red">支付宝兑换人数:<span id="<?php echo $k . '_detailExchangeAlipayPersonNum' ?>"></span></span> <br>
                                                                    </p>
                                                                </td>

                                                                <td>
                                                                    <p>
                                                                        总现金: <span id="<?php echo $k . '_detailCashTotal' ?>"></span><br>
                                                                        玩家现金: <span id="<?php echo $k . '_detailCashUser' ?>"></span><br>
                                                                        代理现金: <span id="<?php echo $k . '_detailCashAgent' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        总存款: <span id="<?php echo $k . '_detailDepositTotal' ?>"></span><br>
                                                                        玩家存款: <span id="<?php echo $k . '_detailDepositUser' ?>"></span><br>
                                                                        代理存款: <span id="<?php echo $k . '_detailDepositAgent' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        系统赠送金币数: <span id="<?php echo $k . '_detailGoldSystemGive' ?>"></span><br>
                                                                        金币增长: <span id="<?php echo $k . '_detailGoldIncrease' ?>"></span><br>
                                                                        (去代理金币)<br>
                                                                        金币增长率: <span id="<?php echo $k . '_detailGoldIncreaseRate' ?>"></span>%<br>
                                                                        (去代理金币)<br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        注册新用户去重量: <span id="<?php echo $k . '_detailRegisterUserNoDup' ?>"></span><br>
                                                                        游客账号: <span id="<?php echo $k . '_detailRegisterTourist' ?>"></span><br>
                                                                        正式账号: <span id="<?php echo $k . '_detailRegisterNormal' ?>"></span><br>
                                                                        新进入IP: <span id="<?php echo $k . '_detailRegisterNewIp' ?>"></span><br>

                                                                        IOS: <span id="<?php echo $k . '_detailRegisterIos' ?>"></span><br>
                                                                        Android: <span id="<?php echo $k . '_detailRegisterAndroid' ?>"></span><br>
                                                                        WIN: <span id="<?php echo $k . '_detailRegisterWin' ?>"></span><br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        登录用户去重: <span id="<?php echo $k . '_detailLoginUserNoDup' ?>"></span><br>
                                                                        游客账号: <span id="<?php echo $k . '_detailLoginTourist' ?>"></span><br>
                                                                        正式账号: <span id="<?php echo $k . '_detailLoginNormal' ?>"></span><br>

                                                                        新用户: <span id="<?php echo $k . '_detailLoginNewUser' ?>"></span><br>
                                                                        老用户: <span id="<?php echo $k . '_detailLoginOldUser' ?>"></span><br>
                                                                        登录IP: <span id="<?php echo $k . '_detailLoginIp' ?>"></span><br>

                                                                        IOS: <span id="<?php echo $k . '_detailLoginIos' ?>"></span>
                                                                        Android: <span id="<?php echo $k . '_detailLoginAndroid' ?>"></span><br>
                                                                        WIN: <span id="<?php echo $k . '_detailLoginWin' ?>"></span><br>

                                                                        玩过游戏的人数: <span id="<?php echo $k . '_detailLoginPlayPersonNum' ?>"></span><br>
                                                                        昨日留存: <span id="<?php echo $k . '_detailLoginYes' ?>"></span>%<br>
                                                                        3日留存: <span id="<?php echo $k . '_detailLogin3Day' ?>"></span>%<br>
                                                                        7日留存: <span id="<?php echo $k . '_detailLogin7Day' ?>"></span>%<br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        兑换税收: <span id="<?php echo $k . '_detailTaxTotal' ?>"></span><br>
                                                                        炸金花: <span id="<?php echo $k . '_detailTaxZjh' ?>"></span><br>
                                                                        炸金花人数: <span id="<?php echo $k . '_detailTaxZjhPersonNum' ?>"></span><br>
                                                                        炸金花税收占比: <span id="<?php echo $k . '_detailTaxZjhRate' ?>"></span>%<br>
                                                                    </p>

                                                                    <p>
                                                                        斗地主: <span id="<?php echo $k . '_detailTaxDdz' ?>"></span><br>
                                                                        斗地主人数: <span id="<?php echo $k . '_detailTaxDdzPersonNum' ?>"></span><br>
                                                                        斗地主税收占比: <span id="<?php echo $k . '_detailTaxDdzRate' ?>"></span>%<br>
                                                                    </p>

                                                                    <p>
                                                                        癞子斗地主: <span id="<?php echo $k . '_detailTaxDdzLz' ?>"></span><br>
                                                                        癞子斗地主人数: <span id="<?php echo $k . '_detailTaxDdzLzPersonNum' ?>"></span><br>
                                                                        癞子斗地主税收占比: <span id="<?php echo $k . '_detailTaxDdzLzRate' ?>"></span>%<br>
                                                                    </p>

                                                                    <p>
                                                                        经典牛牛: <span id="<?php echo $k . '_detailTaxNiuniuJd' ?>"></span><br>
                                                                        经典牛牛人数: <span id="<?php echo $k . '_detailTaxNiuniuJdPersonNum' ?>"></span><br>
                                                                        经典牛牛税收占比: <span id="<?php echo $k . '_detailTaxNiuniuJdRate' ?>"></span>%<br>
                                                                    </p>

                                                                    <p>
                                                                        抢庄牛牛: <span id="<?php echo $k . '_detailTaxNiuniuQz' ?>"></span><br>
                                                                        抢庄牛牛人数: <span id="<?php echo $k . '_detailTaxNiuniuQzPersonNum' ?>"></span><br>
                                                                        抢庄牛牛税收占比: <span id="<?php echo $k . '_detailTaxNiuniuQzRate' ?>"></span>%<br>
                                                                    </p>

                                                                    <p>
                                                                        百人牛牛: <span id="<?php echo $k . '_detailTaxNiuniuBr' ?>"></span><br>
                                                                        百人牛牛人数: <span id="<?php echo $k . '_detailTaxNiuniuBrPersonNum' ?>"></span><br>
                                                                        百人牛牛税收占比: <span id="<?php echo $k . '_detailTaxNiuniuBrRate' ?>"></span>%<br>
                                                                        百人牛牛系统输赢: <span id="<?php echo $k . '_detailTaxNiuniuBrSystemWinLose' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        捕鱼系统输赢: <span id="<?php echo $k . '_detailTaxBuyuSystemWinLose' ?>"></span><br>
                                                                        捕鱼人数: <span id="<?php echo $k . '_detailTaxBuyuPersonNum' ?>"></span><br>
                                                                    </p>

                                                                    <p>
                                                                        炸金花机器人输赢: <span id="<?php echo $k . '_detailTaxRobotWinLose' ?>"></span><br>
                                                                        炸金花机器人牌局数: <span id="<?php echo $k . '_detailTaxRobotPlayTimes' ?>"></span><br>
                                                                        炸金花机器人均赢: <span id="<?php echo $k . '_detailTaxRobotAverageWin' ?>"></span><br>
                                                                        捕鱼系统均赢: <span id="<?php echo $k . '_detailTaxBuyuAverageWin' ?>"></span><br>
                                                                    </p>
                                                                </td>

                                                                <td>
                                                                    <p>
                                                                        炸金花局数: <span id="<?php echo $k . '_detailGameZjhTimes' ?>"></span><br>
                                                                        炸金花平均时长: <span id="<?php echo $k . '_detailGameZjhAverageTime' ?>"></span>秒<br>
                                                                        斗地主局数: <span id="<?php echo $k . '_detailGameDdzTimes' ?>"></span><br>
                                                                        斗地主平均时长: <span id="<?php echo $k . '_detailGameDdzAverageTime' ?>"></span>秒<br>
                                                                    </p>
                                                                    <p>
                                                                        经典牛牛局数: <span id="<?php echo $k . '_detailGameNiuniuJdTimes' ?>"></span><br>
                                                                        经典牛牛平均时长: <span id="<?php echo $k . '_detailGameNiuniuJdAverageTime' ?>"></span>秒<br>
                                                                        抢庄牛牛: <span id="<?php echo $k . '_detailGameNiuniuQz' ?>"></span><br>
                                                                        抢庄牛牛平均时长: <span id="<?php echo $k . '_detailGameNiuniuQzAverangeTime' ?>"></span>秒<br>
                                                                    </p>
                                                                    <p>
                                                                        百人牛牛局数: <span id="<?php echo $k . '_detailGameNiuniuBrTimes' ?>"></span><br>
                                                                        百人牛牛平均时长: <span id="<?php echo $k . '_detailGameNiuniuBrAverageTime' ?>"></span>秒<br>
                                                                        德州扑克局数: <span id="<?php echo $k . '_detailGameTexasTimes' ?>"></span><br>
                                                                        德州扑克平均时长: <span id="<?php echo $k . '_detailGameTexasAverageTime' ?>"></span>秒<br>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <?php echo $v['lastUpdateTime']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } ?>

                                                    <tr>
                                                        <td>合计</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </form>

                                            <div class="modal-footer no-margin-top">
                                                <div class="dataTables_info pull-left" id="sample-table-2_info">
                                                    第<span><?php echo $pageInfo['page'] ?></span>页,
                                                    共<span><?php echo $pageInfo['pageNum'] ?></span>页,
                                                    跳转到第<input type="text" id="page"
                                                               style="margin-left:5px;height:34px;width:100px;"/>页
                                                    <button onclick="javascript:onJump()"
                                                            class="btn btn-xs btn-success " style="margin-top:3px;">
                                                        跳转
                                                    </button>
                                                </div>
                                                <?php echo $this->pagination->create_links(); ?>
                                            </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.page-content -->
                            </div>
                            <!-- /.main-content -->
                            <!-- /#ace-settings-container -->
                        </div>
                        <!-- /.main-container-inner -->
                    </div>
                    <!-- /.main-container -->

                    <script src="<?php echo base_url() . 'res/js/jquery-2.0.3.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/bootstrap.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/ace-elements.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/ace.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'js/context.js'; ?>"></script>

                    <script src="<?php echo base_url() . 'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/date-time/moment.min.js'; ?>"></script>
                    <script src="<?php echo base_url() . 'res/js/date-time/daterangepicker.min.js'; ?>"></script>


                    <script type="text/javascript">
                        // 日期控件datetime_local 设置默认值今天
                        var today = "";
                        var useDefault = "<?php echo $useDefault ?>";

                        // 构造符合datetime-local格式的当前日期
                        function getToday() {
                            format = "";
                            var nTime = new Date();
                            format += nTime.getFullYear() + "-";
                            format += (nTime.getMonth() + 1) < 10 ? "0" + (nTime.getMonth() + 1) : (nTime.getMonth() + 1);
                            format += "-";
                            format += nTime.getDate() < 10 ? "0" + (nTime.getDate()) : (nTime.getDate());
                            format += "T";

                            return format;
                        }
                        today = getToday();
                        todayBegin = today + '00:00:00';
                        todayEnd = today + '23:59:59';
                        if (useDefault) {
                            document.getElementById('dateTimeBegin').value = todayBegin;
                            document.getElementById('dateTimeEnd').value = todayEnd;
                        } else {
                            document.getElementById('dateTimeBegin').value = "<?php echo $query['dateTimeBegin'] ?>";
                            document.getElementById('dateTimeEnd').value = "<?php echo $query['dateTimeEnd'] ?>";
                        }

                        /**
                         * 查询/导出excel
                         * @param type
                         */
                        function onSearch1(type) {
                            if (type == 1) { // 查询
                                var param = "<?php echo site_url('no3/homePage'); ?>";
                            } else { // 导出
                                var param = "<?php echo site_url('no3/homePage/exportData'); ?>";
                            }

                            var form = $("<form>");
                            form.attr("style", "display:none");
                            form.attr("target", "");
                            form.attr("method", "post");
                            form.attr("action", param);

                            var input1 = $("<input>");
                            input1.attr("type", "hidden");
                            input1.attr("name", "exportData");
                            input1.attr("value", (new Date()).getMilliseconds());

                            var input2 = $("<input>");
                            input2.attr("type", "hidden");
                            input2.attr("name", "amountMin");
                            input2.attr("value", $("#amountMin").val());

                            var input3 = $("<input>");
                            input3.attr("type", "hidden");
                            input3.attr("name", "amountMax");
                            input3.attr("value", $("#amountMax").val());

                            var input4 = $("<input>");
                            input4.attr("type", "hidden");
                            input4.attr("name", "dateTimeBegin");
                            input4.attr("value", $("#dateTimeBegin").val());

                            var input5 = $("<input>");
                            input5.attr("type", "hidden");
                            input5.attr("name", "dateTimeEnd");
                            input5.attr("value", $("#dateTimeEnd").val());

                            var input6 = $("<input>");
                            input6.attr("type", "hidden");
                            input6.attr("name", "searchType");
                            input6.attr("value", 2);

                            var input7 = $("<input>");
                            input7.attr("type", "hidden");
                            input7.attr("name", "orderStatus");
                            input7.attr("value", $("#orderStatus").val());

                            $("body").append(form);
                            form.append(input1, input2, input3, input4, input5, input6, input7);
                            form.submit();
                        }

                        /**
                         * 查询 - 今日, 昨日, 本周, 上周, 本月, 上月
                         * @param type
                         */
                        function onQuickSearch(type) {
                            var param = "homePage";

                            var form = $("<form>");
                            form.attr("style", "display:none");
                            form.attr("target", "");
                            form.attr("method", "post");
                            form.attr("action", param);

                            var input1 = $("<input>");
                            input1.attr("type", "hidden");
                            input1.attr("name", "type");
                            input1.attr("value", type);

                            var input2 = $("<input>");
                            input2.attr("type", "hidden");
                            input2.attr("name", "searchType");
                            input2.attr("value", 3);

                            $("body").append(form);
                            form.append(input1, input2);
                            form.submit();
                        }

                        /**
                         * 跳转到第几页
                         */
                        function onJump() {
                            var page = $("#page").val();
                            var url = "<?php echo site_url('no3/homePage/index') . '?' . http_build_query($query) ?>" + '&page=' + page;
                            location.href = url;
                        }

                        /**
                         * 获取详细
                         * 点击详细时, 把隐藏的那个详细行显示
                         * 通过 document.getElementById('dateTest').innerText = 'hahaha'; 给详细哪一行赋值
                         */
                        function onDetail(id) {
                            var idSon = id + '_son';
                            var idFlagDetail = id + '_flagDetail';
                            var idDateTime = id + '_dateTime';

                            // 判断是显示详细还是隐藏详细
                            var flagDetail = document.getElementById(idFlagDetail).innerText;
                            if (flagDetail == '+') { // 显示详细
                                // 获取该行数据
                                var dateTime = document.getElementById(idDateTime).innerText;
                                var _url = "<?php echo site_url('no3/homePage/getDetail'); ?>";
                                var _data_obj = {
                                    dateTime: dateTime
                                };
                                $.ajax({
                                    type: "POST",
                                    url: _url,
                                    data: _data_obj,
                                    dataType: "json",
                                    beforeSend: function () {
                                    },
                                    success: function (data) {
                                        if (data.status == 0) {
                                            alert('获取详细失败');
                                            return false;
                                        } else {
//                                            alert(JSON.stringify(data));

                                            // 给该行赋值
                                            if (data === undefined || data.length === 0) {
                                                // 营收
                                                document.getElementById(id + '_detailRevenueTotal').innerText = data.detailRevenueTotal; // 总营收
                                                document.getElementById(id + '_detailRevenueChannel').innerText = data.detailRevenueChannel; // 渠道分成


                                                // 充值
                                                document.getElementById(id + '_detailRechargeTimes').innerText = data.detailRechargeTimes; // 充值笔数
                                                document.getElementById(id + '_detailRechargePersonNum').innerText = data.detailRechargePersonNum; // 充值总人数
                                                document.getElementById(id + '_detailRechargeOldAmount').innerText = data.detailRechargeOldAmount; // 老用户充值金额
                                                document.getElementById(id + '_detailRechargeNewAmount').innerText = data.detailRechargeNewAmount; // 新用户充值金额

                                                document.getElementById(id + '_detailRechargeAgentAmount').innerText = data.detailRechargeAgentAmount; // 代理充值金额
                                                document.getElementById(id + '_detailRechargeOldPersonNum').innerText = data.detailRechargeOldPersonNum; // 老用户充值总人数
                                                document.getElementById(id + '_detailRechargeNewPersonNum').innerText = data.detailRechargeNewPersonNum; // 新用户充值总人数

                                                document.getElementById(id + '_detailRechargeArpu').innerText = data.detailRechargeArpu; // 日ARPU
                                                document.getElementById(id + '_detailRechargeArppu').innerText = data.detailRechargeArppu; // 日ARPPU
                                                document.getElementById(id + '_detailRechargeRate').innerText = data.detailRechargeRate; // 日付费率
                                                document.getElementById(id + '_detailRechargeActiveRate').innerText = data.detailRechargeActiveRate; // 活跃用户付费率

                                                document.getElementById(id + '_detailRechargeOnline').innerText = data.detailRechargeOnline; // 在线充值
                                                document.getElementById(id + '_detailRechargeOnlineTimes').innerText = data.detailRechargeOnlineTimes; // 在线充值笔数
                                                document.getElementById(id + '_detailRechargePersonNum').innerText = data.detailRechargePersonNum; // 在线充值人数

                                                document.getElementById(id + '_detailRechargeAgent').innerText = data.detailRechargeAgent; // 代理充值
                                                document.getElementById(id + '_detailRechargeTimes').innerText = data.detailRechargeTimes; // 代理充值笔数
                                                document.getElementById(id + '_detailRechargePersonNum').innerText = data.detailRechargePersonNum; // 代理充值人数

                                                document.getElementById(id + '_detailRechargeBankruptUser').innerText = data.detailRechargeBankruptUser; // 当日破产用户
                                                document.getElementById(id + '_detailRechargeBankruptRate').innerText = data.detailRechargeBankruptRate; // 当日破产率
                                                document.getElementById(id + '_detailRechargeBankruptRechargeUser').innerText = data.detailRechargeBankruptRechargeUser; // 当日破产后充值用户


                                                // 兑换
                                                document.getElementById(id + '_detailExchangeOldGold').innerText = data.detailExchangeOldGold; // 老用户兑换金币
                                                document.getElementById(id + '_detailExchangeNewGold').innerText = data.detailExchangeNewGold; // 新用户兑换金币
                                                document.getElementById(id + '_detailExchangeOldPersonNum').innerText = data.detailExchangeOldPersonNum; // 老用户兑换总人数
                                                document.getElementById(id + '_detailExchangeNewPersonNum').innerText = data.detailExchangeNewPersonNum; // 新用户兑换总人数

                                                document.getElementById(id + '_detailExchangeAgent').innerText = data.detailExchangeAgent; // 代理兑换
                                                document.getElementById(id + '_detailExchangeAgentPersonNum').innerText = data.detailExchangeAgentPersonNum; // 代理兑换人数
                                                document.getElementById(id + '_detailExchangeBank').innerText = data.detailExchangeBank; // 银行卡兑换
                                                document.getElementById(id + '_detailExchangeBankPersonNum').innerText = data.detailExchangeBankPersonNum; // 银行卡兑换人数
                                                document.getElementById(id + '_detailExchangeAlipay').innerText = data.detailExchangeAlipay; // 支付宝兑换
                                                document.getElementById(id + '_detailExchangeAlipayPersonNum').innerText = data.detailExchangeAlipayPersonNum; // 支付宝兑换人数


                                                // 总金币
                                                document.getElementById(id + '_detailCashTotal').innerText = data.detailCashTotal; // 总现金
                                                document.getElementById(id + '_detailCashUser').innerText = data.detailCashUser; // 玩家现金
                                                document.getElementById(id + '_detailCashAgent').innerText = data.detailCashAgent; // 代理现金

                                                document.getElementById(id + '_detailDepositTotal').innerText = data.detailDepositTotal; // 总存款
                                                document.getElementById(id + '_detailDepositUser').innerText = data.detailDepositUser; // 玩家存款
                                                document.getElementById(id + '_detailDepositAgent').innerText = data.detailDepositAgent; // 代理存款

                                                document.getElementById(id + '_detailGoldSystemGive').innerText = data.detailGoldSystemGive; // 系统赠送金币数
                                                document.getElementById(id + '_detailGoldIncrease').innerText = data.detailGoldIncrease; // 金币增长(去代理金币)
                                                document.getElementById(id + '_detailGoldIncreaseRate').innerText = data.detailGoldIncreaseRate; // 金币增长率(去代理金币)


                                                // 注册用户数
                                                document.getElementById(id + '_detailRegisterUserNoDup').innerText = data.detailRegisterUserNoDup; // 注册新用户去重量
                                                document.getElementById(id + '_detailRegisterTourist').innerText = data.detailRegisterTourist; // 游客账号
                                                document.getElementById(id + '_detailRegisterNormal').innerText = data.detailRegisterNormal; // 正式账号
                                                document.getElementById(id + '_detailRegisterNewIp').innerText = data.detailRegisterNewIp; // 新进入IP

                                                document.getElementById(id + '_detailRegisterIos').innerText = data.detailRegisterIos; // IOS
                                                document.getElementById(id + '_detailRegisterAndroid').innerText = data.detailRegisterAndroid; // Android
                                                document.getElementById(id + '_detailRegisterWin').innerText = data.detailRegisterWin; // WIN

                                                document.getElementById(id + '_detailLoginUserNoDup').innerText = data.detailLoginUserNoDup; // 登录用户去重
                                                document.getElementById(id + '_detailLoginTourist').innerText = data.detailLoginTourist; // 游客账号
                                                document.getElementById(id + '_detailLoginNormal').innerText = data.detailLoginNormal; // 正式账号

                                                document.getElementById(id + '_detailLoginNewUser').innerText = data.detailLoginNewUser; // 新用户
                                                document.getElementById(id + '_detailLoginOldUser').innerText = data.detailLoginOldUser; // 老用户
                                                document.getElementById(id + '_detailLoginIp').innerText = data.detailLoginIp; // 登录IP

                                                document.getElementById(id + '_detailLoginIos').innerText = data.detailLoginIos; // IOS
                                                document.getElementById(id + '_detailLoginAndroid').innerText = data.detailLoginAndroid; // Android
                                                document.getElementById(id + '_detailLoginWin').innerText = data.detailLoginWin; // WIN

                                                document.getElementById(id + '_detailLoginPlayPersonNum').innerText = data.detailLoginPlayPersonNum; // 玩过游戏的人数
                                                document.getElementById(id + '_detailLoginYes').innerText = data.detailLoginYes; // 昨日留存
                                                document.getElementById(id + '_detailLogin3Day').innerText = data.detailLogin3Day; // 3日留存
                                                document.getElementById(id + '_detailLogin7Day').innerText = data.detailLogin7Day; // 7日留存


                                                // 总税收
                                                document.getElementById(id + '_detailTaxTotal').innerText = data.detailTaxTotal; // 兑换税收
                                                document.getElementById(id + '_detailTaxZjh').innerText = data.detailTaxZjh; // 炸金花
                                                document.getElementById(id + '_detailTaxZjhPersonNum').innerText = data.detailTaxZjhPersonNum; // 炸金花人数
                                                document.getElementById(id + '_detailTaxZjhRate').innerText = data.detailTaxZjhRate; // 炸金花税收占比

                                                document.getElementById(id + '_detailTaxDdz').innerText = data.detailTaxDdz; // 斗地主
                                                document.getElementById(id + '_detailTaxDdzPersonNum').innerText = data.detailTaxDdzPersonNum; // 斗地主人数
                                                document.getElementById(id + '_detailTaxDdzRate').innerText = data.detailTaxDdzRate; // 斗地主税收占比

                                                document.getElementById(id + '_detailTaxDdzLz').innerText = data.detailTaxDdzLz; // 癞子斗地主
                                                document.getElementById(id + '_detailTaxDdzLzPersonNum').innerText = data.detailTaxDdzLzPersonNum; // 癞子斗地主人数
                                                document.getElementById(id + '_detailTaxDdzLzRate').innerText = data.detailTaxDdzLzRate; // 癞子斗地主税收占比

                                                document.getElementById(id + '_detailTaxNiuniuJd').innerText = data.detailTaxNiuniuJd; // 经典牛牛
                                                document.getElementById(id + '_detailTaxNiuniuJdPersonNum').innerText = data.detailTaxNiuniuJdPersonNum; // 经典牛牛人数
                                                document.getElementById(id + '_detailTaxNiuniuJdRate').innerText = data.detailTaxNiuniuJdRate; // 经典牛牛税收占比

                                                document.getElementById(id + '_detailTaxNiuniuQz').innerText = data.detailTaxNiuniuQz; // 抢庄牛牛
                                                document.getElementById(id + '_detailTaxNiuniuQzPersonNum').innerText = data.detailTaxNiuniuQzPersonNum; // 抢庄牛牛人数
                                                document.getElementById(id + '_detailTaxNiuniuQzRate').innerText = data.detailTaxNiuniuQzRate; // 抢庄牛牛税收占比

                                                document.getElementById(id + '_detailTaxNiuniuBr').innerText = data.detailTaxNiuniuBr; // 百人牛牛
                                                document.getElementById(id + '_detailTaxNiuniuBrPersonNum').innerText = data.detailTaxNiuniuBrPersonNum; // 百人牛牛人数
                                                document.getElementById(id + '_detailTaxNiuniuBrRate').innerText = data.detailTaxNiuniuBrRate; // 百人牛牛税收占比
                                                document.getElementById(id + '_detailTaxNiuniuBrSystemWinLose').innerText = data.detailTaxNiuniuBrSystemWinLose; // 百人牛牛系统输赢

                                                document.getElementById(id + '_detailTaxBuyuSystemWinLose').innerText = data.detailTaxBuyuSystemWinLose; // 捕鱼系统输赢
                                                document.getElementById(id + '_detailTaxBuyuPersonNum').innerText = data.detailTaxBuyuPersonNum; // 捕鱼人数

                                                document.getElementById(id + '_detailTaxRobotWinLose').innerText = data.detailTaxRobotWinLose; // 炸金花机器人输赢
                                                document.getElementById(id + '_detailTaxRobotPlayTimes').innerText = data.detailTaxRobotPlayTimes; // 炸金花机器人牌局数
                                                document.getElementById(id + '_detailTaxRobotAverageWin').innerText = data.detailTaxRobotAverageWin; // 炸金花机器人均赢
                                                document.getElementById(id + '_detailTaxBuyuAverageWin').innerText = data.detailTaxBuyuAverageWin; // 捕鱼系统均赢


                                                // 游戏记录
                                                document.getElementById(id + '_detailGameZjhTimes').innerText = data.detailGameZjhTimes; // 炸金花局数
                                                document.getElementById(id + '_detailGameZjhAverageTime').innerText = data.detailGameZjhAverageTime; // 炸金花平均时长
                                                document.getElementById(id + '_detailGameDdzTimes').innerText = data.detailGameDdzTimes; // 斗地主局数
                                                document.getElementById(id + '_detailGameDdzAverageTime').innerText = data.detailGameDdzAverageTime; // 斗地主平均时长

                                                document.getElementById(id + '_detailGameNiuniuJdTimes').innerText = data.detailGameNiuniuJdTimes; // 经典牛牛局数
                                                document.getElementById(id + '_detailGameNiuniuJdAverageTime').innerText = data.detailGameNiuniuJdAverageTime; // 经典牛牛平均时长
                                                document.getElementById(id + '_detailGameNiuniuQz').innerText = data.detailGameNiuniuQz; // 抢庄牛牛
                                                document.getElementById(id + '_detailGameNiuniuQzAverangeTime').innerText = data.detailGameNiuniuQzAverangeTime; // 抢庄牛牛平均时长

                                                document.getElementById(id + '_detailGameNiuniuBrTimes').innerText = data.detailGameNiuniuBrTimes; // 百人牛牛局数
                                                document.getElementById(id + '_detailGameNiuniuBrAverageTime').innerText = data.detailGameNiuniuBrAverageTime; // 百人牛牛平均时长
                                                document.getElementById(id + '_detailGameTexasTimes').innerText = data.detailGameTexasTimes; // 德州扑克局数
                                                document.getElementById(id + '_detailGameTexasAverageTime').innerText = data.detailGameTexasAverageTime; // 德州扑克平均时长
                                            }
                                        }
                                    }
                                });

                                // 显示该行
                                var tr = document.getElementById(idSon).style;
                                tr.display = '';

                                document.getElementById(idFlagDetail).innerText = '-';
                            } else { // 隐藏详细
                                var tr = document.getElementById(idSon).style;
                                tr.display = 'none';

                                document.getElementById(idFlagDetail).innerText = '+';
                            }
                        }

                    </script>
</body>
</html>