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
                                            <button class="btn btn-xs btn-success "
                                                    style="margin-top: 3px;">
                                                <span class="bigger-110">添加</span>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main" style="padding: 0;">
                                            <table id="sample-table-2"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead id="targethead">
                                                <tr>
                                                    <th>标签名称</th>
                                                    <th>排序</th>
                                                    <th>人数</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($tg_account_list as $v){ ?>
                                                    <tr>
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['account']; ?></td>
                                                        <td><?php echo $v['channel_name']; ?></td>
                                                        <td><?php echo $v['agent_balance']/100; ?>元</td>
                                                        <td><?php echo $v['balance']/100; ?>元</td>
                                                        <td><?php echo $v['status'] ? '启用' : '关闭'; ?></td>
                                                        <td><?php if($v['last_login_time']){ echo date('Y-m-d H:i:s',$v['last_login_time']); }else{echo '-'; } ?></td>
                                                        <td><?php if($v['last_login_ip']){ echo $v['last_login_ip']; }else{echo '-'; } ?></td>
                                                        <td>
                                                            <a href="<?php echo site_url('no3/tgAccount/toEdit/'.$v['id']); ?>">修改</a>
                                                            <a href="<?php echo site_url('no3/tgAccount/operationList/'.$v['id']); ?>">操作日志</a>
                                                            <?php if($flagEditAgentBalance){?>
                                                                <a href="<?php echo site_url('no3/tgAccount/toEditAgentBalance/'.$v['id']); ?>">修改信用金</a>
                                                            <?php }?>
                                                            <a href="<?php echo site_url('no3/tgAccount/income/'.$v['id']); ?>">收入统计</a>
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
</body>
</html>