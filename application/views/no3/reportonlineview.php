<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('no3/common/header'); ?>

<body>

	<script id="ontimemodel" type="text/html" >
	<tr>
		<td>${ip}</td>
		<td>${roomtype}</td>
		<td>${gametype}</td>
		<td>${status}</td>
		<td>${count}</td>
		<td>${opentime}</td>
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
                                        <div class="widget-header header-color-pink">
                                            <h5><i class="icon-arrow-left"></i>游戏实时在线,当前游戏：<label id="mycurrentgameid"><?php echo $initdatastr ?></label></h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>

                                            <div class="widget-toolbar no-border">
                                                <button class="btn btn-xs bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
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
                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main">
                                                <div id="sales-charts"></div>
                                                <div class="modal-body no-padding">
                                                    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                                                        <thead>
                                                            <tr>
                                                                <th>服务器</th>
                                                                <th>房间</th>
                                                                <th>游戏</th>

                                                                <th><i class="icon-time bigger-110"></i>状态</th>
                                                                <th>在线人数</th>
                                                                <th><i class="icon-time bigger-110"></i>开放时间</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id ="ontimeplace">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="widget-toolbox padding-8 clearfix">
                                                <button onclick="javascript:begin_ontime_reflesh()" class="btn btn-xs btn-danger pull-left">
                                                    <i class="icon-arrow-left"></i>
                                                    <span id="begintimer" class="bigger-110">开始定时刷新</span>
                                                </button>

                                                <button onclick="javascript:reflesh()" class="btn btn-xs btn-success pull-right">
                                                    <span class="bigger-110">刷新</span>

                                                    <i class="icon-arrow-right icon-on-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div><!-- row -->
                        </div><!-- /col-xs-12 -->

                        <div class="hr hr32 hr-dotted"></div>
                        <div class="row"></div>
                        <div class="hr hr32 hr-dotted"></div>
                    </div><!-- /row -->
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

<!-- ace scripts -->

