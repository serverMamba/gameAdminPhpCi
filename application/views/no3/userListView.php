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
                                                action="<?php echo site_url('no3/tgCorrection/tgCorrectionLog');?>"
                                                style="float: left;">
                                            <input
                                                    value="<?php if($query['start_time']){echo $query['start_time']; }?>"
                                                    name="start_time" class="date-picker col-xs-10 col-sm-2"
                                                    id="id_date_picker_1" placeholder="开始时间" type="text"
                                                    data-date-format="yyyy-mm-dd"
                                                    autocomplete="off"
                                                    style="margin-left: 5px; height: 30px; width: 100px;" />
                                            <input
                                                    value="<?php if($query['end_time']){echo $query['end_time']; }?>"
                                                    name="end_time" class=" date-picker col-xs-10 col-sm-2"
                                                    id="id_date_picker_2" placeholder="终止时间" type="text"
                                                    data-date-format="yyyy-mm-dd"
                                                    autocomplete="off"
                                                    style="margin-left: 5px; height: 30px; width: 100px;" />
                                            <input
                                                    value="<?php if($query['user_id']){echo $query['user_id']; }?>"
                                                    type="text" placeholder="用户id" name="user_id"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['admin_name']){echo $query['admin_name']; }?>"
                                                    type="text" placeholder="账号id" name="admin_name"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['promotion_old']){echo $query['promotion_old']; }?>"
                                                    type="text" placeholder="手机号码" name="promotion_old"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['promotion_new']){echo $query['promotion_new']; }?>"
                                                    type="text" placeholder="真实姓名" name="promotion_new"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                    value="<?php if($query['promotion_new']){echo $query['promotion_new']; }?>"
                                                    type="text" placeholder="支付宝账号" name="promotion_new"
                                                    class="col-xs-10 col-sm-2"
                                                    style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <button class="btn btn-xs btn-success "
                                                    style="margin-top: 3px;">
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
                                                    <th>账号id</th>
                                                    <th>真实姓名</th>

                                                    <th>上级</th>
                                                    <th>下级人数</th>
                                                    <th>注册日期</th>
                                                    <th>状态</th>

                                                    <th>账户余额</th>
                                                    <th>玩家状态</th>
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
                                                        <td><?php echo $v['userStatus'] ?></td>
                                                        <td><?php echo $v['operation'] ?></td>

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
        $('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
            $("#id_date_picker_1").focus();
        });
        $('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
            $("#id_date_picker_2").focus();
        });

    });

    function updateYestadayData(){
        location.href = '<?php echo site_url('no3/finStatistics/getNewDataForYestaday'); ?>';
        return true;
    }

</script>
</body>
</html>