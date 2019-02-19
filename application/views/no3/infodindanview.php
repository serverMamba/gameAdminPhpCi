<!DOCTYPE html>
<html lang="en">
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
                                        <input value="2" type="hidden" name="searchType"/>

                                        <div style="margin-bottom: 20px">
                                            <span style="margin-left: 0px">支付方式</span>
                                            <select name="payType" id="payType"
                                                    style="margin-left: 0px; width: 120px;height: 34px">
                                                <?php foreach ($payType as $k => $v) {
                                                    if (isset($query['payType']) && $k == $query['payType']) {
                                                        ?>
                                                        <option value="<?php echo $k; ?>"
                                                                selected><?php echo $v; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                            <span style="margin-left: 0px">支付状态</span>
                                            <select name="payStatus" id="payStatus"
                                                    style="margin-left: 0px; width: 120px; height: 34px">
                                                <?php foreach ($payStatus as $k => $v) {
                                                    if (isset($query['payStatus']) && intval($k) === intval($query['payStatus'])) {
                                                        ?>
                                                        <option value="<?php echo $k; ?>"
                                                                selected><?php echo $v; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                            <span style="margin-left: 0px">充值情况</span>
                                            <select name="paySituation" id="paySituation"
                                                    style="margin-left: 0px; width: 120px; height: 34px">
                                                <?php foreach ($paySituation as $k => $v) {
                                                    if (isset($query['paySituation']) && intval($k) === intval($query['paySituation'])) {
                                                        ?>
                                                        <option value="<?php echo $k; ?>"
                                                                selected><?php echo $v; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>


                                            <span style="margin-left: 15px">支付平台</span>
                                            <select name="pay_platform" id="pay_platform"
                                                    style="margin-left: 0px; width: 120px; height: 34px">
                                                <option value="-1">全部</option>
                                                <?php foreach ($pay_platform_list as $k => $v) { ?>
                                                    <option <?php if ($query['pay_platform'] == $k) { ?> selected="selected"
                                                    <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            </select>


                                            <span style="margin-left: 15px">游戏种类</span>
                                            <select name="game_code" id="game_code"
                                                    style="margin-left: 0px; width: 120px; height: 34px">
                                                <?php foreach ($game_codes as $k => $v) { ?>
                                                    <option <?php if ($query['game_code'] == $k) { ?> selected="selected"
                                                    <?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            </select>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>

                                        <div style="margin-bottom: 20px;">
                                            金额范围<input value="<?php if ($query['amountMin']) {
                                                echo $query['amountMin'];
                                            } ?>" type="text" placeholder="最小金额" name="amountMin" id="amountMin"
                                                       style="margin-left:5px;height:34px;width:160px;"/>
                                            至<input value="<?php if ($query['amountMax']) {
                                                echo $query['amountMax'];
                                            } ?>" type="text" placeholder="最大金额" name="amountMax" id="amountMax"
                                                    style="margin-left:5px;height:34px;width:160px;"/>
                                        </div>

                                        <div style="margin-bottom: 20px">
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

                                            <button onclick="javascript:onSearch1(1)" class="btn btn-xs btn-success "
                                                    style="margin-top:3px;">
                                                <span class="bigger-110">查询</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:onSearch1(2)" class="btn btn-xs btn-success "
                                                    style="margin-top:3px;">
                                                <span class="bigger-110">导出EXCEL</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <form action="<?php echo site_url('no3/infodindan/index'); ?>" id="form"
                                              method="post">

                                            <input value="1" type="hidden" name="searchType"/>

                                            <div style="margin-bottom: 20px">
                                                精确搜索
                                                <input value="<?php if (isset($query['userId'])) {
                                                    echo $query['userId'];
                                                } ?>" type="text" placeholder="玩家ID" name="userId"
                                                       style="margin-left:5px;height:34px;width:160px;"/>
                                                <input value="<?php if (isset($query['orderId'])) {
                                                    echo $query['orderId'];
                                                } ?>" type="text" placeholder="充值订单号" name="orderId"
                                                       style="margin-left:5px;height:34px;width:160px;"/>
                                                <input value="<?php if (isset($query['thirdOrderId'])) {
                                                    echo $query['thirdOrderId'];
                                                } ?>" type="text" placeholder="第三方订单号" name="thirdOrderId"
                                                       style="margin-left:5px;height:34px;width:160px;"/>
                                                <!--                                                <input value="-->
                                                <?php //if (isset($query['agentId'])) {
                                                //                                                    echo $query['agentId'];
                                                //                                                } ?><!--" type="text" placeholder="所属代理" name="agentId"-->
                                                <!--                                                       style="margin-left:5px;height:34px;width:160px;"/>-->
                                                <input value="<?php if (isset($query['operator'])) {
                                                    echo $query['operator'];
                                                } ?>" type="text" placeholder="操作员" name="operator"
                                                       style="margin-left:5px;height:34px;width:160px;"/>

                                                <button class="btn btn-xs btn-success " style="margin-top:3px;">
                                                    <span class="bigger-110">查询</span>
                                                    <i class="icon-search icon-on-right"></i>
                                                </button>
                                            </div>

                                        </form>

                                        <div style="margin-bottom: 0px">
                                            <button onclick="javascript:onQuickSearch(1)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">今日</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(2)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">昨日</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(3)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">本周</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div style="margin-bottom: 20px">
                                            <button onclick="javascript:onQuickSearch(4)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">上周</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(5)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">本月</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:onQuickSearch(6)"
                                                    class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">上月</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div>
                                            <a class="btn btn-xs btn-danger "
                                               style="margin-top:3px;margin-left:3px;margin-bottom:20px"
                                               onclick="onclickCheckDelayOrders();">
                                                <span class="bigger-110">查询延时订单</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </a>
                                        </div>

                                        <input type="checkbox" id="hide_pay"
                                               value="1" <?php if ($query['isShowPay'] == 1) { ?> checked="checked" <?php } ?> />
                                        显示支付平台
                                    </div>
                                    <?php if ($isNormal) { ?>
                                        <div class="widget-body">
                                            <div class="widget-main" style="padding: 0;">
                                                <table id="sample-table-2"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                    <tr>
                                                        <th>玩家ID</th>
                                                        <th>充值情况</th>
                                                        <th>充值金额</th>
                                                        <th>充值前金币</th>

                                                        <th>充值后金币</th>
                                                        <th>订单号</th>
                                                        <th>参数</th>
                                                        <th>提交时间</th>

                                                        <th>到帐时间</th>
                                                        <th>状态</th>
                                                        <th>操作员</th>
                                                        <th>支付方式</th>

                                                        <?php if ($query['isShowPay'] == 1) { ?>
                                                            <th>支付平台</th>
                                                        <?php } ?>
                                                        <th>备注</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($orderList as $v) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo site_url('no3/infodetail') . '?user_id=' . $v['user_id']; ?>"><?php echo $v['user_id']; ?></a>
                                                            </td>
                                                            <td><?php echo $v['paySituation']; ?></td>
                                                            <td><?php echo $v['money']; ?>元</td>
                                                            <td><?php echo $v['before_chips']; ?></td>

                                                            <td><?php echo $v['after_chips']; ?></td>
                                                            <td <?php if ($v['pay_platform'] == '品付') { ?> onclick="queryOrder('<?php echo site_url('pay/android/queryOrder'); ?>','<?php echo $v['order_sn']; ?>','<?php echo $v['pay_platform']; ?>','<?php echo site_url('pay/android/budan'); ?>')" <?php } ?>><?php echo $v['order_sn']; ?></td>
                                                            <td><?php echo $v['param']; ?></td>
                                                            <td><?php echo $v['add_time']; ?></td>

                                                            <td><?php echo $v['pay_success_time']; ?></td>
                                                            <td><?php echo $v['status']; ?></td>
                                                            <td><?php echo $v['refer'] ?></td>
                                                            <td><?php if ($v['pay_type']) {
                                                                    echo $v['pay_type'];
                                                                } else {
                                                                    echo '--';
                                                                } ?></td>

                                                            <?php if ($query['isShowPay'] == 1) { ?>
                                                                <td><?php echo $v['pay_platform']; ?></td>
                                                            <?php } ?>
                                                            <td><?php if ($v['pay_platform'] == '支付宝web转账' && $v['is_image']) { ?>
                                                                    <a href="http://i.yuming.com/<?php echo $v['third_order_sn'] . '.jpg'; ?>"
                                                                       target="_blank">查看订单图</a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>

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

                                                <div class="modal-body no-padding"></div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="widget-body">
                                            <div class="widget-main" style="padding: 0;">
                                                <table id="sample-table-2"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                    <tr>
                                                        <th>userID</th>
                                                        <th>金额</th>
                                                        <th>充值前金币</th>
                                                        <th>充值后金币</th>
                                                        <th>订单号</th>
                                                        <th>第三方订单号</th>
                                                        <th>提交时间</th>
                                                        <th>到帐时间</th>
                                                        <th>时间延迟</th>
                                                        <th>状态</th>
                                                        <th>操作员</th>
                                                        <th>支付方式</th>
                                                        <?php if ($query['isShowPay'] == 1) { ?>
                                                            <th>支付平台</th>
                                                        <?php } ?>
                                                        <th>游戏种类</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($order_list as $v) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo site_url('no3/infodetail') . '?user_id=' . $v['user_id']; ?>"><?php echo $v['user_id']; ?></a>
                                                            </td>
                                                            <td><?php echo $v['money']; ?>元</td>
                                                            <td><?php echo $v['before_chips']; ?></td>
                                                            <td><?php echo $v['after_chips']; ?></td>
                                                            <td <?php if ($v['pay_platform'] == '品付') { ?> onclick="queryOrder('<?php echo site_url('pay/android/queryOrder'); ?>','<?php echo $v['order_sn']; ?>','<?php echo $v['pay_platform']; ?>','<?php echo site_url('pay/android/budan'); ?>')" <?php } ?>><?php echo $v['order_sn']; ?></td>
                                                            <td><?php echo $v['third_order_sn']; ?></td>
                                                            <td><?php echo $v['add_time']; ?></td>
                                                            <td><?php echo $v['pay_success_time']; ?></td>
                                                            <td style="color:red"><?php echo $v['delayTime']; ?></td>
                                                            <td><?php echo $v['status']; ?></td>
                                                            <td><?php echo $v['refer'] ?></td>
                                                            <td><?php if ($v['pay_type']) {
                                                                    echo $v['pay_type'];
                                                                } else {
                                                                    echo '--';
                                                                } ?></td>
                                                            <?php if ($query['isShowPay'] == 1) { ?>
                                                                <td><?php echo $v['pay_platform']; ?></td>
                                                            <?php } ?>
                                                            <td><?php echo $game_codes[$v['game_code']]; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>

                                                <div class="modal-footer no-margin-top">
                                                    <?php echo $this->pagination->create_links(); ?>
                                                </div>

                                                <div class="modal-body no-padding"></div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="order_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="orderModalTitle">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="send_status">正在查询，请稍后...</div>
                <ul>
                    <li>状态：<span id="modal_result"></span></li>
                    <li>订单号：<span id="modal_order_sn"></span></li>
                    <li>金额：<span id="modal_money"></span></li>
                    <li>补单:<span id="extend"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'res/js/jquery-2.0.3.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace-elements.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/moment.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/daterangepicker.min.js'; ?>"></script>

<script type="text/javascript">
    // 日期控件datetime_local 设置默认值今天
    var today = "";
    var useLast = "<?php echo $query['dateTimeBegin'] ?>";
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
    if (useLast) {
        document.getElementById('dateTimeBegin').value = "<?php echo $query['dateTimeBegin'] ?>";
        document.getElementById('dateTimeEnd').value = "<?php echo $query['dateTimeEnd'] ?>";
    } else {
        document.getElementById('dateTimeBegin').value = todayBegin;
        document.getElementById('dateTimeEnd').value = todayEnd;
    }


    $(function () {
        $('#id_date_picker_1').datepicker({autoclose: true}).on(ace.click_event, function () {
            $("#id_date_picker_1").focus();
        });
        $('#id_date_picker_2').datepicker({autoclose: true}).on(ace.click_event, function () {
            $("#id_date_picker_2").focus();
        });

        $('#id_time_picker_1').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false
        }).on(ace.click_event, function () {
            $("#id_time_picker_1").focus();
        });

        $('#id_time_picker_2').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false
        }).on(ace.click_event, function () {
            $("#id_time_picker_2").focus();
        });

        $('#order_modal').on('hide.bs.modal', function (e) {
            $('#modal_order_sn').html('');
            $('#modal_money').html('');
            $('#modal_result').html('');
            $('#modal_pay_type').html('');
        })

        $('#hide_pay').change(function () {
            if ($('#hide_pay').is(':checked')) {
                var tourl = '<?php echo site_url('no3/infodindan'); ?>?user_id=<?php echo $query['user_id']; ?>&order_sn=<?php echo $query['order_sn']; ?>&third_order_sn=<?php echo $query['third_order_sn']; ?>&timeBegin=<?php echo $query['timeBegin']; ?>&timeBegin=<?php echo $query['timeBegin']; ?>&timeEnd=<?php echo $query['timeEnd']; ?>&timeEnd=<?php echo $query['timeEnd']; ?>&account=<?php echo $query['account']; ?>&order_status=<?php echo $query['order_status']; ?>&pay_platform=<?php echo $query['pay_platform']; ?>&game_code=<?php echo $query['game_code']; ?>&isShowPay=1&page=<?php echo $page; ?>';
            } else {
                var tourl = '<?php echo site_url('no3/infodindan'); ?>?user_id=<?php echo $query['user_id']; ?>&order_sn=<?php echo $query['order_sn']; ?>&third_order_sn=<?php echo $query['third_order_sn']; ?>&timeBegin=<?php echo $query['timeBegin']; ?>&timeBegin=<?php echo $query['timeBegin']; ?>&timeEnd=<?php echo $query['timeEnd']; ?>&timeEnd=<?php echo $query['timeEnd']; ?>&account=<?php echo $query['account']; ?>&order_status=<?php echo $query['order_status']; ?>&pay_platform=<?php echo $query['pay_platform']; ?>&game_code=<?php echo $query['game_code']; ?>&isShowPay=2&page=<?php echo $page; ?>';
            }
            location.href = tourl;
        });
    });

    function queryOrder(url, order_sn, pay_platform, budan_url) {
        $.ajax({
            url: url + '?agent_bill_id=' + order_sn + '&pay_platform=' + pay_platform,
            dataType: "json",
            beforeSend: function () {
                $('#send_status').show();
                $('#order_modal').modal('show');
            },
            success: function (data) {
                if (data.status == 0) {
                    alert('查不到该订单');
                    return false;
                }

                if (pay_platform == '品付') {
                    $('#modal_order_sn').html(data.agent_bill_id);
                    $('#modal_money').html(data.pay_amt);

                    if (data.result == '1') {
                        $('#modal_result').html('已支付');
                        var click = "postbudan('" + data.extend + "','" + budan_url + "')";
                        $('#extend').html('<a target="_blank" href="javascript:;" onclick=' + click + '>补单</a>');
                    } else {
                        $('#modal_result').html('未支付');
                        $('#extend').html('');
                    }
                    $('#orderModalTitle').html('订单：' + data.agent_bill_id);


                    $('#send_status').hide();
                }
            }
        });
    }

    function postbudan(extend, url) {
        $.ajax({
            url: url,
            type: "POST",
            data: {msg: extend},
            beforeSend: function () {
            },
            success: function (res) {
                alert(res);
            }
        });
    }

    /**
     * 查询延时订单
     */
    function onclickCheckDelayOrders() {
        // 修改form的post地址
        $('#form').attr('action', "<?php echo site_url('no3/infodindan/delayOrders');?>");

        // submit
        $('#form').submit();
    }

    /**
     * 查询/导出excel
     * @param type
     */
    function onSearch1(type) {
        if (type == 1) { // 查询
            var param = "<?php echo site_url('no3/infodindan'); ?>";
        } else { // 导出
            var param = "<?php echo site_url('no3/infodindan/exportData'); ?>";
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
        input2.attr("name", "payType");
        input2.attr("value", $("#payType").val());

        var input3 = $("<input>");
        input3.attr("type", "hidden");
        input3.attr("name", "payStatus");
        input3.attr("value", $("#payStatus").val());

        var input4 = $("<input>");
        input4.attr("type", "hidden");
        input4.attr("name", "paySituation");
        input4.attr("value", $("#paySituation").val());

        var input5 = $("<input>");
        input5.attr("type", "hidden");
        input5.attr("name", "amountMin");
        input5.attr("value", $("#amountMin").val());

        var input6 = $("<input>");
        input6.attr("type", "hidden");
        input6.attr("name", "amountMax");
        input6.attr("value", $("#amountMax").val());

        var input7 = $("<input>");
        input7.attr("type", "hidden");
        input7.attr("name", "dateTimeBegin");
        input7.attr("value", $("#dateTimeBegin").val());

        var input8 = $("<input>");
        input8.attr("type", "hidden");
        input8.attr("name", "dateTimeEnd");
        input8.attr("value", $("#dateTimeEnd").val());

        var input9 = $("<input>");
        input9.attr("type", "hidden");
        input9.attr("name", "searchType");
        input9.attr("value", 2);

        var input10 = $("<input>");
        input10.attr("type", "hidden");
        input10.attr("name", "pay_platform");
        input10.attr("value", $("#pay_platform").val());

        var input11 = $("<input>");
        input11.attr("type", "hidden");
        input11.attr("name", "game_code");
        input11.attr("value", $("#game_code").val());


        $("body").append(form);
        form.append(input1, input2, input3, input4, input5, input6, input7, input8, input9, input10, input11);
        form.submit();
    }

    /**
     * 查询 - 今日, 昨日, 本周, 上周, 本月, 上月
     * @param type
     */
    function onQuickSearch(type) {
        var param = "infodindan";

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
        var url = "<?php echo site_url('no3/infodindan/index') . '?' . http_build_query($query) ?>" + '&page=' + page;
        location.href = url;
    }
</script>
</body>
</html>