<script src="../res/js/ace-elements.min.js"></script>
<script src="../res/js/ace.min.js"></script>
<script src="../res/js/jspacket.js"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">

    var m_gameid = <?php echo $initdata ?>;
    var m_gamename = '<?php echo $initdatastr; ?>';

    var d1 = [];
    var d2 = [];
    var d3 = [];
    var d4 = [];
    var d5 = [];
    var d6 = [];
    var d7 = [];
    var d8 = [];
    var d9 = [];
    var d10 = [];
    var d11 = [];
    var d12 = [];
    var d13 = [];
    var count = 0;

    var xss = [];
    var max = 12;
    var min = 1;
    var maxdata = 0;
    
   function myserverip(){
        var packet = {
            action: 'get_online_data',
            gameid: m_gameid,
            ip:$("#serverip").val()
        };
        
        function onsuccess(data) {
            var datax = eval("(" + data + ")");
            var modeldata = new Array();
            
            if(m_gameid =="20193") m_gameid ="193";
            if(m_gameid =="30193") m_gameid ="193";
            if(m_gameid =="40193") m_gameid ="193";
            var item = datax[m_gameid];
            var myDate = new Date();
            var tag = myDate.getHours() + ":" + myDate.getMinutes() + ":" + myDate.getSeconds();
            var gameitem = new Array();
            gameitem["no0"] = "新手场";
            gameitem["no1"] = "初级场";
            gameitem["no2"] = "中级场";
            gameitem["no3"] = "高级场";
            gameitem["no4"] = "vip场";
            gameitem["no100"] = "百人场";

            count++;
            xss.push([count, tag]);

            var sum =0;
            for (var itemx in item)
            {
                var subsum =0;
                for (var itemy in item[itemx])
                {
                   subsum = subsum + item[itemx][itemy];
                }
                
                if(maxdata <subsum)
                {
                    maxdata = subsum;
                }
                switch (itemx)
                {
                    case "no0":
                        d1.push([count,subsum]);
                        break;
                    case "no1":
                        d2.push([count,subsum]);
                        break;
                    case "no2":
                        d3.push([count,subsum]);
                        break;
                    case "no3":
                        d4.push([count,subsum]);
                        break;
                    case "no4":
                        d5.push([count,subsum]);
                        break;
                    case "no100":
                        d6.push([count,subsum]);
                        break;
                    default:
                        break;
                }
            }
        
            for (var itemx in item)
            {
                for (var itemy in item[itemx])
                {
                   sum = sum + item[itemx][itemy];
                   modeldata.push({"ip": itemy, "roomtype": gameitem[itemx], "gametype": m_gamename, "status": "开启", "count": item[itemx][itemy], "opentime": "24小时"});
                }
            }

            modeldata.push({"ip": "", "roomtype": "", "gametype": "", "status": "", "count": "合计："+sum, "opentime": ""});
            sum = 0;

            $("#ontimeplace").html($("#ontimemodel").tmpl(modeldata));

            if (xss.length > 11) {
                max++;
                min++;
            }

            var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
            $.plot("#sales-charts", [
                {label: "新手场", data: d1},
                {label: "初级场", data: d2},
                {label: "中级场", data: d3},
                {label: "高级场", data: d4},
                {label: "VIP场", data: d5},
                {label: "百人场", data: d6},
            ], {
                hoverable: true,
                shadowSize: 0,
                series: {
                    lines: {show: true},
                    points: {show: true}
                },
                xaxis: {ticks: xss, min: min, max: max},
                yaxis: {
                    ticks: 10,
                    min: -2,
                    max: maxdata+3,
                    tickDecimals: 0
                },
                grid: {
                    backgroundColor: {colors: ["#fff", "#fff"]},
                    borderWidth: 1,
                    borderColor: '#555'
                }
            });
        }
        function onerrors(data) {
            alert(objtostr(data))
        }
        jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reportonline/get_online_dataip", packet, onsuccess, onerrors); 
    }
    
    function get_online_data(gameid) {
        var packet = {
            action: 'get_online_data',
            gameid: gameid,
        };
        function onsuccess(data) {
        	if(m_gameid == 0){
                var total_sum = 0;
            	var datax = eval("(" + data + ")");
                var modeldata = new Array();
                var gameid_ary = new Array(18,20,49,52,54,97,98,101,193,289,322,23,24);
                var myDate = new Date();
                var tag = ("0" + myDate.getHours()).substr(-2) + ":" + ("0" + myDate.getMinutes()).substr(-2) + ":" + ("0" + myDate.getSeconds()).substr(-2);

                count++;
                xss.push([count, tag]);

                if (xss.length > 11) {
                    max++;
                    min++;
                }
                
                for(var iii in gameid_ary){
                	m_gameid = gameid_ary[iii];
                	var item = datax[m_gameid];
                	var sum =0;
         
					for (var itemx in item)
					{
						for (var itemy in item[itemx])
						{
						   sum = sum + item[itemx][itemy];
						   //modeldata.push({"ip": itemy, "roomtype": gameitem[itemx], "gametype": m_gamename, "status": "开启", "count": item[itemx][itemy], "opentime": "24小时"});
						}

						if(maxdata <sum)
						{
							maxdata = sum;
						}
					}
					
					if(m_gameid == 18){
						var game_name = '牛牛';
						d1.push([count,sum]);
					}else if(m_gameid == 20){
						var game_name = '抢庄牛牛';
						d2.push([count,sum]);
					}else if(m_gameid == 49){
						var game_name = '三张牌';
						d3.push([count,sum]);
					}else if(m_gameid == 97){
						var game_name = '斗地主普通';
						d4.push([count,sum]);
					}else if(m_gameid == 98){
						var game_name = '斗地主欢乐';
						d5.push([count,sum]);
					}else if(m_gameid == 101){
						var game_name = '斗地主癞子';
						d6.push([count,sum]);
					}else if(m_gameid == 193){
						var game_name = '捕鱼';
						d7.push([count,sum]);
					}else if(m_gameid == 289){
						var game_name = '电玩城';
						d8.push([count,sum]);
					}else if(m_gameid == 52){
						var game_name = '百人三张牌';
						d9.push([count,sum]);
					}/**else if(m_gameid == 322){
						var game_name = '连环炮';
						d10.push([count,sum]);
					}**/else if(m_gameid == 23){
						var game_name = '马来牛牛';
						d11.push([count,sum]);
					}else if(m_gameid == 24){
						var game_name = '三公';
						d12.push([count,sum]);
					}else if(m_gameid == 54){
						var game_name = '红黑大战';
						d13.push([count,sum]);
					}
					
					modeldata.push({"ip": itemy, "roomtype":"", "gametype": game_name, "status": "开启", "count": sum, "opentime": "24小时"});
					total_sum += sum;
					sum = 0;
				}
					
				modeldata.push({"ip": "", "roomtype": "", "gametype": "", "status": "", "count": "合计："+total_sum, "opentime": ""});
				$("#ontimeplace").html($("#ontimemodel").tmpl(modeldata));
				
				var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
				$.plot("#sales-charts", [
					{label: "牛牛", data: d1},
					{label: "抢庄牛牛", data: d2},
					{label: "马来牛牛", data: d11},
					{label: "三公", data: d12},
					{label: "三张牌", data: d3},
					{label: "斗地主普通", data: d4},
					{label: "斗地主欢乐", data: d5},
					{label: "斗地主癞子", data: d6},
					{label: "捕鱼", data: d7},
					//{label: "电玩城", data: d8},
					//{label: "百人三张牌", data: d9},
					//{label: "连环炮", data: d10},
					{label: "马来牛牛", data: d11},
					{label: "三公", data: d12},
					{label: "红黑大战", data: d13},
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: {show: true},
						points: {show: true}
					},
					xaxis: {ticks: xss, min: min, max: max},
					yaxis: {
						ticks: 10,
						min: -2,
						max: maxdata+3,
						tickDecimals: 0
					},
					grid: {
						backgroundColor: {colors: ["#fff", "#fff"]},
						borderWidth: 1,
						borderColor: '#555'
					}
				});
				m_gameid = 0;
            }else{
            	var datax = eval("(" + data + ")");
                var modeldata = new Array();
                
                if(m_gameid =="17") m_gameid ="18";
                if(m_gameid =="30193") m_gameid ="193";
                if(m_gameid =="40193") m_gameid ="193";
                var item = datax[m_gameid];

                var myDate = new Date();

                var tag = ("0" + myDate.getHours()).substr(-2) + ":" + ("0" + myDate.getMinutes()).substr(-2) + ":" + ("0" + myDate.getSeconds()).substr(-2);

                var gameitem = new Array();
                gameitem["no0"] = "新手场";
                gameitem["no1"] = "初级场";
                gameitem["no2"] = "中级场";
                gameitem["no3"] = "高级场";
                gameitem["no4"] = "vip场";
                gameitem["no100"] = "测试";

                count++;
                xss.push([count, tag]);

                var sum =0;
                for (var itemx in item)
                {
                    var subsum =0;
                    for (var itemy in item[itemx])
                    {
                       subsum = subsum + item[itemx][itemy];
                    }
                    
                    if(maxdata <subsum)
                    {
                        maxdata = subsum;
                    }
                    switch (itemx)
                    {
                        case "no0":
                            d1.push([count,subsum]);
                            break;
                        case "no1":
                            d2.push([count,subsum]);
                            break;
                        case "no2":
                            d3.push([count,subsum]);
                            break;
                        case "no3":
                            d4.push([count,subsum]);
                            break;
                        case "no4":
                            d5.push([count,subsum]);
                            break;
                        default:
                            break;
                    }
                }
            
                for (var itemx in item)
                {
                    for (var itemy in item[itemx])
                    {
                       sum = sum + item[itemx][itemy];
                       modeldata.push({"ip": itemy, "roomtype": gameitem[itemx], "gametype": m_gamename, "status": "开启", "count": item[itemx][itemy], "opentime": "24小时"});
                    }
                }

                modeldata.push({"ip": "", "roomtype": "", "gametype": "", "status": "", "count": "合计："+sum, "opentime": ""});
                sum = 0;

                $("#ontimeplace").html($("#ontimemodel").tmpl(modeldata));

                if (xss.length > 11) {
                    max++;
                    min++;
                }

                var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
                $.plot("#sales-charts", [
                    {label: "新手场", data: d1},
                    {label: "初级场", data: d2},
                    {label: "中级场", data: d3},
                    {label: "高级场", data: d4},
                    {label: "VIP场", data: d5}
                ], {
                    hoverable: true,
                    shadowSize: 0,
                    series: {
                        lines: {show: true},
                        points: {show: true}
                    },
                    xaxis: {ticks: xss, min: min, max: max},
                    yaxis: {
                        ticks: 10,
                        min: -2,
                        max: maxdata+3,
                        tickDecimals: 0
                    },
                    grid: {
                        backgroundColor: {colors: ["#fff", "#fff"]},
                        borderWidth: 1,
                        borderColor: '#555'
                    }
                });
            }           
        }
        function onerrors(data) {
            alert(objtostr(data))
        }
        jQuery.comm.sendmessage("<?php echo site_url('no3/reportonline/get_online_data');?>", packet, onsuccess, onerrors);
    }

    function changegame(gameid, gamename) {
        count = 0;
        d1.length = 0;
        d2.length = 0;
        d3.length = 0;
        d4.length = 0;
        d5.length = 0;
        d6.length = 0;
        d7.length = 0;
        d8.length = 0;
        d9.length = 0;
        d10.length = 0;
        d11.length = 0;
        d12.length = 0;
        d13.length = 0;
        xss.length = 0;
        m_gameid = gameid;
        m_gamename = gamename;
        $("#mycurrentgameid").html(gamename);
        get_online_data(gameid);
    }

    var ontimeflag = 0;

    function on_time() {
        window.setTimeout(function() {
            if (ontimeflag === 1)
            {
                get_online_data(m_gameid);
            }
            on_time();
        }, 10000);
        return;
    }

    on_time();
    get_online_data(m_gameid);

    function begin_ontime_reflesh() {
        if (ontimeflag === 1)
        {
            $("#begintimer").html("开始定时刷新");
            ontimeflag = 0;
        } else {
            get_online_data(m_gameid);
            $("#begintimer").html("停止定时刷新");
            ontimeflag = 1;
        }
    }

    function reflesh() {
        get_online_data(m_gameid);
    }

    jQuery(function($) {

    })
</script>
</body>
</html>
