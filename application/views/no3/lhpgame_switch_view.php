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
										<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th>渠道Id</th>
															<th>渠道名</th>
															<th>渠道包名</th>
															<th>是否使用默认配置</th>
															<th>平安游戏</th>
															<th>编辑</th>
														</tr>
													</thead>
													<tbody>
													<?php if(!empty($game_switch_list)){ foreach ($game_switch_list as $k => $v){ ?>
														<tr id="<?php echo 'lineIndex' . $k?>">
															<td><?php echo $v['channelId']; ?></td>
															<td><?php echo $v['channelName']; ?></td>
															<td><?php echo $v['channelTag']; ?></td>
															<td style="font-weight:bold;color:<?php if ($v['useDefault'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>;">
																<?php if ($v['channelId'] == 0) {echo "";} else {echo $v['useDefault'];} ?>
															</td>
															<td style="font-weight:bold;color: <?php if ($v['lhp'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['lhp']; ?></td>
															<td><a onclick="editGameSwitch(<?php echo $k;?>);">编辑</a></td>
														</tr>
													<?php }} ?>
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
	
	<!-- 修改内容的模态框 -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modify_modal">
  		<div class="modal-dialog modal-lg" style="margin-top:200px; width:400px">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="chatModalTitle">修改游戏开关</h4>
			    </div>
			    <div class="modal-body">
					<div style="margin-top: 10px;width: 100%; overflow:hidden">
						<h5 id="modalGameName"></h5>
						<div id="modalUseDefault" style="font-weight:bold;color:red">
							<input type="checkbox" class="" style = "margin:5px;">使用默认
						</div>
						<div id="modalLHP">
							<input type="checkbox" class="" style = "margin:5px;">平安游戏
						</div>

						<button style="margin-top: 5px;float: right;" onclick="confirmModify();" id="reply_btn" class="btn btn-success">确定修改</button>
					</div>
				</div>
    		</div>
  		</div>
	</div>

	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script>
		var TABLE_COLUMN = {
				CHANNEL_ID : 0,
				CHANNEL_NAME : 1,
				USE_DEFAULT : 3,
				LHP : 4,
		};

		var CHANGE_ITEMS = {
				useDefault : {id : "#modalUseDefault", tableColumn : TABLE_COLUMN.USE_DEFAULT},
				lhp : {id : "#modalLHP", tableColumn : TABLE_COLUMN.LHP},
		}

		// 正在修改的channelId
		var nowModifyChannelId = -1;
		function editGameSwitch(index)
		{
			var children = $('#lineIndex' + index).children();
			nowModifyChannelId = parseInt($(children[TABLE_COLUMN.CHANNEL_ID]).text());

			// 初始化model并显示
			$('#modalGameName').text("渠道名：" + $(children[TABLE_COLUMN.CHANNEL_NAME]).text());
			if (nowModifyChannelId == 0)
			{
				$('#modalUseDefault').hide();
			}
			else
			{
				$('#modalUseDefault').show();
			}

			for (var i in CHANGE_ITEMS)
			{
				setChecked(i, children);
			}
			
			$('#modify_modal').modal('show');
		}

		// 设置模态框对应项选中
		function setChecked(itemName, rowTDs)
		{
			var item = CHANGE_ITEMS[itemName];
			$(item.id + ' input').attr('checked', parseInt(rowTDs.eq(item.tableColumn).text()) == 0 ? false : true);
		}

		// 获取模态框对应项选中
		function getChecked(itemName)
		{
			var item = CHANGE_ITEMS[itemName];
			var checked = $(item.id + ' input').eq(0).prop("checked");

			return checked ? 1 : 0;
		}

		function confirmModify()
		{
			var modifyData = {};

			for (var i in CHANGE_ITEMS)
			{
				var checked = getChecked(i);
				modifyData[i] = checked;
			}
			
			$.ajax({
	            type:"POST",
	            url:"<?php echo site_url('no3/lhpgameswitch/switchGame'); ?>",
	            data:{channelId : nowModifyChannelId, data : JSON.stringify(modifyData)},
	            dataType: "json",
	            beforeSend:function(){
				},
	            success:function(data){
	           		if(data.status == 0){
						alert(data.msg);
						return false;
	               	}else{
		               	// 重新刷新本页
						alert("修改成功");
						$('#modify_modal').modal('hide');
						
		               	window.location.href = "<?php echo site_url('no3/lhpgameswitch/index'); ?>";
	               	}           
	            }, 
	            error: function() {
	            	$('#modify_modal').modal('hide');
	            	window.location.href = "<?php echo site_url('no3/lhpgameswitch/index'); ?>";
	            	return;
	            }          
	         });
		}
	</script>
</body>
</html>
