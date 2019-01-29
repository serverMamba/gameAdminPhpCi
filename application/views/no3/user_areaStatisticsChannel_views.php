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
					<div class="row">
						<div class="col-xs-12">
							<?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                			<?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>
							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
								    <form action="<?php echo site_url('no3/areaStatisticsChannel/index');?>" method="post" style="float:left;" class="form-horizontal">
										<input value="<?php if($query['start_time']){echo $query['start_time']; }?>" name="start_time" class="date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="开始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
	                                    <input value="<?php if($query['end_time']){echo $query['end_time']; }?>" name="end_time" class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
										<select id="usertype" name="usertype" onchange="changeChannel('<?php echo site_url('no3/areaStatisticsChannel'); ?>')">
											<option value="registertime" <?php if($query['usertype'] == 'registertime'){ ?> selected="selected" <?php } ?>>新增玩家</option>
											<option value="last_login_time" <?php if($query['usertype'] == 'last_login_time'){ ?> selected="selected" <?php } ?>>活跃玩家</option>
											<!-- <option value="rl" <?php if($query['usertype'] == 'rl'){ ?> selected="selected" <?php } ?>>新增|活跃</option> -->
										</select>
										<select id="select_area_province" name="select_area_province">
											<option value="">全部省份</option>
											<?php foreach ($query['area_province'] as $v){ ?>
											<option value="<?php echo $v; ?>" <?php if($query ['select_area_province'] == $v){ ?> selected="selected" <?php } ?>><?php if($v){ echo $v;}else{echo '未知区域';}?></option>
											<?php } ?>
										</select>
										<select id="select_area_city" name="select_area_city">
											<option value="">全部城市</option>
											<?php foreach ($query['area_city'] as $v){ ?>
											<option value="<?php echo $v; ?>" <?php if($query ['select_area_city'] == $v){ ?> selected="selected" <?php } ?>><?php if($v){ echo $v;}else{echo '未知区域';}?></option>
											<?php } ?>
										</select>
										
										<select id="channel_id" name="channel_id">
											<option value="">全部渠道</option>
											<?php foreach ($channel_list as $k=>$v){ ?>
											<option value="<?php echo $k; ?>" <?php if($query ['channel_id'] == $k){ ?> selected="selected" <?php } ?>><?php echo $v;?></option>
											<?php } ?>
										</select>
										<button class="btn btn-xs btn-success " style="margin-top:3px;">
	                                    	<span class="bigger-110">查询</span>
	                                        <i class="icon-search icon-on-right"></i>
	                                    </button>
	                                    <span><font style="font-weight:bold;font-style:italic;">支持统计一个月内的数据</font></span>
									</form>
									<div class="widget-box">
									    <table id="chart_table" style="width: 100%;height: 500px;">
									    	<tr style="width: 100%;height: 500px;">
									    		<td id="chart_td_piechart"  style="width: 600px;height: 500px;">
													<div id="container" style="width:100%;height:100%;margin:0 auto"></span>
												</td>
												<td id="chart_td_columnchart"  style="height: 500px;">
													<canvas id="myChart" style="width: 100%;height: 100%;"></canvas>
												</td>
											</tr>
									    </table>
									</div>
									<!-- 
									<div class="widget-box">																	
										<canvas id="myChart" style="width: 300px;height: 100px;"></canvas>
									</div> -->
									<br/>
									<div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<form action="" method="post" name="of" id="of">
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th><?php echo $thArr[1];?></th>
																<th><?php echo $thArr[2];?></th>
																<th><?php echo $thArr[3];?></th>
																<th><?php echo $thArr[4];?></th>
																<th><?php echo $thArr[5];?></th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($db_data)){ foreach ($db_data as $v){ ?>
															<tr>
																<td><?php echo $v['index']; ?></td>
																<td><?php if($v['areaName']){ echo $v['areaName'];}else{echo '未知区域';}?></td>
																<td><?php echo $v['recNum']; ?></td>
																<td><?php echo $v['rate']; ?></td>
																<td><?php echo $v['total']; ?></td>
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
	<script src="<?php echo base_url().'js/chart.js'; ?>"></script>	
	<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <!-- 推荐开源CDN来选取需引用的外部JS //-->
    <script src="<?php echo base_url().'js/highcharts.js'; ?>"></script>
    <script src="<?php echo base_url().'js/exporting.js'; ?>"></script>
	<script type="text/javascript">
	 $(function () { 
		 	var pieChartWidth = document.getElementById("chart_td_piechart").style.width;
		 	var pieChartHeight = document.getElementById("chart_td_piechart").style.height;
		 	var tabWidth = document.getElementById("chart_table").style.width;
		 	document.getElementById("chart_td_columnchart").style.width = tabWidth-pieChartWidth;
			var ctx = document.getElementById("myChart").getContext("2d");	
			var bar_data = <?php echo json_encode($chart_data['user_chart']); ?>;			
			window.myBar = new Chart(ctx,{
				type: 'bar',
	            data: bar_data,
	            options: {
	                title: {
	                    display: true,
	                    text: '用户区域统计报表'
	                }
	            }
			});

			var pieData = <?php echo $pieData; ?>;
			var pieTitle = "<?php echo $pieTitle;?>";
			if(""!=(pieData+"")){
				$('#container').highcharts({                                          
			        chart: {                                                          
			        },                                                                
			        title: {                                                          
			            text: ''                                     
			        },                                                            
			        tooltip: {                                                        
			            formatter: function() {                                       
			                var s;                                                    
			                if (this.point.name) { // the pie chart                   
			                    s = ''+                                               
			                        this.point.name +',数量:'+ this.point.value + ',百分比：' + this.y+"%";         
			                } else {                                                  
			                    s = ''+
			                        this.x  +',数量:'+ this.point.value + ',百分比：' + this.y+"%"; 
			                }
			                return s;
			            }                                                             
			        },
			        labels: {                                                         
			            items: [{                                                     
			                html: pieTitle,                          
			                style: {                                                  
			                    left: '120',                                         
			                    top: '8px',                                           
			                    color: 'black'                                        
			                }                                                         
			            }]                                                            
			        },                                                                 
			        series: [{
			            type: 'pie',                                                  
			            name: 'Total consumption',                                    
			            data: pieData,                                                           
			            center: [200, 200],                                            
			            size: 200,                                                    
			            showInLegend: false,                                          
			            dataLabels: {                                                 
			                enabled: true
			            }                                                             
			        }]                                                                
			    });
			}
		       
		    $('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#id_date_picker_1").focus();
			});
			$('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
					$("#id_date_picker_2").focus();
			});
		}); 
		

	 var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
     var randomScalingFactor_255 = function(){ return Math.round(Math.random()*255)};
     var radom_color = function(){
         return '#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);
     }

	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}
	</script>
</body>
</html>