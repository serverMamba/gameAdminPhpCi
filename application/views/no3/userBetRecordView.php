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
                                            action="<?php echo site_url('no3/userBetRecord/index');?>"
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
                                            <select name="gameId" id="gameId"
                                                    style="margin-left: 0px; width: 120px;">
                                                <?php foreach ($gameIdName as $k => $v) {
                                                    if (isset($query['gameId']) && intval($k) === intval($query['gameId'])) {
                                                        ?>
                                                        <option value="<?php echo $k; ?>" selected><?php echo $v; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <input
                                                value="<?php if($query['baseScore']){echo $query['baseScore']; }?>"
                                                type="text" placeholder="房间底分" name="baseScore"
                                                class="col-xs-10 col-sm-2"
                                                style="margin-left: 5px; height: 34px; width: 80px;" />
                                            <input
                                                value="<?php if($query['userId']){echo $query['userId']; }?>"
                                                type="text" placeholder="用户id" name="userId"
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
                                                    <th>用户id</th>
                                                    <th>用户昵称</th>
                                                    <th>游戏名称</th>
                                                    <th>房间底分</th>

                                                    <th>牌局编号</th>
                                                    <th>输赢</th>
                                                    <th>开始金币</th>
                                                    <th>结束金币</th>

                                                    <th>游戏时长(秒)</th>
                                                    <th>游戏时间</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($betRecord as $v){ ?>
                                                    <tr>
                                                        <td><?php echo $v['userId']; ?></td>
                                                        <td><?php echo $v['userNickname']; ?></td>
                                                        <td><?php echo $v['gameName']; ?></td>
                                                        <td><?php echo $v['roomBaseScore']; ?></td>

                                                        <td><?php echo $v['gameNumber']; ?></td>
                                                        <td><?php echo $v['userGameResult']; ?></td>
                                                        <td><?php echo $v['userScoreBegin']; ?></td>
                                                        <td><?php echo $v['userScoreEnd']; ?></td>

                                                        <td><?php echo $v['gameTime']; ?></td>
                                                        <td><?php echo $v['recordTimestamp']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>

                                            <div class="modal-footer no-margin-top">
                                                <?php echo $this->pagination->create_links();?>
                                            </div>


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

<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/date-time/moment.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/date-time/daterangepicker.min.js'; ?>"></script>
<script src="<?php echo base_url().'res/js/date-time/daterangepicker.min.js'; ?>"></script>

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

</script>
</body>
</html>