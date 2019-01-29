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


                <div class="page-content">
             

                    <div class="row">
                        <div class="col-xs-12">
          



                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                       
                                     <div class="widget-header header-color-green2">
                                             <h5>印度扑克渠道数据统计</label></h5>

                                            <div class="widget-toolbar">
                                              <!--  <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>  -->
                                            </div>

            
                                        </div>



                                        <div class="widget-toolbox padding-8 clearfix">
                                            
   

                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">开始时间</label>
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">结束时间</label>
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 

                                  

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

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info"></div>

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

        var m_gameid = 16;
        var m_gamename = "TeenPatti（印度扑克）";
        
        var m_channelid = 36;
        var m_channelname = "All（全部渠道10000）";

        var mystarttime_back = "";
        var myendtime_back = "";

        var offset = 0;

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

        var headtitle = new Array();

        var rowtitle = [{"key": "total1", "value": "新增设备数"}, {"key": "total2", "value": "新增注册数"}, {"key": "total3", "value": "新增真实注册数"},
            {"key": "total4", "value": "真实注册且游戏人数"}, {"key": "total5", "value": "新增游客数"}, {"key": "total6", "value": "首次游戏人数"}, {"key": "total22", "value": "次日存留"}, 
            {"key": "total23", "value": "7日存留"},
            {"key": "total7", "value": "平均在线"},{"key": "total8", "value": "高峰在线"},{"key": "total9", "value": "总用户数"},{"key": "total10", "value": "当日活跃用户"}
       ,{"key": "total12", "value": "活跃设备数"}
   ,{"key": "total16", "value": "充值人数"},{"key": "total17", "value": "充值总额"},
   //{"key": "total18", "value": "首次充值人数"}
   // ,{"key": "total19", "value": "活跃充值人数"},
    //{"key": "total20", "value": "七日活跃人数"},{"key": "total21", "value": "七日活跃设备数"}
    ];

        var coltitle_p = [{"no": "新手场"}, {"no": "初级场"}, {"no": "中级场"}, {"no": "高级场"}, {"no": "vip场"}];

        var rowdata = new Array();

        function getsumdata(time, key) {
            
            if (rowdata[key+time+m_gameid+m_channelid ] !== undefined)
            {
                var datay = rowdata[key+time+m_gameid+m_channelid ];
                var datax = eval("(" + datay + ")");
                var allcountx = datax["合计"];
                return '<div rawdatay=' + allcountx + ' rawdatax=' + datay + ' style="cursor:pointer;margin-top:3px;" onclick=doclick("' + key + '","' + time + '") id="id' + key + time + '">' + allcountx + '</div>';
            }
            
            var packet = {
                action: 'get_online_data',
                time: time,
                key: key,
                gameid: m_gameid,
                channel:m_channelid,
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var allcountx = datax["合计"];
                $("#id" + key + time).attr("rawdatax", data);
                $("#id" + key + time).attr("rawdatay", allcountx);
                $("#id" + key + time).html(allcountx);
            }
            function onerrors(data) {
               $("#id" + key + time).html("error");
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/ydpk/get_reporttotal_data", packet, onsuccess, onerrors);
            return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
        }
        


        function dotimeclick_p(time) {
          //  $("#targethead").html($("#headmodel_p").tmpl({"time": time, "titles_p": coltitle_p}));
           // $("#targetbody").html($("#datamodel_p").tmpl({"time": time, "titles_p": coltitle_p, "rowtitles_p": rowtitle_p}));
        }

        function dotimeclick(time) {
            if ($("#mmid" + time).attr("status") === "1")
            {
                $("#mmid" + time).attr("status", "2");
                for (var itemz in rowtitle) {
                    var key = rowtitle[itemz]["key"];
                    var data = $("#id" + key + time).attr("rawdatax");
                    if (data.length > 10)
                    {
                        var allcountx = $("#id" + key + time).attr("rawdatay");
                        var datax = eval("(" + data + ")");
                        var itemx = new Array();
                        for (var itemy in datax) {
                            itemx.push({key: itemy, value: datax[itemy]});
                        }
                        $("#id" + key + time).html($("#innertable1").tmpl({"titles": itemx}));
                    }
                }
            } else {
                $("#mmid" + time).attr("status", "1");
                for (var itemz in rowtitle) {
                    var key = rowtitle[itemz]["key"];
                    var data = $("#id" + key + time).attr("rawdatax");
                    if (data.length > 10)
                    {
                        var allcountx = $("#id" + key + time).attr("rawdatay");
                        $("#id" + key + time).html(allcountx);
                    }
                }
            }
        }

        function doclick(key, time) {

        }
   /*     
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
        */

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



        });

    </script>
</body>
    </html>
