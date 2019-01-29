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
											<form action="<?php echo site_url('no3/chipslog/index');?>" style="float:left;" class="form-horizontal">
	                                            <!-- <input value="<?php if($query['admin_id']){echo $query['admin_id']; }?>"  type="text" placeholder="操作人" name="admin_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/> -->
	                                            <!-- 
	                                            <select id="operation_chips" class="selectopts">
													<option value="4" <?php if("4" == $query['operation_id']){ ?> selected="selected" <?php } ?>>大于等于</option>
													<option value="5" <?php if("5" == $query['operation_id']){ ?> selected="selected" <?php } ?>>小于等于</option>
													<option value="2" <?php if("2" == $query['operation_id']){ ?> selected="selected" <?php } ?>>大于</option>
													<option value="3" <?php if("3" == $query['operation_id']){ ?> selected="selected" <?php } ?>>小于</option>
													<option value="0" <?php if("0" == $query['operation_id']){ ?> selected="selected" <?php } ?>>等于</option>
													<option value="1" <?php if("1" == $query['operation_id']){ ?> selected="selected" <?php } ?>>不等于</option>
												</select> -->
	                                            <input value="<?php if($query['chips']){echo $query['chips']; }?>" type="text" placeholder="最小金币数" name="chips"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
	                                            <input value="<?php if($query['user_id']){echo $query['user_id']; }?>"  type="text" placeholder="玩家帐号" name="user_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<select name="admin_id">
	                                            	<option value="">操作人</option>
	                                            	<?php foreach ($adminnames as $key => $value){?>
	                                            	<option value="<?php echo $key?>" <?php if($key===$query['admin_id']){echo 'selected = \"selected\"';}?>><?php echo $value?></option>
	                                            	<?php }?>
												</select>
												<button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>操作人</th>
																<th>玩家帐号</th>															
																<th>金币数</th>
																<th>记录时间</th>
																<th>操作描述</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($chipslog_list)){ foreach ($chipslog_list as $v){ ?>
															<tr>
																<td><?php if($v['admin_id']){ echo $adminnames[$v['admin_id']];}else{echo '-';}?></td>
																<td><?php echo $v['user_id']; ?></td>
																<td><?php echo $v['chips']; ?></td>
																<td><?php if($v['add_time']){ echo date("Y-m-d H:i:s",$v['add_time']);}else{echo '-';}?></td>
																<td><?php echo $v['action']; ?></td>
																<?php } ?>	
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="modal-footer no-margin-top">
						<?php echo $this->pagination->create_links();?>											
					</div>
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
	<script src="<?php echo base_url().'js/context.js'; ?>"></script>
	
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
	
	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	</script>
</body>
</html>