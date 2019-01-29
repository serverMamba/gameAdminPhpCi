<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

    <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center blue  header-color-green">项目</th>
            <th class="center blue  header-color-green"><a href="javascript:void"><i class="icon-double-angle-left choosedataleft"></i></a></th>
            {{each titles}}
            <th  id="mmid${tt}"  status="1"  onclick="javascript:dotimeclick_p('${tt}')" class="center blue header-color-green" style="cursor: pointer;">${tt}</th>
            {{/each}}

            <th class="center blue  header-color-green"> <a href="javascript:void"><i class="icon-double-angle-right choosedataright"></i></a></th>
        </tr>
    </script>


    <script id="datamodel1" type="text/html" >
        {{each rowtitles}}
        <tr class="${key}cls">
            <td class="center">${value}</td>
            <td class="center"><a href="javascript:void"><i class="icon-hospital"></i></a></td>
            {{each titles}}
            <td class="center" style="padding: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;">{{tmpl(0) getsumdata(tt,key)}}</td>
            {{/each}}
            <td class="center"> <a href="javascript:void"><i class="icon-beer"></i></a></td>
        </tr>

        {{/each}}

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

                <?php $this->load->view('no3/common/nav_left1', $systemconfig, $choose,$menucheck); ?>

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

                         <!--   <?php $this->load->view('no3/common/nav_top2', $header3); ?>   -->



                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-green2">
                                             <h5><i class="icon-arrow-left"></i>游戏选择：<label id="mycurrentgameid">All（全部游戏10000）</label>；渠道选择：<label id="mycurrentchannelid">All（全部渠道10000）</label></h5>

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
                                            
                                              <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">
                                                
                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    渠道选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                    <li>
                                                            <a href="javascript:changechannel('10000','All（全部渠道10000）')"><?php echo "All（全部渠道10000）" ?></a>
                                                     </li>

                                                    <?php foreach ($channellist as $channelid => $channelidname) { ?>
                                                        <li>
                                                            <a href="javascript:changechannel('<?php echo $channelid ?>','<?php echo $channelidname ?>')"><?php echo $channelidname ?></a>
                                                        </li>
                                                    <?php } ?>


                                                    <li class="divider"></li>


                                                </ul>
                                                
                                         </div> 

                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">开始时间</label>
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">结束时间</label>
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 



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
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">单层报表！</div>

                                                </div>




                                                <div class="modal-body no-padding">

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

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

        var m_gameid = 10000;
        var m_gamename = "All（全部游戏10000）";
        
        var m_channelid = 10000;
        var m_channelname = "All（全部渠道10000）";

        var mystarttime_back = "";
        var myendtime_back = "";

        var offset = 0;

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

        var headtitle = new Array();

        var rowtitle = [{"key": "hyrs", "value": "活跃人数"}, {"key": "ffrs", "value": "付费人数"}, {"key": "scffrs", "value": "首次付费用户"},
            {"key": "ffyhbl", "value": "付费用户比例"}, {"key": "ffje", "value": "付费金额"}, {"key": "arpu", "value": "DAU ARPU"},
            {"key": "srffyhbl", "value": "首日付费用户比例"}];

        var rowdata = new Array();

        function getsumdata(time, key) {
            
            if ((rowdata[key+time+m_gameid+m_channelid] !== undefined))
            {
                var datay = rowdata[key+time];
                var datax = eval("(" + datay + ")");
                   
                var allcountx = datax["合计"];
                return '<div rawdatay=' + allcountx + ' rawdatax=' + datay + ' style="cursor:pointer;margin-top:3px;" onclick=doclick("' + key + '","' + time + '") id="id' + key + time + '">' + allcountx + '</div>';
            }

            var packet = {
                action: 'get_online_data',
                time: time,
                key: key,
                gameid: m_gameid,
                channel:m_channelid
            };
            function onsuccess(data) {
                 rowdata[key+time] = data;
                var datax = eval("(" + data + ")");
                var allcountx = datax["合计"];
                $("#id" + key + time).attr("rawdatax", data);
                $("#id" + key + time).attr("rawdatay", allcountx);
                $("#id" + key + time).html(allcountx);
            }
            function onerrors(data) {
               $("#id" + key + time).html("error");
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reportmoney/get_reportmoney_data", packet, onsuccess, onerrors);
            return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
        }
        
 
        function changechannel(channelid, channelname) {
            offset = 0;
            m_channelid = channelid;
            m_channelname = channelname;
            $("#mycurrentchannelid").html(channelname);
            var lstarttime = $("#mystarttime").val();
            var lendtime = $("#myendtime").val();
            startdata(lstarttime, lendtime);
        }

        function changegame(gameid, gamename) {
            offset = 0;
            m_gameid = gameid;
            m_gamename = gamename;
            $("#mycurrentgameid").html(gamename);
            var lstarttime = $("#mystarttime").val();
            var lendtime = $("#myendtime").val();
            startdata(lstarttime, lendtime);
        }

        function reflesh() {
            offset = 0;
            var starttime = $("#mystarttime").val();
            var endtime = $("#myendtime").val();
            startdata(starttime, endtime);
        }

        function startdata(starttime, endtime) {
            mystarttime_back = starttime;
            myendtime_back = endtime;

            var startticket = gettimeticketfromstr(starttime);
            var endticket = gettimeticketfromstr(endtime);

            if (offset <= startticket)
                offset = startticket;
            if (offset >= (endticket - 24 * 60 * 60 * 6))
                offset = startticket;

            headtitle.length = 0;
            for (var start = offset; start <= endticket; start = start + 24 * 60 * 60)
            {
                var timestr = getdate1(start);
                headtitle.push({"tt": timestr});
                if (headtitle.length >= 7)
                    break;
            }

            $("#targethead").html($("#headmodel1").tmpl({"titles": headtitle}));
            $("#targetbody").html($("#datamodel1").tmpl({"titles": headtitle, "rowtitles": rowtitle}));

  
            $(".choosedataleft").bind("click", function() {
                offset = offset - 24 * 60 * 60;
                var lstarttime = $("#mystarttime").val();
                var lendtime = $("#myendtime").val();
                startdata(lstarttime, lendtime);
            });
            $(".choosedataright").bind("click", function() {
                offset = offset + 24 * 60 * 60;
                var lstarttime = $("#mystarttime").val();
                var lendtime = $("#myendtime").val();
                startdata(lstarttime, lendtime);
            });
        }

        jQuery(function($) {
            var lstarttime = getdate(-24 * 60 * 60 * 7);
            var lendtime = getdate(0);
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
                        offset = 0;
                        var starttime = getdate(0);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "昨日":
                        offset = 0;
                        var starttime = getdate(-24 * 60 * 60);
                        var endtime = getdate(-24 * 60 * 60);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本周":
                        offset = 0;
                        var starttime = getdate(-24 * 60 * 60 * 7);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本月":
                        offset = 0;
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
