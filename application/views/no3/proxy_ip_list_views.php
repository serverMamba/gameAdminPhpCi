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
											<b> 在用Proxys(VIP3):</b><br/><div><?php echo $vip3_proxys;?></div>
											<b> 在用Proxys(VIP2):</b><br/><div><?php echo $vip2_proxys;?></div>
											<b> 在用Proxys(VIP):</b><br/><div><?php echo $vip_proxys;?></div>
											<b> 在用Proxys(NOT VIP):</b><br/><div><?php echo $notvip_proxys;?></div>
										</div>
										<hr/>
										<div class="widget-toolbox padding-8 clearfix">
											<select id="packagename" name="packagename" onchange="selectPacket('<?php echo site_url('no3/proxyIp'); ?>')">
												<option value="0">全部</option>
													<?php foreach ($taglist as $k=>$v){ ?>
													<option <?php if($select_tag == $k){ ?> selected="selected" <?php } ?> value="<?php echo $k; ?>" ><?php echo $v;?></option>
													<?php } ?>
											</select>
											<button onclick="syncDbToRedis();"  class="btn btn-danger" style="border: none;margin-bottom: 10px;">全部同步到Redis</button>
                                        </div>
                                        <div><font id="cus_msg" color="red"></font></div>
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>游戏</th>
															<th>tag</th>
															<th>proxy ip(请用“,”分割)</th>
															<th>操作</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($packageList as $v){ ?>
														<tr>
															<td><?php echo $v['name']; ?></td>
															<td><?php echo $v['packagename']; ?></td>
															<td><textarea class="form-control"><?php echo $v['ip_list']; ?></textarea> </td>
															<td>
																<a href="javascript:;" onclick="saveIp('<?php echo site_url('no3/proxyIp/ajaxSaveProxyIp')?>','<?php echo $v['packagename']; ?>',this);" style="color:red;">保存</a>
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
	<script>
		function selectPacket(url){
			var packetname = $('#packagename').val();
			location.href = url + '?tag=' + packetname;
		}

		function saveIp(post_url,tag,obj){
			var ip_list = $(obj).parent().prev().children().val();			
			$.ajax({
	            type:"POST",
	            url:post_url,
	            data:{tag:tag,ip_list:ip_list},
	            dataType: "json",
	            beforeSend:function(){
				},         
	            success:function(data){
	           		if(data.status == 0){
						alert(data.msg);
						return false;
	               	}else{
	               		alert(data.msg);            		
	               	}           
	            }          
	         });
		}

		function syncDbToRedis(){
			var flag = confirm('确定要全部同步么？\n（如果DB或Redis没有单独修改过，则无需同步）');
			if(!flag){return;}
			document.getElementById("cus_msg").innerHTML = "同步中，请稍候。。。";
			var post_url = "<?php echo site_url('no3/proxyIp/ajaxSyncDbToRedis')?>";
			$.ajax({
	            type:"POST",
	            url:post_url,
	            dataType: "json",
	            beforeSend:function(){
				},         
	            success:function(data){
	           		if(data.status == 0){
		           		alert(data.msg);
	           			document.getElementById("cus_msg").innerHTML = "";
						return false;
	               	}else{
	               		alert(data.msg);
	               		document.getElementById("cus_msg").innerHTML = "";          		
	               	}           
	            }          
	         });
		}
	</script>
</body>
</html>