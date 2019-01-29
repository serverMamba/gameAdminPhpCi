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
															<th>斗地主普通</th>
															<th>斗地主欢乐</th>
															<th>斗地主癞子</th>
															<th>扎金花</th>
															<th>百人扎金花</th>
															<th>牛牛</th>
															<th>抢庄牛牛</th>
															<th>百人牛牛</th>
															<th>娱乐城</th>
															<th>捕鱼</th>
															<th>马来牛牛</th>
															<th>十三张</th>
															<th>三公</th>
															<th>红黑大战</th>
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
															<td style="font-weight:bold;color: <?php if ($v['ddz'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['ddz']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['ddzhl'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['ddzhl']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['ddzlz'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['ddzlz']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['zhajinhua'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['zhajinhua']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['zhajinhuabr'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['zhajinhuabr']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['niuniu'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['niuniu']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['niuniuqz'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['niuniuqz']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['niuniubr'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['niuniubr']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['videoarcade'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['videoarcade']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['fishing'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['fishing']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['niuniuml'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['niuniuml']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['shisanzhang'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['shisanzhang']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['sangong'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['sangong']; ?></td>
															<td style="font-weight:bold;color: <?php if ($v['hongheidz'] == 1){ echo 'darkgreen'; } else { echo 'red'; }?>"><?php echo $v['hongheidz']; ?></td>
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
  		<div class="modal-dialog modal-lg" style="margin-top:100px; width:400px">
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
						<div id="modalDDZ">
							<input type="checkbox" class="" style = "margin:5px;">斗地主
						</div>
						<div id="modalDDZHL">
							<input type="checkbox" class="" style = "margin:5px;">斗地主欢乐
						</div>
						<div id="modalDDZLZ">
							<input type="checkbox" class="" style = "margin:5px;">斗地主癞子
						</div>
						<div id="modalZJH">
							<input type="checkbox" class="" style = "margin:5px;">扎金花
						</div>
						<div id="modalZJHBR">
							<input type="checkbox" class="" style = "margin:5px;">百人扎金花
						</div>
						<div id="modalNN">
							<input type="checkbox" class="" style = "margin:5px;">牛牛
						</div>
						<div id="modalNNQZ">
							<input type="checkbox" class="" style = "margin:5px;">牛牛抢庄
						</div>
						<div id="modalNNBR">
							<input type="checkbox" class="" style = "margin:5px;">百人牛牛
						</div>
						<div id="modalArcade">
							<input type="checkbox" class="" style = "margin:5px;">娱乐城
						</div>
						<div id="modalFishing">
							<input type="checkbox" class="" style = "margin:5px;">捕鱼
						</div>
						<div id="modalNiuniuml">
							<input type="checkbox" class="" style = "margin:5px;">马来牛牛
						</div>
						<div id="modalShisanzhang">
							<input type="checkbox" class="" style = "margin:5px;">十三张
						</div>
						<div id="modalSangong">
							<input type="checkbox" class="" style = "margin:5px;">三公
						</div>
						<div id="modalHongheidz">
							<input type="checkbox" class="" style = "margin:5px;">红黑大战
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
				DDZ : 4,
				DDZHL : 5,
				DDZLZ : 6,
				ZHAJINHUA : 7,
				ZHAJINHUA_BR : 8,
				NIUNIU : 9,
				NIUNIU_QZ : 10,
				NIUNIU_BR : 11,
				VIDEO_ARCADE : 12,
				FISHING : 13,
				NIUNIUML : 14,
				SHISANZHANG : 15,
				SANGONG : 16,
				HONGHEIDZ : 17,
		};

		var CHANGE_ITEMS = {
				useDefault : {id : "#modalUseDefault", tableColumn : TABLE_COLUMN.USE_DEFAULT},
				ddz : {id : "#modalDDZ", tableColumn : TABLE_COLUMN.DDZ},
				ddzhl : {id : "#modalDDZHL", tableColumn : TABLE_COLUMN.DDZHL},
				ddzlz : {id : "#modalDDZLZ", tableColumn : TABLE_COLUMN.DDZLZ},
				zhajinhua : {id : "#modalZJH", tableColumn : TABLE_COLUMN.ZHAJINHUA},
				zhajinhuabr : {id : "#modalZJHBR", tableColumn : TABLE_COLUMN.ZHAJINHUA_BR},
				niuniu : {id : "#modalNN", tableColumn : TABLE_COLUMN.NIUNIU},
				niuniuqz : {id : "#modalNNQZ", tableColumn : TABLE_COLUMN.NIUNIU_QZ},
				niuniubr : {id : "#modalNNBR", tableColumn : TABLE_COLUMN.NIUNIU_BR},
				videoarcade : {id : "#modalArcade", tableColumn : TABLE_COLUMN.VIDEO_ARCADE},
				fishing : {id : "#modalFishing", tableColumn : TABLE_COLUMN.FISHING},
				niuniuml : {id : "#modalNiuniuml", tableColumn : TABLE_COLUMN.NIUNIUML},
				shisanzhang : {id : "#modalShisanzhang", tableColumn : TABLE_COLUMN.SHISANZHANG},
				sangong : {id : "#modalSangong", tableColumn : TABLE_COLUMN.SANGONG},
				hongheidz : {id : "#modalHongheidz", tableColumn : TABLE_COLUMN.HONGHEIDZ}, 
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
	            url:"<?php echo site_url('no3/gameswitch/switchGame'); ?>",
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
						
		               	window.location.href = "<?php echo site_url('no3/gameswitch/index'); ?>";
	               	}           
	            }, 
	            error: function() {
	            	$('#modify_modal').modal('hide');
	            	window.location.href = "<?php echo site_url('no3/gameswitch/index'); ?>";
	            	return;
	            }          
	         });
		}
	</script>
</body>
</html>
