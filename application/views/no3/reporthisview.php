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
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-pink">
                                            <h5><i class="icon-arrow-left"></i>游戏历史曲线,当前游戏：<label id="mycurrentgameid">ALL（全部0）</label></h5>

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


                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">指定时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="id-date-picker-1" type="text"  value="<?php echo date('Y-m-d', time()) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>




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

                                            <div class="widget-main">
                                                <div id="sales-charts">

                                                </div>

                                            </div>

                                            <div class="widget-toolbox padding-8 clearfix">
                                                <button onclick="javascript:reflesh()" class="btn btn-xs btn-success pull-right">
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




    <script src="../res/js/chosen.jquery.min.js"></script>
    <script src="../res/js/fuelux/fuelux.spinner.min.js"></script>
    <script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/bootstrap-colorpicker.min.js"></script>
    <script src="../res/js/jquery.knob.min.js"></script>
    <script src="../res/js/jquery.autosize.min.js"></script>
    <script src="../res/js/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="../res/js/jquery.maskedinput.min.js"></script>
    <script src="../res/js/bootstrap-tag.min.js"></script>



    <!-- ace scripts -->

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

        var m_gameid = 0;
        var m_gamename = "ALL（全部0）";

        var d1 = [];
        var d2 = [];
        var d3 = [];
        var d4 = [];
        var count = 24 * 4;

        var xss = [];

        var min = 0;
        var max = 25 * 4;
        var maxdata = 0;

        var a2b = new Array();
        var b2a = new Array();

        var myDate = new Date();
        
    
        for (var xx = 0; xx < max; xx++) {
            var a = parseInt(xx / 4);
            var b = xx % 4 * 15;

            if (a < 10)
                a = "0" + a;
            if (b < 10)
                b = "0" + b;

            var tag = a + ":" + b;

            a2b[xx] = tag;
            b2a[tag] = xx;

            if (xx % 4 == 0)
            {
                xss.push([xx, tag]);
            } else {
                xss.push([xx, "."]);
            }
        }
 
          function getnumber(str){
           var strlist = str.split(":");
            var num = parseInt(strlist[0])*4;
                num = num + parseInt(parseInt(strlist[1])  /15);
           return num;
          }

 
        function get_online_data() {
            var packet = {
                action: 'get_online_data',
                gameid: m_gameid,
                mytime: $("#id-date-picker-1").val()
            };
            function onsuccess(data) {
                d1.length = 0;
                d2.length = 0;
                d3.length = 0;
                d4.length = 0;
                maxdata = 0;

                var datax = eval("(" + data + ")");

                var itemtoday = datax["today"];
                var itemyest =  datax["yest"];
                var itemaweek = datax["aweek"];
                var itemamon =  datax["amon"];
                
                 for (var itemx in itemtoday)
                {
                    var tm = itemtoday[itemx]["tm"];
                    var xx = getnumber(tm);
                    var ct = parseInt(itemtoday[itemx]["ct"]);
                 
                    if (maxdata < ct)
                    {
                        maxdata = ct;
                    }
  
                    d3.push([xx, ct]);
                }

                for (var itemx in itemyest)
                {
                    var tm = itemyest[itemx]["tm"];
                    var xx = getnumber(tm);
                    var ct = parseInt(itemyest[itemx]["ct"]);
                    if (maxdata < ct)
                    {
                        maxdata = ct;
                    }
                    d1.push([xx, ct]);
                }

                for (var itemx in itemaweek)
                {
                    var tm = itemaweek[itemx]["tm"];
                    var xx = getnumber(tm);
                    var ct = parseInt(itemaweek[itemx]["ct"]);
                    if (maxdata < ct)
                    {
                        maxdata = ct;
                    }
                    d2.push([xx, ct]);
                }
                
                 for (var itemx in itemamon)
                {
                    var tm = itemamon[itemx]["tm"];
                    var xx = getnumber(tm);
                    var ct = parseInt(itemamon[itemx]["ct"]);
                    if (maxdata < ct)
                    {
                        maxdata = ct;
                    }
                    d4.push([xx, ct]);
                }

                $('#sales-charts').html("");

                var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '420px'});
                $.plot("#sales-charts", [
                    {label: "上月的今天", data: d4},
                    {label: "上周的今天", data: d2},
                    {label: "昨天", data: d1},
                    {label: "今天", data: d3}

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
                        max: maxdata * 1.1,
                        tickDecimals: 0
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        backgroundColor: {colors: ["#fff", "#fff"]},
                        borderWidth: 1,
                        borderColor: '#555'
                    }
                });

                $("#sales-charts").bind("plothover", function(event, pos, item) {
                    if (item) {
                        var x = item.datapoint[0],
                            y = item.datapoint[1];

                        $("#tooltip").html(item.series.label + "[" + a2b[x] + "] = " + y)
                                .css({top: item.pageY + 5, left: item.pageX + 5})
                                .fadeIn(200);
                    }
                });

                $("#sales-charts").bind("plotclick", function(event, pos, item) {


                });

            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reporthis/get_his_data", packet, onsuccess, onerrors);
        }

        function changegame(gameid, gamename) {
            count = 0;
            d1.length = 0;
            d2.length = 0;
            d3.length = 0;
            d4.length = 0;
   
            m_gameid = gameid;
            m_gamename = gamename;
            $("#mycurrentgameid").html(gamename);
            get_online_data();
        }

        get_online_data();

        function reflesh() {
            get_online_data();
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
        })
    </script>
</body>
</html>
