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
                                    <div class="widget-body">

                                        <!--                                        用户基础信息-->
                                        用户基础信息
                                        <hr>
                                        <div class="widget-main" style="padding: 0;">
                                            <table class="common_table_div">

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">用户id<font
                                                                    color="red">*</font></label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="userId" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['id']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">上级</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="up" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">用户等级</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userLv" disabled
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">普通用户</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">真实姓名<font
                                                                    color="red">*</font></label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="realName" placeholder=""
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['userIDCardName']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">用户状态</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userStatus" disabled
                                                                style="margin-left: 0px; width: 240px;">
                                                            <?php if (intval($userDetail['userSealStatus']) === 1) { ?>
                                                                <option value="1" selected>禁用</option>
                                                                <option value="2">正常</option>
                                                            <?php } else { ?>
                                                                <option value="1">禁用</option>
                                                                <option value="2" selected>正常</option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">e-mail</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="userEmail" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['user_email']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">手机号码<font
                                                                    color="red">*</font></label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="mobileNumber" placeholder=""
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['mobile_number']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">微信号码</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="weChat" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">qq号码</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="qq" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">账户id</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="accountId" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6"
                                                               value="<?php echo $userDetail['user_email']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">注册时间</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="registerTime" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['registertime']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">最后登录时间</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="lastLoginTime" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6"
                                                               value="<?php echo $userDetail['last_login_time']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">密码</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" id="password" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['password']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">资金密码</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="moneyPassword" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">用户标签</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userTag"
                                                                style="margin-left: 0px; width: 240px;">
                                                            <?php foreach ($userTag as $k => $v) {
                                                                if (intval($k) === intval($userDetail['userTag'])) {
                                                                ?>
                                                                    <option value="<?php echo $k; ?>" selected><?php echo $v; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">设备唯一标识码</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="uniqueDeviceId" disabled
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">已绑定</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">备注<font
                                                                    color="red">*</font></label>
                                                    </td>
                                                    <td colspan="3">
															<textarea class="form-control"
                                                                      style="width:100%; margin-right: 10px;"
                                                                      id="note" name="describe" rows="3"><?php echo $userDetail['note'] ?></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>


                                        <!--                                        账户信息-->
                                        <hr>
                                        <br><br><br><br>账户信息
                                        <hr>
                                        <div class="widget-main" style="padding: 0;">
                                            <table class="common_table_div">

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">账户余额</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="wallet" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['wallet']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">保险箱余额</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="safeBoxBalance" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">支付宝<font
                                                                    color="red">*</font></label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="aliPayAccount" placeholder=""
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['alipay_account']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">银行卡</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="bankCard" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">银行名称</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="bankName" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">充值次数</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="payBonusGameCount" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['payBonusGameCount']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">充值金额</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="payContribution" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2"
                                                               value="<?php echo $userDetail['payContribution']; ?>"
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">提现次数</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="withdrawalTimes" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">提现金额</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="withdrawalAmount" placeholder="" readonly
                                                               class="col-xs-10 col-sm-2" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px;"/>
                                                    </td>
                                                    <td>
                                                        <label style="height: 26px; width: 100px; margin-left: 10px; margin-top: 5px;">返水金额</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="fanShuiAmount" placeholder="" readonly
                                                               class="col-xs-10 col-sm-6" value=""
                                                               style="margin-left: 0px; height: 30px; width: 240px"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>


                                        <!--                                        用户权限设置-->
                                        <hr>
                                        <br><br><br><br>用户权限设置
                                        <hr>
                                        <div class="widget-main" style="padding: 0;">
                                            <table class="common_table_div">

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">用户充值</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userCharge"
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">启用</option>
                                                            <option value="install">禁用</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">用户取款</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userTakeMoney"
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">启用</option>
                                                            <option value="install">禁用</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">用户下注</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="userBet"
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">启用</option>
                                                            <option value="install">禁用</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <label style="height: 26px; width: 100px;  margin-left: 10px; margin-top: 0px;">账户余额</label>
                                                    </td>
                                                    <td>
                                                        <select name="bugtype" id="accountBalance"
                                                                style="margin-left: 0px; width: 240px;">
                                                            <option value="bug">启用</option>
                                                            <option value="install">禁用</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>


                                        <!--                                        用户游戏信息-->
                                        <hr>
                                        <br><br><br><br>用户游戏信息
                                        <hr>
                                        <div class="widget-main" style="padding: 0;">
                                            <table id="sample-table-2"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead id="targethead">
                                                <tr>
                                                    <th>游戏</th>
                                                    <th>游戏次数</th>
                                                    <th>输赢</th>
                                                    <th>最后游戏时间</th>

                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($userList as $v) { ?>
                                                    <tr>
                                                        <td><?php echo $v['online']; ?></td>
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['user_email']; ?></td>
                                                        <td><?php echo $v['userIDCardName']; ?></td>

                                                        <td>
                                                            <a href="<?php echo site_url('no3/userTag/toEdit') . "?id=" . $v['id'] . "&name=" . $v['name'] . "&sort=" . $v['sort'] . "&autoMoney=" . $v['autoMoney']; ?>">详情</a>
                                                            <a onclick="deleteOne('<?php echo $v['id']; ?>');"
                                                               href="javascript:;">禁用</a>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>


                                        <!--                                        用户活动信息-->
                                        <hr>
                                        <br><br><br><br>用户活动信息
                                        <hr>
                                        <div class="widget-main" style="padding: 0;">
                                            <table id="sample-table-2"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead id="targethead">
                                                <tr>
                                                    <th>时间</th>
                                                    <th>ip</th>
                                                    <th>地址</th>
                                                    <th>行为</th>

                                                    <th>设备</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($userList as $v) { ?>
                                                    <tr>
                                                        <td><?php echo $v['online']; ?></td>
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['user_email']; ?></td>
                                                        <td><?php echo $v['userIDCardName']; ?></td>

                                                        <td><?php echo $v['userIDCardName']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="modal-body no-padding">
                                            <div id="solveremark"></div>
                                            <div id="btn_ns_span" class="form-group">
                                                <button onclick="javascript:history.back(-1);"
                                                        class="btn btn-xs btn-success "
                                                        style="margin-top: 1px; margin-left: 10px;">
                                                    <span
                                                            class="bigger-110">返回</span>
                                                </button>
                                                <button onclick="javascript:ajaxSave()"
                                                        class="btn btn-xs btn-success "
                                                        style="margin-top: 1px; margin-left: 10px;">
                                                    <span class="bigger-110">提交</span>
                                                </button>
                                            </div>
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
<!-- /.main-container -->
<script src="<?php echo base_url() . 'res/js/jquery-2.0.3.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace-elements.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'res/js/ace.min.js'; ?>"></script>

<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="../res/js/date-time/moment.min.js"></script>
<script src="../res/js/date-time/daterangepicker.min.js"></script>
<script src="../res/js/date-time/daterangepicker.min.js"></script>
</body>
<script type="text/javascript">
    /**
     * 重置
     */
    function reset() {
        $("#solveremark").html("");
        $("#user_id").val("");
        $("#phonesystem").val("");
        $("#phonemodel").val("");
        $("#networktype").val("");
        $("#address").val("");
        $("#appsize").val("");
        $("#appsource").val("");
        $("#bugtype").val("bug");
        $("#describe").val("");
    }

    function ajaxSave() {
        var _url = "<?php echo site_url('no3/userList/ajaxUserDetailSave'); ?>";

        // 用户基础信息
        var userId = $('#userId').val().trim();
        var realName = $('#realName').val().trim();
        var mobileNumber = $('#mobileNumber').val().trim();
        var userTag = $('#userTag').val();
        var note = $('#note').val().trim();

        // 账户信息
        var aliPayAccount = $('#aliPayAccount').val().trim();

        // 用户权限设置
        var userCharge = $('#userCharge').val();
        var userTakeMoney = $('#userTakeMoney').val();
        var userBet = $('#userBet').val();
        var accountBalance = $('#accountBalance').val();

//       if (userId == '') {
//            $("#solveremark").html("<font color=\"red\">玩家帐号不可空!</font>");
//            return;
//        }

        var _data_obj = {
            userId: userId,
            realName: realName,
            mobileNumber: mobileNumber,
            userTag: userTag,
            note: note,

            aliPayAccount: aliPayAccount,

            userCharge: userCharge,
            userTakeMoney: userTakeMoney,
            userBet: userBet,
            accountBalance: accountBalance
        };
        $("#solveremark").html("<font color=\"red\">提交中，请稍等。。。</font>");
        $.ajax({
            type: "POST",
            url: _url,
            data: _data_obj,
            dataType: "json",
            beforeSend: function () {
            },
            success: function (data) {
                if (data.status == 0) {
                    $("#solveremark").html("<font color=\"red\">" + data.msg + "</font>");
                    return false;
                } else {
                    $("#solveremark").html("<font color=\"red\">保存成功</font>");
                    return true;
                }
            }
        });
    }


    String.prototype.trim = function () {
        // 用正则表达式将前后空格
        // 用空字符串替代。
        return this.replace(/(^\s*)|(\s*$)/g, "");
    }

</script>
</html>
