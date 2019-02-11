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
                <?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                <?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 widget-container-span">

                                <div class="widget-box">

                                    <div class="widget-toolbox padding-8 clearfix">
                                        <form
                                                action="<?php echo site_url('no3/userList');?>"
                                                method="post"
                                                style="float: left;">
                                            <input
                                                    value="<?php if($query['dateBegin']){echo $query['dateBegin']; }?>"
                                                    name="dateBegin" class="date-picker col-xs-10 col-sm-2"
                                                    id="dateBegin" placeholder="开始时间" type="text"
                                                    data-date-format="yyyy-mm-dd"
                                                    autocomplete="off"
                                                    style="margin-left: 5px; height: 30px; width: 100px;" />
                                            <input
                                                    value="<?php if($query['dateEnd']){echo $query['dateEnd']; }?>"
                                                    name="dateEnd" class=" date-picker col-xs-10 col-sm-2"
                                                    id="dateEnd" placeholder="终止时间" type="text"
                                                    data-date-format="yyyy-mm-dd"
                                                    autocomplete="off"
                                                    style="margin-left: 5px; height: 30px; width: 100px;" />
                                            <input
                                                    value="<?php if($query['userId']){echo $query['userId']; }?>"
                                                    type="text" placeholder="用户id" name="userId"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['account']){echo $query['account']; }?>"
                                                    type="text" placeholder="账号" name="account"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['mobileNumber']){echo $query['mobileNumber']; }?>"
                                                    type="text" placeholder="手机号码" name="mobileNumber"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['realName']){echo $query['realName']; }?>"
                                                    type="text" placeholder="真实姓名" name="realName"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['aliPayAccount']){echo $query['aliPayAccount']; }?>"
                                                    type="text" placeholder="支付宝账号" name="aliPayAccount"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <button class="btn btn-xs btn-success "
                                                    style="margin-top: 3px;"
                                                    type="submit"
                                            >
                                                <span class="bigger-110">查询</span> <i
                                                        class="icon-search icon-on-right"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main" style="padding: 0;">
                                            <table id="sample-table-2"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead id="targethead">
                                                <tr>
                                                    <th>在线</th>
                                                    <th>用户id</th>
                                                    <th>账号</th>
                                                    <th>真实姓名</th>

                                                    <th>上级</th>
                                                    <th>下级人数</th>
                                                    <th>注册日期</th>
                                                    <th>状态</th>

                                                    <th>账户余额</th>
                                                    <th>玩家状态</th>
                                                    <th>金币</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($userList as $v){ ?>
                                                    <tr>
                                                        <td><?php echo $v['online']; ?></td>
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['user_email']; ?></td>
                                                        <td><?php echo $v['userIDCardName']; ?></td>

                                                        <td><?php echo $v['upLine']; ?></td>
                                                        <td><?php echo $v['downLineNum']; ?></td>
                                                        <td><?php echo $v['registertime']; ?></td>
                                                        <td><?php echo $v['isBlack'] ?></td>

                                                        <td><?php echo $v['balance'] ?></td>
                                                        <td><?php echo $v['userSealStatus'] ?></td>
                                                        <td><?php echo $v['user_chips'] ?></td>
                                                        <td>
                                                            <a href="<?php echo site_url('no3/userList/userDetailGet') . "?userId=" . $v['id']; ?>">详情</a>
                                                            |
                                                            <?php if ($v['userSealStatus'] == '启用') { ?>
                                                            <a onclick="sealOne('<?php echo $v['id']; ?>');" href="javascript:;">禁用</a>
                                                            <?php } else { ?>
                                                                <a onclick="unsealOne('<?php echo $v['id']; ?>');" href="javascript:;">启用</a>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>


                                            <div class="modal-body no-padding"></div>

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
<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>

<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="../res/js/date-time/moment.min.js"></script>
<script src="../res/js/date-time/daterangepicker.min.js"></script>
<script src="../res/js/date-time/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#dateBegin').datepicker({autoclose:true}).on(ace.click_event, function(){
            $("#dateBegin").focus();
        });
        $('#dateEnd').datepicker({autoclose:true}).on(ace.click_event, function(){
            $("#dateEnd").focus();
        });

    });

    function updateYestadayData(){
        location.href = '<?php echo site_url('no3/finStatistics/getNewDataForYestaday'); ?>';
        return true;
    }

    function sealOne(id) {
        if (!confirm('确定禁用吗？')) {
            return;
        }

        location.href = '<?php echo site_url('no3/userList/blacklistSeal') . "?id="; ?>' + id;
        return;
    }

    function unsealOne(id) {
        if (!confirm('确定启用吗？')) {
            return;
        }

        location.href = '<?php echo site_url('no3/userList/blacklistUnseal') . "?id="; ?>' + id;
        return;
    }

</script>
</body>
</html>