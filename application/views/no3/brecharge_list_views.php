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
											<form action="<?php echo site_url('no3/brechargel/index');?>" id="form">
	                                            <input value="<?php if($query['user_id']){echo $query['user_id']; }?>"  type="text" placeholder="用户ID" name="user_id" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:160px;"/>
	                                           	人工客服：
												<select name="admin_id">
													<option value="">全部</option>
													<?php foreach ($kefu_list as $k=>$v){ ?>
													<option <?php if($query['admin_id'] == $v['id']){ ?> selected="selected"
														<?php } ?> value="<?php echo $v['id']; ?>"><?php echo $v['admin_name'];?></option>
													<?php } ?>
												</select>

												<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<div class="input-group bootstrap-timepicker" style="float:left;">
													<input value="<?php if($query['start_time_time']){echo $query['start_time_time'];}else{echo "00:00";}?>" name="start_time_time" id="id_time_picker_1" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
												</div>
	                                            <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
												<div class="input-group bootstrap-timepicker" style="float:left;">
													<input value="<?php if($query['end_time_time']){echo $query['end_time_time'];}else{echo "00:00";}?>" name="end_time_time" id="id_time_picker_2" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
												</div>
												
	                                            <button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                   
                                            </form>
                                            <div style="float: right;">总共充值：<?php echo $sum; ?>元</div>
                                        </div>
   										
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
															<th>状态</th>
															<th>来源</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($order_list as $v){ ?>
														<tr>
															<td><a href="<?php echo site_url('no3/infodetail').'?user_id='.$v['user_id']; ?>"><?php echo $v['user_id']; ?></a></td>
															<td><?php echo $v['money']; ?>元</td>
															<td><?php echo $v['before_chips']; ?></td>
															<td><?php echo $v['after_chips']; ?></td>
															<td <?php if($v['pay_platform'] == '品付'){ ?> onclick="queryOrder('<?php echo site_url('pay/android/queryOrder');?>','<?php echo $v['order_sn']; ?>','<?php echo $v['pay_platform'];?>','<?php echo site_url('pay/android/budan');?>')" <?php } ?>><?php echo $v['order_sn']; ?></td>
															<td><?php echo $v['third_order_sn']; ?></td>
															<td><?php echo $v['add_time'];?></td>														
															<td><?php echo $v['status']; ?></td>
															<td><?php echo '客服ID: '.$v['refer'];?></td>
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
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="order_modal">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
	
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/moment.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/daterangepicker.min.js'; ?>"></script>

	<script type="text/javascript">
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_2").focus();
		});

		$('#id_time_picker_1').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#id_time_picker_1").focus();
			  });
							
		$('#id_time_picker_2').timepicker({
				minuteStep: 1,
				showSeconds: false,
				showMeridian: false
			}).on(ace.click_event, function(){
				$("#id_time_picker_2").focus();
			});  

		$('#order_modal').on('hide.bs.modal', function (e) {
			$('#modal_order_sn').html('');
			$('#modal_money').html('');
			$('#modal_result').html('');
			$('#modal_pay_type').html('');
		})
	});

	function queryOrder(url,order_sn,pay_platform,budan_url){
		$.ajax({
            url: url+'?agent_bill_id='+order_sn+'&pay_platform='+pay_platform,
            dataType: "json",
            beforeSend:function(){
                $('#send_status').show();
            	$('#order_modal').modal('show');
			},         
            success:function(data){
                if(data.status == 0){
                    alert('查不到该订单');
                    return false;
                }

                if(pay_platform == '品付'){
	                $('#modal_order_sn').html(data.agent_bill_id);
	                $('#modal_money').html(data.pay_amt);
	
	                if(data.result == '1'){
	                	$('#modal_result').html('已支付');
	                	var click = "postbudan('"+data.extend+"','"+budan_url+"')";
	                	$('#extend').html('<a target="_blank" href="javascript:;" onclick='+click+'>补单</a>');
	                }else{
	                	$('#modal_result').html('未支付');
	                	$('#extend').html('');
	                }
	                $('#orderModalTitle').html('订单：'+ data.agent_bill_id);		
					
	                
	                $('#send_status').hide(); 
                }   
            }          
         });
	}

	function postbudan(extend,url){
		$.ajax({
            url: url,
            type:"POST",
            data:{msg:extend},
            beforeSend:function(){
			},         
            success:function(res){
                alert(res);
            }          
         });
	}

	/**
	* 查询延时订单
	*/
	function onclickCheckDelayOrders()
	{
		// 修改form的post地址
		$('#form').attr('action', "<?php echo site_url('no3/infodindan/delayOrders');?>");

		// submit
		$('#form').submit();
	}
	</script>
</body>
</html>