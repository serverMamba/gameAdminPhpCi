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
                                            <h5>当前抽水: <span id="choushuiNum" style="font-weight:bold"></span></h5>
                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main">
                                                <div id="sales-charts"></div>
                                            </div>

                                            <div class="widget-toolbox padding-8 clearfix">
                                                <button onclick="javascript:begin_ontime_reflesh()" class="btn btn-xs btn-danger pull-left">
                                                    <i class="icon-arrow-left"></i>
                                                    <span id="begintimer" class="bigger-110">开始定时刷新</span>
                                                </button>

                                                <button onclick="javascript:refresh()" class="btn btn-xs btn-success pull-right">
                                                    <span class="bigger-110">刷新</span>

                                                    <i class="icon-arrow-right icon-on-right"></i>
                                                </button>
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

	var xss = [];
	var chartData = [];
	var count = 0;
	var xmax = 12;
	var xmin = 1;
	var ymax = 0;
	var ymin = 999999999;
    function get_data() {

        var packet = {
			action:'get_online_data',
			time:getFormatedDate(new Date() + 3600000),
			key:'total_lhp',
			channel:10000,
        };
        function onsuccess(data) {
			var datax = eval("(" + data + ")");
			var moneyString = datax['合计'];
			if (moneyString == null)
			{
				moneyString = "0元";
			}
			moneyString = moneyString.substr(0, moneyString.length - 1);

			var money = parseFloat(moneyString);
			if (money < 0)
			{
				$('#choushuiNum').css('color', 'red');
			}
			else
			{
				$('#choushuiNum').css('color', 'black');
			}
			$('#choushuiNum').html(money + "元");

			if (money > ymax)
			{
					ymax = money;
			}

			if (money < ymin)
			{
					ymin = money;
			}
			
			var myDate = new Date();
			var tag = myDate.getHours() + ":" + myDate.getMinutes() + ":" + myDate.getSeconds();

			count++;
			xss.push([count, tag]);
			chartData.push([count, money]);
			if (xss.length > 11) {
				xmax++;
				xmin++;
			}

			var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
			$.plot("#sales-charts", [
				{label: "抽水", data: chartData},
			], {
				hoverable: true,
				shadowSize: 0,
				series: {
					lines: {show: true},
					points: {show: true}
				},
				xaxis: {ticks: xss, min: xmin, max: xmax},
				yaxis: {
					ticks: 10,
					min: ymin - 1000,
					max: ymax + 1000,
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
        jQuery.comm.sendmessage("<?php echo site_url('no3/reporttotal/get_reporttotal_data')?>", packet, onsuccess, onerrors);
    }

    // 用于时间控制
    var ontimeflag = 0;
    function on_time() {
        window.setTimeout(function() {
            if (ontimeflag === 1)
            {
        		get_data();
            }
            on_time();
        }, 180000);
        return;
    }

    // 开启计时
    on_time();
    // 获取数据
    get_data();

    function begin_ontime_reflesh() {
        if (ontimeflag === 1)
        {
            $("#begintimer").html("开始定时刷新");
            ontimeflag = 0;
        } else {
        	get_data();
            $("#begintimer").html("停止定时刷新(三分钟刷新一次)");
            ontimeflag = 1;
        }
    }

    function refresh() {
    	get_data();
    }
</script>
</body>
</html>
