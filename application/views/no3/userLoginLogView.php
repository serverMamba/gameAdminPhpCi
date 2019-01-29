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
                                                type="text" placeholder="ip" name="admin_name"
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
                                                    <th>最后登录时间</th>
                                                    <th>用户id</th>
                                                    <th>ip</th>
                                                    <th>地址</th>
                                                    <th>设备</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($userLoginLog as $v){ ?>
                                                    <tr>
                                                        <td><?php echo $v['last_login_time']; ?></td>
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['lastLoginIp']; ?></td>
                                                        <td><?php echo $v['location']; ?></td>

                                                        <td><?php echo $v['activate_device']; ?></td>
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