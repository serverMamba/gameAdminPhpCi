<?php
$gameId2GameName = array();
foreach($gamelist as $k => $v) 
{
	$gameId2GameName[$v] = $k;
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        <script id="allGameHeadModal" type="text/html" >
        <tr>
            <th class="center">ID</th>
            <th>昵称</th>
            <th>游戏</th>
            <th class="hidden-480">服务器</th>
            <th>输赢状态</th>
            <th>桌费</th>
            <th>开始金豆</th>
            <th>结束金豆</th>
			<th>抽水金币</th>
            <th>游戏时长</th>
            <th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
        </tr>
		</script>

        <script id="allGameDataModal" type="text/html" >
        <tr>
			<td class="center">${user_id}</td>
			<td>${user_nickname}</td>
			<td>${gameName}</td>
			<td class="hidden-480">${room_id}</td>
			<td>${user_game_result}</td>
			<td>${user_table_fee}</td>
			<td>${user_score_begin}</td>
			<td>${user_score_end}</td>
			<td>${earn_score}</td>
			<td>${game_time}</td>
			<td><i class="icon-time bigger-110 hidden-480"></i>${record_timestamp}</td>
        </tr>
		</script>

        <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center">ID</th>
            <th>昵称</th>
            <th>牌局编号</th>
            <th class="hidden-480">服务器</th>
            <th>输赢状态</th>
            <th class="hidden-480">底分</th>
           <!-- <th>番数</th> -->
            <th>桌费</th>
            <th>开始金豆</th>
            <th>结束金豆</th>
			<th>抽水金币</th>
            <th>同桌玩家</th>
            <th>庄家</th>
           <!--  <th>结算牌型</th>-->
            <th>游戏时长</th>
            <th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
        </tr>
		</script>

		<script id="headmodel2" type="text/html" >
			<tr>
				<th class="center">ID</th>
				<th>昵称</th>
				<th>牌局编号</th>
				<th class="hidden-480">服务器</th>
				<th>输赢状态</th>
				<th class="hidden-480">底分</th>
				<th>倍数</th>
				<th>桌费</th>
				<th>开始金币</th>
				<th>结束金币</th>
				<th>抽水金币</th>
				<th>同桌玩家</th>
				<th>地主</th>
				<th>牌型</th>
				<th>游戏时长</th>
				<th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
			</tr>
		</script>
		<script id="datamodel1" type="text/html" >
			<tr>
				<td class="center">${user_id}</td>
				<td>${user_nickname}</td>
				<td>${game_number}</td>
				<td class="hidden-480">${room_id}</td>
				<td>${user_game_result}</td>
				<td class="hidden-480">${room_basescore}</td>
			 <!--   <td>${total_fan_number}</td>  -->
				<td>${user_table_fee}</td>
				<td>${user_score_begin}</td>
				<td>${user_score_end}</td>
				<td>${earn_score}</td>
				<td>${table_users}</td>
				<td>${table_banker}</td>
			 <!--   <td>${fan_ids}</td>  -->
				<td>${game_time}</td>
				<td><i class="icon-time bigger-110 hidden-480"></i>${record_timestamp}</td>
			</tr>
		</script>
		<script id="datamodel2" type="text/html" >
			<tr>
				<td class="center">${user_id}</td>
				<td>${user_nickname}</td>
				<td>${game_number}</td>
				<td class="hidden-480">${room_id}</td>
				<td>${user_game_result}</td>
				<td class="hidden-480">${room_basescore}</td>
				<td>${total_times}</td>
				<td>${user_table_fee}</td>
				<td>${user_score_begin}</td>
				<td>${user_score_end}</td>
				<td>${earn_score}</td>
				<td>${table_users}</td>
				<td>${table_landlord}</td>
				<td>${time_pattern_counts}</td>
				<td>${game_time}</td>
				<td><i class="icon-time bigger-110 hidden-480"></i>${record_timestamp}</td>
			</tr>
		</script>
		
		
		
		<script id="headmodel2x" type="text/html" >
			<tr>
				<th class="center">ID</th>
				<th>昵称</th>
				<th>牌局编号</th>
				<th class="hidden-480">服务器</th>
				<th>输赢状态</th>
				<th class="hidden-480">底分</th>
				<th>倍数</th>
				<th>桌费</th>
				<th>开始金币</th>
				<th>结束金币</th>
				<th>抽水金币</th>
				<th>同桌玩家</th>
				<th>游戏时长</th>
				<th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
			</tr>
		</script>
		<script id="datamodel1x" type="text/html" >
			<tr>
				<td class="center">${user_id}</td>
				<td>${user_nickname}</td>
				<td>${game_number}</td>
				<td class="hidden-480">${room_id}</td>
				<td>${user_game_result}</td>
				<td class="hidden-480">${room_basescore}</td>
				<td>${total_fan_number}</td>
				<td>${user_table_fee}</td>
				<td>${user_score_begin}</td>
				<td>${user_score_end}</td>
				<td>${earn_score}</td>
				<td>${table_users}</td>
				<td>${table_banker}</td>
				<td>${fan_ids}</td>
				<td>${game_time}</td>
				<td><i class="icon-time bigger-110 hidden-480"></i>${record_timestamp}</td>
			</tr>
		</script>
		<script id="datamodel2x" type="text/html" >
			<tr>
				<td class="center">${user_id}</td>
				<td>${user_nickname}</td>
				<td>${game_number}</td>
				<td class="hidden-480">${room_id}</td>
				<td>${user_game_result}</td>
				<td class="hidden-480">${room_basescore}</td>
				<td>${total_times}</td>
				<td>${user_table_fee}</td>
				<td>${user_score_begin}</td>
				<td>${user_score_end}</td>
				<td>${earn_score}</td>
				<td>${table_users}</td>
	 
				<td>${game_time}</td>
				<td><i class="icon-time bigger-110 hidden-480"></i>${record_timestamp}</td>
			</tr>
		</script>

    <?php $this->load->view('no3/common/message'); ?>

    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
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
                    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
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
                    <?php $this->load->view('no3/common/nav_top1'); ?>

                    <div class="row">
                        <div class="col-xs-12">



                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-blue2">
                                            <h5><i class="icon-arrow-left"></i>玩家游戏记录：<label id="mycurrentgameid">全部</label></h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>


                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">
                                            <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    	游戏选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                    <?php foreach ($gamelist as $myname => $myid) { ?>
                                                        <li>
                                                            <a href="javascript:changegame('<?php echo $myid ?>','<?php echo $myname ?>')"><?php echo $myname ?></a>
                                                        </li>
                                                    <?php } ?>
                                                    <li class="divider"></li>
                                                </ul>
                                            </div>
                                            <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/>
                                            <input type="text" id="paijuhao1" placeholder="牌局号"   class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <label></label>
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d H:i:s', time() - 1 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d H:i:s', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:3px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>
                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:getOnlineData()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">查询游戏次数</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div class="widget-body">
                                            <div id="tableData" class="widget-main"  style ="padding:0;">
                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th class="center">ID</th>
                                                            <th>昵称</th>
                                                            <th>牌局编号</th>
                                                            <th class="hidden-480">服务器</th>
                                                            <th>输赢状态</th>
                                                            <th class="hidden-480">底分</th>
                                                          <!--  <th>番数</th>  -->
                                                            <th>桌费</th>
                                                            <th>开始金豆</th>
                                                            <th>结束金豆</th>
                                                            <th>同桌玩家</th>
                                                            <th>庄家</th>
                                                         <!--   <th>结算牌型</th>  -->
                                                            <th>游戏时长</th>
                                                            <th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“获得数据”从服务器加载数据</div>
                                                    <ul class="pagination pull-right no-margin">
                                                        <li class="pageitemleft">
                                                            <a href="javascript:void">
                                                                <i class="icon-double-angle-left"></i>
                                                            </a>
                                                        </li>

                                                        <li class="active pageitemnum">
                                                            <a href="javascript:void">1</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">2</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">3</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">4</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">5</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">6</a>
                                                        </li>
                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">7</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">8</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">9</a>
                                                        </li>
                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">10</a>
                                                        </li>

                                                        <li class="pageitemright">
                                                            <a href="javascript:void">
                                                                <i class="icon-double-angle-right"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-body no-padding">
                                                </div>
                                            </div>
                                            
                                            <!-- 在线游戏次数曲线 -->
                                            <div id="onlineData" class="widget-main"  style ="padding:0; display:none;">
												<div>
													<label class="blue bigger"
														style="font-size: 16px;">游戏次数：</label>
													<label id="totalPlayTimes" class="blue bigger"
														style="font-size: 16px; margin-right:20px"></label>

													<label class="green bigger"
														style="font-size: 16px;">胜利次数：</label>
													<label id="winTimes" class="green bigger"
														style="font-size: 16px;"></label>
													<label id="winRatio" class="green bigger"
														style="font-size: 16px;"></label>

													<label class="red bigger"
														style="font-size: 16px;">失败次数：</label>
													<label id="loseTimes" class="red bigger"
														style="font-size: 16px;"></label>
													<label id="loseRatio" class="red bigger"
														style="font-size: 16px;"></label>

													<label class="brown bigger"
														style="font-size: 16px;">平局次数：</label>
													<label id="drawTimes" class="brown bigger"
														style="font-size: 16px;"></label>
													<label id="drawRatio" class="brown bigger"
														style="font-size: 16px;"></label>
													
												</div>
												<div>
													<canvas id="myChart" style="width: 300px;height: 100px;"></canvas>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /row -->

                            <div class="hr hr32 hr-dotted"></div>
                            <div class="row">
                            </div>
                            <div class="hr hr32 hr-dotted"></div>


                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->

            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="icon-cog bigger-150"></i>
                </div>

                <div class="ace-settings-box" id="ace-settings-box">
                    <div>
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="default" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div>

                    <div>
                        <input type="checkbox"  class="ace ace-checkbox-2" id="ace-settings-navbar"  />
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar"  />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                        <label class="lbl" for="ace-settings-add-container">
                            Inside
                            <b>.container</b>
                        </label>
                    </div>
                </div>
            </div><!-- /#ace-settings-container -->
        </div><!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->



    <!-- <![endif]-->

    <!--[if IE]>
   
    <![endif]-->

    <!--[if !IE]> -->

    <script type="text/javascript">
        window.jQuery || document.write("<script src='../res/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
    window.jQuery || document.write("<script src='../res/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->

    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='../res/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="../res/js/bootstrap.min.js"></script>
    <script src="../res/js/typeahead-bs2.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="../res/js/excanvas.min.js"></script>
    <![endif]-->

    <script src="../res/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="../res/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../res/js/jquery.slimscroll.min.js"></script>
    <script src="../res/js/jquery.easy-pie-chart.min.js"></script>
    <script src="../res/js/jquery.sparkline.min.js"></script>
    <script src="../res/js/flot/jquery.flot.min.js"></script>
    <script src="../res/js/flot/jquery.flot.pie.min.js"></script>
    <script src="../res/js/flot/jquery.flot.resize.min.js"></script>

    <script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <!-- ace scripts -->

    <script src="../res/js/jquery.dataTables.min.js"></script>
    <script src="../res/js/jquery.dataTables.bootstrap.js"></script>

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>
	<script src="<?php echo base_url().'js/Chart.bundle.js'; ?>"></script>	

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

    	var gameId2GameName = JSON.parse('<?php echo json_encode($gameId2GameName)?>');
        // var m_gameid = 97;
        // var m_gamename = "斗地主-普通场";
        var m_gameid = 0;
        var m_gamename = "全部";

        var beginindex = 1;
        var allcount = 0;

        var mytype = [
            "自摸", "花牌", "单钓将", "坎张", "边张", "明杠", "幺九刻", "老少副", "连六", "一般高",
            "断幺", "暗杠", "双暗刻", "四归一", "平胡", "门前清", "箭刻",
            "胡绝张", "双明杠", "不求人", "全带幺",
            "双箭刻", "双暗杠", "全求人", "混一色", "碰碰胡",
            "抢杠胡", "杠上开花", "海底捞月", "妙手回春",
            "三风刻", "大于五", "小于五",
            "三暗刻", "一色三步高", "清龙",
            "一色三节高", "一色三同顺", "清一色", "七对",
            "混幺九", "三杠", "一色四步高",
            "一色四节高", "一色四同顺",
            "一色双龙会", "四暗刻", "字一色", "小三元", "小四喜",
            "连七对", "四杠", "九莲宝灯", "大三元", "大四喜",
            "幺九头", "二五八将", "立直", "天听", "人胡", "地胡", "天胡", "八仙过海", "四方大发财"
        ];

        var gameitem = new Array();
        gameitem["0"] = "新手场";
        gameitem["1"] = "初级场";
        gameitem["2"] = "中级场";
        gameitem["3"] = "高级场";
        gameitem["4"] = "vip场";
        
         var typeitem = new Array();
        typeitem[0] = "火箭";
        typeitem[1] = "春天";
        typeitem[2] = "炸弹";
        typeitem[3] = "加倍";
        typeitem[4] = "明牌";
        typeitem[5] = "抢地主";


        var mystarttime_back = "";
        var myendtime_back = "";
        var userid1_back = "";
        var paijuhao_back = "";

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
            $("#userid1").val(userid1_back);
            $("#paijuhao1").val(paijuhao_back);
        }

        /**
        	获取游戏数据
        */
        function getGameData(gameid) {
			$('#tableData').show();
			$('#onlineData').hide();
            
            $("#targetbody").html("");
            mystarttime_back = $("#mystarttime").val();
            myendtime_back = $("#myendtime").val();
            userid1_back = $("#userid1").val();
            paijuhao_back = $("#paijuhao1").val();
            var packet = {
                action: 'get_online_data',
                mystarttime: $("#mystarttime").val(),
                myendtime: $("#myendtime").val(),
                userid: $("#userid1").val(),
                paijuhao: $("#paijuhao1").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: gameid,
            };
            function onsuccess(data) {
                  var gamexx = parseInt(gameid);
                 $(".pageitemnum").removeClass("hide");
                $(".pageitemleft").removeClass("disabled");
                $(".pageitemright").removeClass("disabled");
                var datax = eval("(" + data + ")");
                allcount = datax["count"][0]["count"];
 
                $(".pageitemnum").each(function(e) {
                    if (e * 20 < allcount) {
                        $(this).children("a").html(e + parseInt(beginindex / 10) * 10 + 1);
                    } else {
                        $(this).addClass("hide");
                    }
                })

                // 根据游戏类型，对收到的数据做处理
                if (gameid === 177)
                {
                    for (var itemx in datax["detail"])
                    {
                        var zz = "";
                        var ee = datax["detail"][itemx]["fan_ids"].split(";");
                        for (var itemy in ee) {
                            var ii = ee[itemy];
                            if (ii.length > 0)
                            {
                                zz = zz + mytype[ii] + "-";
                            }
                        }
                        datax["detail"][itemx]["fan_ids"] = zz.slice(0, zz.length - 1);
                        datax["detail"][itemx]["user_game_result"] = parseInt(datax["detail"][itemx]["user_score_end"]) - parseInt(datax["detail"][itemx]["user_score_begin"]) + parseInt(datax["detail"][itemx]["user_table_fee"]);
                        datax["detail"][itemx]["room_id"] = gameitem[ datax["detail"][itemx]["room_id"]];
                    }
                }
                else if ((gamexx === 97)||(gamexx === 98)||(gamexx === 100))
                {
                    for (var itemx in datax["detail"])
                    {
                        var zz = "";
                        var ee = datax["detail"][itemx]["time_pattern_counts"].split(";");
                        for (var itemy in ee) {
                            var ii = ee[itemy];
                            if (ii > 0)
                            {
                                zz = zz + typeitem[itemy] +"*"+ii+ "-";
                            }
                        }
                        
                        datax["detail"][itemx]["time_pattern_counts"] = zz;
                         datax["detail"][itemx]["user_game_result"] = parseInt(datax["detail"][itemx]["user_score_end"]) - parseInt(datax["detail"][itemx]["user_score_begin"]) + parseInt(datax["detail"][itemx]["user_table_fee"]);
                        datax["detail"][itemx]["room_id"] = gameitem[ datax["detail"][itemx]["room_id"]];
                    }
                }
                else if (gamexx === 0)
                {
                    for (var itemx in datax["detail"])
                    {
                        datax["detail"][itemx]["gameName"] = gameId2GameName[datax["detail"][itemx]["gameId"]];
                        datax["detail"][itemx]["user_game_result"] = parseInt(datax["detail"][itemx]["user_score_end"]) - parseInt(datax["detail"][itemx]["user_score_begin"]) + parseInt(datax["detail"][itemx]["user_table_fee"]);
                        datax["detail"][itemx]["room_id"] = gameitem[ datax["detail"][itemx]["room_id"]];
                    }
                }
                
                
                if ((gamexx === 145)||(gamexx === 146)||(gamexx === 49)||(gamexx === 17)||(gamexx === 18)||(gamexx === 20)||(gamexx === 1))
                {
                     for (var itemx in datax["detail"])
                    {
                        /*
                        var zz = "";
                        var ee = datax["detail"][itemx]["time_pattern_counts"].split(";");
                        for (var itemy in ee) {
                            var ii = ee[itemy];
                            if (ii > 0)
                            {
                                zz = zz + typeitem[itemy] +"*"+ii+ "-";
                            }
                        }
                        
                        datax["detail"][itemx]["time_pattern_counts"] = zz;
                         datax["detail"][itemx]["user_game_result"] = parseInt(datax["detail"][itemx]["user_score_end"]) - parseInt(datax["detail"][itemx]["user_score_begin"]) + parseInt(datax["detail"][itemx]["user_table_fee"]);
                        datax["detail"][itemx]["room_id"] = gameitem[ datax["detail"][itemx]["room_id"]];
                        
                        */

                        
                    }
                }


                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                
                if ((gamexx === 17) || (gamexx === 18) || (gamexx === 21) || (gamexx === 23) || (gamexx === 24))
                {
                     for (var itemx in datax["detail"])
                    {
                        datax["detail"][itemx]["room_id"] = gameitem[ datax["detail"][itemx]["room_id"]];
                    }
                     $("#targethead").html($("#headmodel1").html());
                     $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
                }
                
                if ((gamexx === 177) ||(gamexx === 178))
                {
                     $("#targethead").html($("#headmodel1").html());
                     $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
                }
                
                if ((gamexx === 52) || (gamexx === 54))
                {
                     $("#targethead").html($("#headmodel2").html());
                     $("#targetbody").html($("#datamodel2").tmpl(datax["detail"]));
                }
                
                if ((gamexx === 97)||(gamexx === 98)||(gamexx === 101))
                {
                     $("#targethead").html($("#headmodel2").html());
                     $("#targetbody").html($("#datamodel2").tmpl(datax["detail"]));
                }
                
                if ((gamexx === 145)||(gamexx === 146)||(gamexx === 49)||(gamexx === 17)||(gamexx === 18)||(gamexx === 20)||(gamexx === 1)||(gamexx === 5))
                {
                     $("#targethead").html($("#headmodel2x").html());
                     $("#targetbody").html($("#datamodel2x").tmpl(datax["detail"]));
                }

                // 如果是全部，则表头会不一样
                if (gamexx == 0)
                {
                     $("#targethead").html($("#allGameHeadModal").html());
                     $("#targetbody").html($("#allGameDataModal").tmpl(datax["detail"]));
                }
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/inforecord/get_gameuser_data", packet, onsuccess, onerrors);
        }

        function changegame(gameid, gamename) {
            m_gameid = gameid;
            m_gamename = gamename;
            beginindex = 1;
            $("#mycurrentgameid").html(gamename);
            // 切换游戏的时候不要查询，否则太慢
            // getGameData(gameid);
        }

        function reflesh() {
            beginindex = 1;
            getGameData(m_gameid);
        }

        /**
        	获取在线数据
        */
        function getOnlineData()
        {
			$('#tableData').hide();
			$('#onlineData').show();

            var packet = {
                mystarttime: $("#mystarttime").val(),
                myendtime: $("#myendtime").val(),
                userid: $("#userid1").val(),
                gameid: m_gameid,
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                if (datax['status'] == 1)
                {
                    alert(datax['msg']);
                    return;
                }

                var totalPlayTimes = datax['totalPlayTimes'];
                var winTimes = datax['winTimes'];
                var loseTimes = datax['loseTimes'];
                var drawTimes = datax['drawTimes'];
                $('#totalPlayTimes').html(totalPlayTimes);
                $('#winTimes').html(winTimes);
                $('#winRatio').html("(" + (winTimes / totalPlayTimes * 100).toFixed(2) + "%)");
                $('#loseTimes').html(loseTimes);
                $('#loseRatio').html("(" + (loseTimes / totalPlayTimes * 100).toFixed(2) + "%)");
                $('#drawTimes').html(drawTimes);
                $('#drawRatio').html("(" + (drawTimes / totalPlayTimes * 100).toFixed(2) + "%)");

				var labels = datax.timeArray;
				var playTimesArray = [];
				for (var i in labels)
				{
					var playTimes = datax.playTimes[labels[i]];
					if (playTimes == undefined)
					{
						playTimesArray.push(0);
					}
					else
					{
						playTimesArray.push(playTimes);
					}
				}

				// 绘制canvas
				var ctx = document.getElementById("myChart").getContext("2d");	
				var chartData = {
						labels : labels,
						datasets : [
									{
										label:'游戏次数',
										data : playTimesArray,
										pointStrokeColor : '#fff',
										fill : false,
										borderColor : 'green',
										spanGaps : true,
										lineTension : 0.1 
									},
									],
				};

				if (window.playTimesChart)
				{
					window.playTimesChart.destroy();
				}

				window.playTimesChart = new Chart(ctx,{
					type: 'line',
					data : chartData,
					options: {
						responsive: true,
						tooltips: {
							mode: 'index',
							intersect: false,
						},
						hover: {
							mode: 'nearest',
							intersect: true
						},
						scales: {
							
						}
					}
				});
            }

            function onerrors(data) {
            }
            jQuery.comm.sendmessage("<?php echo site_url()?>no3/inforecord/getOnlineData", packet, onsuccess, onerrors);
        }

        // 进来的时候不要查询，否则太慢
        // reflesh();
        jQuery(function($) {
            $(".pageitemnum").addClass("hide");
            $(".pageitemleft").addClass("disabled");
            $(".pageitemright").addClass("disabled");
            $(".pageitemnum").bind("click", function() {
                $(".pageitemnum").removeClass("active");
                $(this).addClass("active");
                beginindex = parseInt($(this).children("a").html());
                getGameData(m_gameid);
            });

            $(".pageitemleft").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) - 10;
                        if (tmp <= 0)
                            return;
                        $(this).children("a").html(tmp);
                    })

                }
            });

            $(".pageitemright").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) + 10;
                        if (tmp * 20 > allcount)
                            return;
                        $(this).children("a").html(tmp);
                    });
                }
            });

            $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function() {
                $(this).next().focus();
            });
        });

    </script>
</body>
</html>
