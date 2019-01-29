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
											<form action="<?php echo site_url('no3/gameagentapply/index');?>" style="float:left;" class="form-horizontal">
	                                            <input value="<?php if($query['name']){echo $query['name']; }?>"  type="text" placeholder="姓名" name="name" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['telephone']){echo $query['telephone']; }?>" type="text" placeholder="手机号" name="telephone"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['qq']){echo $query['qq']; }?>"  type="text" placeholder="QQ号" name="qq" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:80px;"/>
	                                            <input value="<?php if($query['weixin']){echo $query['weixin']; }?>" type="text" placeholder="微信号" name="weixin"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<input value="<?php if($query['ip']){echo $query['ip']; }?>" type="text" placeholder="IP地址" name="ip"  class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:80px;"/> 
												<select name="status">
	                                            	<option value="">审核状态</option>
	                                            	<option value="0" <?php if("0"==="".$query['status']){echo 'selected = \"selected\"';}?>>待审核</option>
	                                            	<option value="1" <?php if("1"==="".$query['status']){echo 'selected = \"selected\"';}?>>通过</option>
	                                            	<option value="2" <?php if("2"==="".$query['status']){echo 'selected = \"selected\"';}?>>驳回</option>
												</select>
												<button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                                <span class="bigger-110">查询</span>
	                                                <i class="icon-search icon-on-right"></i>
	                                            </button>
	                                         </form>
                                        </div>
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<button onclick="batchProcess(0);" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批处理为待审核</button>
												<button onclick="batchProcess(1);" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批处理为通过</button>
												<button onclick="batchProcess(2);" class="btn btn-danger" style="border: none;margin-bottom: 10px;">批处理为驳回</button>
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><input type="checkbox" id="header_checkbox" onclick="checkAll(this)" /></th>
																<th>姓名</th>
																<th>手机号</th>
																<th>QQ</th>
																<th>微信</th>
																<th>IP</th>
																<th>审核状态</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($gameagentapply_list)){ foreach ($gameagentapply_list as $v){ ?>
															<tr>
																<td><input type="checkbox" class="line_check_box" name="select_cash_ids[]" value="<?php echo $v['id']; ?>" /></td>
																<td><?php echo $v['name']; ?></td>
																<td><?php echo $v['telephone']; ?></td>
																<td><?php echo $v['qq']; ?></td>
																<td><?php echo $v['weixin']; ?></td>
																<td><?php echo $v['ip']; ?></td>
																<!-- 
																<td>
																	<input id="<?php echo 'statusradio_0_'.$v['id']?>" type="radio" onchange="ajaxChangeStatus0(<?php echo $v['id']?>)" name="<?php echo 'status_'.$v['id']?>" value="0" <?php if("0"=="".$v['status']){ ?> checked="checked" <?php } ?>> 待审核
																	<input id="<?php echo 'statusradio_1_'.$v['id']?>" type="radio" onchange="ajaxChangeStatus1(<?php echo $v['id']?>)" name="<?php echo 'status_'.$v['id']?>" value="1" <?php if("1"=="".$v['status']){ ?> checked="checked" <?php } ?>> 通过
																	<input id="<?php echo 'statusradio_2_'.$v['id']?>" type="radio" onchange="ajaxChangeStatus2(<?php echo $v['id']?>)" name="<?php echo 'status_'.$v['id']?>" value="2" <?php if("2"=="".$v['status']){ ?> checked="checked" <?php } ?>> 驳回
																	
																	<select id="<?php echo 'statusselect_'.$v['id']?>" name="status">
						                                            	<option value="0" <?php if("0"==="".$v['status']){echo 'selected = \"selected\"';}?>>待审核</option>
						                                            	<option value="1" <?php if("1"==="".$v['status']){echo 'selected = \"selected\"';}?>>通过</option>
						                                            	<option value="2" <?php if("2"==="".$v['status']){echo 'selected = \"selected\"';}?>>驳回</option>
																	</select>
																	<input id="<?php echo 'statusradio_val_'.$v['id']?>" type="hidden" value="<?php echo $v['status']?>"/> 
																</td>-->
																<td><?php if($v['status'].''==='1'){echo '通过';}else if($v['status'].''==='2'){echo '驳回';}else{ echo '待审核';} ?></td>
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
	
	<script type="text/javascript">
	/**
	$(function(){
		$('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
			$("#id_date_picker_1").focus();
		});
		$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#id_date_picker_2").focus();
		});
	});
	**/
	function ajaxChangeStatus0(vid)
	{
		vid = ""+vid;
		doAjaxChangeStatus(vid,"0");
	}
	function ajaxChangeStatus1(vid)
	{
		vid = ""+vid;
		doAjaxChangeStatus(vid,"1");
	}
	function ajaxChangeStatus2(vid)
	{
		vid = ""+vid;
		doAjaxChangeStatus(vid,"2");
	}
	function doAjaxChangeStatus(vid,status)
	{
		var url = "<?php echo site_url('no3/gameagentapply/ajaxChangeStatus');?>";
		$.ajax({
            type:"POST",
            url:url,
            data:{id:vid,status:status},
            dataType: "json",
            beforeSend:function(){
			}, 
            success:function(data){
           		if(data.status == 1){
           			alert("修改成功!");
           			$("#statusradio_val_"+vid).val(""+status);
					return false;
               	}else{
               		alert("修改失败!");
               		var old_val = document.getElementById("statusradio_val_"+vid).value;
               		$("#statusradio_"+old_val+"_"+vid).prop("checked","checked");;
                   	return true;
               	}         
            }          
         });
	}

	function batchProcess(status){
		var url = "<?php echo site_url('no3/gameagentapply/batchProcess');?>";
		url += "?status="+status;
		$("#of").attr("action", url);
		$("#of").submit();
	}
	
	function checkAll(obj){
		$("#tbody input[type='checkbox']").prop('checked', $(obj).prop('checked'));
	}
	
	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}
	</script>
</body>
</html>