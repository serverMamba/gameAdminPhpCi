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
    </script>

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
                                                <table id="sample-table-2"
                                                       class="table table-striped table-bordered table-hover"
                                                       style="margin-bottom: 10px;">
                                                    <thead id="targethead">
                                                    <tr>
                                                        <th>统计时间</th>
                                                        <th>营收</th>
                                                        <th>充值</th>
                                                        <th>兑换</th>

                                                        <th>总金币</th>
                                                        <th>注册用户数</th>
                                                        <th>登陆用户数</th>
                                                        <th>总税收</th>

                                                        <th>游戏记录</th>
                                                        <th>最后更新时间</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    <?php if (!empty($timeData)) {
                                                        foreach ($timeData as $v) { ?>
                                                            <tr>
                                                                <td><?php echo $v['date']; ?></td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['revenue']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(1)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['recharge']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(2)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['exchange']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(3)">详细</a></span>
                                                                </td>

                                                                <td>
                                                                    <span style="float: left;"><?php echo $v['totalGold']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(4)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['registerNum']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(5)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['loginNum']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(6)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['totalTax']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(7)">详细</a></span>
                                                                </td>

                                                                <td>
                                                                    <span style="float: left"><?php echo $v['gameRecord']; ?></span>
                                                                    <span style="float: right;"><a
                                                                                href="javascript:onDetail(8)">详细</a></span>
                                                                </td>
                                                                <td>
                                                                    <span style="float: left"><?php echo $v['lastUpdateTime']; ?></span>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } ?>

                                                    <tr>
                                                        <td>合计:</td>
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
                                                <?php //echo $this->pagination->create_links();?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
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
     * 详细
     */
    function onDetail(id) {
        
    }

</script>
</body>
</html>