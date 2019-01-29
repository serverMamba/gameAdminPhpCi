<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

<body>
    <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center blue  header-color-green" width="100">项目</th>
            {{each titles}}
            <th    status="1"  class="center blue header-color-green" width="100">${tt}</th>
            {{/each}}
        </tr>
    </script>
    
    <script id="headdata1" type="text/html" >
        {{each  rowdataxxx}}
        <tr id="myid${id}">
            <th >${name}</th>
            {{each titles}}
            <th status="1" id="myid${id}${tt}" class="center" ></th>
            {{/each}}
        </tr>
        {{/each}}
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
                                            <h5><i class="icon-arrow-left"></i>连环炮运营总表</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-toolbox padding-8 clearfix">
                                            <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">
                                            </div>
                                            
                                            <label class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">开始时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="mystarttime" type="text"  value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                             
                                            <label class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">结束时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="myendtime" type="text"  value="<?php echo date('Y-m-d', time()) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>

                                            <ul class="pagination pull-left no-margin " style="padding-left:10px;">
                                                <li class="timemenu">
                                                    <a href="javascript:void">今日</a>
                                                </li>
                                                <li class="timemenu">
                                                    <a href="javascript:void">昨日</a>
                                                </li>
                                                <li class="timemenu active">
                                                    <a href="javascript:void">本周</a>
                                                </li>
                                                <li class="timemenu">
                                                    <a href="javascript:void">本月</a>
                                                </li>
                                            </ul>

                                            <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:3px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>
                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">查询</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main"  style ="padding:0;">
                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
                                                    <thead id="targethead">

                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /row -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <script type="text/javascript">
        window.jQuery || document.write("<script src='../res/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>

    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='../res/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="../res/js/bootstrap.min.js"></script>
    <script src="../res/js/typeahead-bs2.min.js"></script>

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

    <!-- inline scripts related to this page -->

    <script type="text/javascript">
        var mystarttime_back = "";
        var myendtime_back = "";

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

		// 所有的数据
		var headtitlename = [
		{"id":1, "name": "今日游戏人数","child":[]}, 	
		{"id":2, "name": "昨日游戏用户今日再次游戏人数","child":[]}, 	
		{"id":3, "name": "总游戏局数","child":[]}, 	
		{"id":4, "name": "在线峰值","child":[]}, 	
		{"id":5, "name": "平均单人游戏局数","child":[]}, 	
		{"id":6, "name": "比倍次数","child":[]}, 	
		{"id":7, "name": "总上分金币数","child":[]}, 
		{"id":8, "name": "总下分金币数","child":[]}, 	
		{"id":9, "name": "总抽水","child":[]}, 	
			
		{"id":21,"name": "次数[1P(一对,10以上)]","child":[]},
		{"id":22,"name": "次数[2P(两对)]","child":[]},
		{"id":23,"name": "次数[3K(三张相同)]","child":[]}, 
		{"id":24,"name": "次数[ST(顺子)]","child":[]},
		{"id":25,"name": "次数[FL(清一色)]","child":[]}, 
		{"id":26,"name": "次数[FH(葫芦,3带2)]","child":[]},	
		{"id":27,"name": "次数[4K(四张相同)]","child":[]},
		{"id":28,"name": "次数[SF(同花顺)]","child":[]},
		{"id":29,"name": "次数[RS(皇家同花顺)]","child":[]},
		{"id":30,"name": "次数[5K(五张相同)]","child":[]}];

		var headtitlenamex = [];
		for(var x in headtitlename){
			headtitlenamex[x+""] = headtitlename["name"];
		}

		// 这里存标题，其实就是日期
        var headtitle = new Array();

        // 查询
        function reflesh() {
            var starttime = $("#mystarttime").val();
            var endtime = $("#myendtime").val();
            startdata(starttime, endtime);
		}

        // 抓取数据
		function startdata(starttime, endtime) 
		{
            mystarttime_back = starttime;
            myendtime_back = endtime;

            var startticket = gettimeticketfromstr(starttime);
            var endticket = gettimeticketfromstr(endtime);

            headtitle.length = 0;
            for (var start = endticket; start <= endticket; start = start - 24 * 60 * 60)
            {
                var timestr = getFormatedDate(start * 1000);
                headtitle.push({"tt": timestr});
                if (headtitle.length >= 7)
                    break;
            }

            $("#targethead").html($("#headmodel1").tmpl({"titles": headtitle}));
           
           	var packet = {
                starttime : starttime,
                endtime : endtime,
            };

            function onsuccess(data) {
                // 先创建表，并针对每个格子设置其id
                $("#targetbody").html($("#headdata1").tmpl({"titles": headtitle, "rowdataxxx": headtitlename}));
                var datay = eval("(" + data + ")");
                var leng = datay.length;

                // 通过找到相应的数据的id并设置其内容
                for(var i = 0; i < leng; i++){
                	var datexx = datay[i]["statistics_date"];
                    var name = datay[i]["name"];
                    var value = datay[i]["value"];
                    $("#myid" + name + datexx).html( value);
                }
            }
            function onerrors(data) {
               // $("#myid" + name + time).html("error");
            }
            
            jQuery.comm.sendmessage("<?php echo site_url('no3/lhpoperation/get_reportgame_data');?>", packet, onsuccess, onerrors);
        }

        jQuery(function($) {
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body");
            
            $('.date-picker').datepicker({autoclose: true}).next().on(ace.click_event, function() {
                $(this).prev().focus();
            });
            
            var lstarttime = getdate(-24 * 60 * 60 * 8);
            var lendtime = getdate(0 * 60 * 60 * 1);
            $("#mystarttime").val(lstarttime);
            $("#myendtime").val(lendtime);
            startdata(lstarttime, lendtime);

            $(".timemenu").bind("click", function() {
                $(".timemenu").removeClass("active");
                $(this).addClass("active");
                var timxx = $(this).children("a").html();
                switch (timxx)
                {
                    case "今日":
                        var starttime = getdate(0);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "昨日":
                        var starttime = getdate(-24 * 60 * 60);
                        var endtime = getdate(-24 * 60 * 60);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本周":
                        var starttime = getdate(-24 * 60 * 60 * 7);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本月":
                        var starttime = getdate(-24 * 60 * 60 * 30);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                }
            });

            $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function() {
                $(this).next().focus();
            });
        });
    </script>
</body>
</html>
