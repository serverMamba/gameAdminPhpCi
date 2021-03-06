<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

        <script id="ontimemodel" type="text/html" >
        <tr>
            <td>${key}</td>
            <td>${value}</td>
              <td>${value}</td>
        </tr>
    </script>
    <?php $this->load->view('no3/common/message', $message); ?>

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

                <?php $this->load->view('no3/common/nav_left1', $systemconfig, $choose, $menucheck); ?>

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
                <?php $this->load->view('no3/common/nav_top', $header1); ?>

                <div class="page-content">
                    <?php $this->load->view('no3/common/nav_top1', $header2); ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->

                            <!--    <?php $this->load->view('no3/common/nav_top2', $header3); ?>  -->

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-pink">
                                            <h5><i class="icon-arrow-left"></i>输赢机器人统计</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>


                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">

                                             <button onclick="javascript:getsumdata()" class="btn btn-xs btn-success " style="margin-top:3px;" disabled="true">
                                                <span class="bigger-110">兑换卷分布</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>

                                            <button onclick="javascript:getsumdata()" class="btn btn-xs btn-success " style="margin-top:3px;" disabled="true">
                                                <span class="bigger-110">筹码分布</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>

                              

                                            <button onclick="javascript:getsumdata()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">输赢机器人分布</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>

                                        </div>











                                        <div class="widget-body">

                                            <div class="widget-main">
                                                <!--    <div id="sales-charts" style="height:500px;width:30%">
    
                                                    </div>  -->


                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat">
                                                                <h4 class="smaller">
                                                                    <i class="icon-desktop smaller-80"></i>
                                                                    输赢机器人统计
                                                                </h4>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">


                                                                    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" style="height:450px;width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>范围</th>
                                                                                <th>赢人数</th>
                                                                                <th>输人数</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody id ="ontimeplace">

                                                                        </tbody>
                                                                    </table> 








                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-9">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat">
                                                                <h4 class="smaller">
                                                                    <i class="icon-desktop smaller-80"></i>
                                                                    每日净分统计
                                                                </h4>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <div id="sales-charts" style="height:450px;width:100%">

                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                              <!--     <div class="col-sm-5">
                                                        <div class="widget-box">
                                                            <div class="widget-header widget-header-flat">
                                                                <h4 class="smaller">
                                                                    <i class="icon-desktop smaller-80"></i>
                                                                    每日收入统计
                                                                </h4>
                                                            </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <div id="sales-charts1" style="height:450px;width:100%">

                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  -->
                                                </div><!-- PAGE CONTENT ENDS -->









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
    <script src="../res/js/flot/jquery.flot.categories.min.js"></script>
    <script src="../res/js/flot/jquery.flot.stack.js"></script>




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
        
 
        var items = new Array();
        items[0] = '德州扑克';
        items[1] = '牛牛';
        items[2] = '百家乐';
        items[3] = '三张牌';
        items[4] = '水果机';
        items[5] = '大转轮';
        items[6] = '斗地主';
        items[7] = '梭哈';
        items[8] = '掼蛋';
        items[9] = '21点';
        items[10] = '抢庄牛牛';
        items[11] = '十三张';
        items[12] = "扑鱼OL";
        items[13] = "扑鱼在线";
        items[14] = "二人麻将";
        items[15] = "kLKPY(15)";


        var itemsy = new Array();

        itemsy[01] = '德州扑克';
        itemsy[02] = '扎金花';
        itemsy[03] = '掼蛋';
        itemsy[04] = '牛牛';
        itemsy[05] = '捕鱼';
        itemsy[06] = '黄金扎金花';
        itemsy[07] = '德州扑克2';
        itemsy[08] = '百家乐';
        itemsy[09] = '水果机';
        itemsy[10] = '大转盘';
        itemsy[11] = '斗地主';
        itemsy[12] = '港式五张';
        itemsy[13] = '新赢三张';
        itemsy[14] = '21点';
        itemsy[15] = '赢话费扎金花';
        itemsy[16] = '域起天天扎金花';
        itemsy[17] = '域起快乐扎金花';
        itemsy[18] = '欢乐赢三张';
        itemsy[19] = '飘三叶';
        itemsy[20] = '域起斗地主';
        itemsy[21] = '欢乐斗地主';
        itemsy[22] = '欢乐飘三叶';
        itemsy[23] = '11移动mm德州扑克';
        itemsy[24] = '11移动mm斗地主';
        itemsy[25] = '11联通斗地主';
        itemsy[26] = 'web欢乐赢三张';
        itemsy[27] = 'IOS快乐牛牛';
        itemsy[28] = 'IOS欢乐牛牛';
        itemsy[29] = '二人麻将';
        itemsy[30] = '游果牛牛';


        function   draw(target, data,data1) {
            $.plot(target, [data,data1], {
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.6,
                        align: "center"
                    }
                },
                xaxis: {
                    mode: "categories",
                    tickLength: 0
                }
            });
        }


        function getsumdata() {
            var packet = {
                action: 'get_online_data',
                id: 1,
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var cs = datax["ret"];
                var csitems = new Array();
                var csitems1 = new Array();
                 var csitems2 = new Array();
                for (var key in cs)
                {
                    csitems.push({"key": items[key], "value": cs[key]});
                    csitems1.push([items[key], cs[key]]);
                    csitems2.push([items[key], cs[key]*0.5]);
                }

                var other = datax["other"];

                for (var key in other)
                {
                    csitems.push({"key": key, "value": other[key]});
                    csitems1.push([key, other[key]]);
                    csitems2.push([key, other[key]*0.5]);
                }

                $("#ontimeplace").html($("#ontimemodel").tmpl(csitems));

                draw("#sales-charts", csitems1,csitems2);

            }
            function onerrors(data) {

            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reportsyjqr/analys", packet, onsuccess, onerrors);

        }



        getsumdata();

        jQuery(function($) {
            $('.date-picker').datepicker({autoclose: true}).next().on(ace.click_event, function() {
                $(this).prev().focus();
            });
        });
        
      
    </script>
</body>
</html>
