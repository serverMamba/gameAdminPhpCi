<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    

    <body>

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
                                             <h5><i class="icon-arrow-left"></i>游戏选择：<label id="mycurrentgameid">All(全部游戏0)</label>；房间选择：<label id="mycurrentchannelid">All（全部房间:10000）</label></h5>

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
                                                    房间选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="javascript:changechannel('10000','All（全部房间:10000）');"> All（全部房间:10000)</a>
                                                        </li>
                                                        <li>
                                                           <a href="javascript:changechannel('-1','未知房间（-1）');">未知房间（-1）</a>
                                                        </li>
                                                        <li>
                                                           <a href="javascript:changechannel('0','0号房间');">0号房间（0）</a>
                                                        </li>
                                                          <li>
                                                           <a href="javascript:changechannel('1','1号房间');">1号房间（1）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('2','2号房间');">2号房间（2）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('3','3号房间');">3号房间（3）</a>
                                                        </li>
                                                        
                                                         <li>
                                                           <a href="javascript:changechannel('4','4号房间');">4号房间（4）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('5','5号房间');">5号房间（5）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('6','6号房间');">6号房间（6）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('7','7号房间');">7号房间（7）</a>
                                                        </li>
                                                        
                                                         <li>
                                                           <a href="javascript:changechannel('8','8号房间');">8号房间（8）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('9','9号房间');">9号房间（9）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('10','10号房间');">10号房间（10）</a>
                                                        </li>
                                                        
                                                        <li>
                                                           <a href="javascript:changechannel('11','11号房间');">11号房间（11）</a>
                                                        </li>
                                                        
                                                         <li>
                                                           <a href="javascript:changechannel('12','12号房间');">12号房间（12）</a>
                                                        </li>

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

                                            <button onclick="javascript:get_data();" class="btn btn-xs btn-success " style="margin-top:3px;">
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
    <script src="../res/jsrender/jsrender.min.js"></script>
    
    <!-- inline scripts related to this page -->

    <script type="text/javascript">

    var m_gameid = 0;
    var m_gamename = "All(全部游戏0)";

    var m_roomid = 10000;
    var m_roomname = "All（全部渠道10000）";

    var mystarttime_back = "";
    var myendtime_back = "";

    var offset = 0;
    
    var arr = {};
    
        
    function get_tablehead(itemhead){
        var tablehead_tmpl = $.templates( "<th class='widget-header header-color-green' style='height:35px;background-color:green;'><i class='ace-icon fa fa-cog'></i>{{:title}}</th>" );
        return tablehead_tmpl.render(itemhead);
    }

    function get_tablebody(itemhead,itembody){
       var tablehead_tmpl = $.templates( "<td>{{:ids}}</td>" );
       
       //alert(tablehead_tmpl.render(itemhead));
       var tablebody_tmpl =$.templates(  "<tr>" +tablehead_tmpl.render(itemhead)+"</tr>");
       return tablebody_tmpl.render(itembody);
    }
        
    function changechannel(channelid, channelname) {
        offset = 0;
        m_roomid = channelid;
        m_roomname = channelname;
        $("#mycurrentchannelid").html(channelname);
    }
    
    function changegame(gameid, gamename) {
        offset = 0;
        m_gameid = gameid;
        m_gamename = gamename;
        $("#mycurrentgameid").html(gamename);
    }
        
        
    function get_data() {
         $("#targetbody").html("");
         $("#targethead").html("");
        var lstarttime = $("#mystarttime").val();
        var lendtime = $("#myendtime").val();
        var packet = {
                action: 'get_online_data',
                starttime: lstarttime,
                endtime: lendtime,
                gameid: m_gameid,
                roomid:m_roomid,
            };
        function onsuccess(data) {
                var datax = eval("(" + data + ")");
               
                var item1 = [];
                var item2 = [];
                
                for(var index in datax)
                {
                    var rangeid = datax[index]["rangeid"];
                    item1[rangeid]=[];
                    var mydate = datax[index]["date"];
                    item2[mydate] = [];
                 } 
                 
                  var row = [];
                  row.push({"ids":"{{:id0}}"}); 
                  
                  for(var date in item2){
                     var datex = date.replace("-","").replace("-","");
                    row.push({"ids":"{{:id"+datex+"}}"});   
                }
                 
                var title =[];
                title.push({"title":"日净分：范围/人数"});  
                for(var date in item2){
                    title.push({"title":date});   
                }
                $("#targethead").html(get_tablehead(title));
                
                 var row1 = [];
                 for(var index in datax)
                {
                
                   var rangeid = datax[index]["rangeid"];
                   var count   = datax[index]["count"];
                   var id = "id"+rangeid;
                   
                   var rangestr =  datax[index]["minscore"]+" 至 "+datax[index]["maxscore"];
                   
                   row1[rangeid] =rangestr;
                   
                   var date = datax[index]["date"];
                   var item= {};
                    var datex = date.replace("-","").replace("-","");
                   item["id" +datex ] = count ;
                   item1[rangeid].push(item);
                } 
                
                  var itemx = [];
                  for(var yy in item1){
                       var itemsub = {};
                         itemsub["id0"] = row1[yy];//1000;
                       for(var zz in item1[yy]){
                           for(var www in item1[yy][zz] ){
                             itemsub[www] = item1[yy][zz][www];
                         }
                      }
                     itemx.push(itemsub);
                 }
        
      
               
                $("#targetbody").html(get_tablebody(row,itemx));
           };
               
            
        function onerrors(data) {
              
            }
        jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshun1/get_reporttotal_data", packet, onsuccess, onerrors);
       
     }
        
        
        
        
        
/*
        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

        var headtitle = new Array();

        var rowtitle = [
            {"key": "total1", "value": "X <-1000W"}, 
            {"key": "total2", "value": "-1000W<X <-500W"}, 
            {"key": "total3", "value": "-500W<X <-300W"},
            {"key": "total4", "value": "-300W<X <-100W"}, 
            {"key": "total5", "value": "-100W<X <-50W"}, 
            {"key": "total6", "value": "-50W<X <-30W"}, 
            {"key": "total22", "value": "-30W<X <-10W"}, 
            {"key": "total23", "value": "-10W<X <-5W"},
            {"key": "total7", "value": "-5W<X <-3W"},
            {"key": "total8", "value": "-3W<X <-1W"},
            {"key": "total9", "value": "-1W<X <-5000"},
            {"key": "total10", "value": "-5000<X <-3000"},
            {"key": "total12", "value": "-3000<X <3000"},
            {"key": "total12", "value": "3000<X <5000"},
            {"key": "total12", "value": "5000<X <1W"},
            {"key": "total12", "value": "1W<X <3W"},
            {"key": "total12", "value": "3W<X <5W"},
            {"key": "total12", "value": "5W<X <10W"},
            {"key": "total12", "value": "10W<X <30W"},
            {"key": "total12", "value": "30W<X <50W"},
            {"key": "total12", "value": "50W<X <100W"},
            {"key": "total12", "value": "100W<X <300W"},
            {"key": "total12", "value": "300W<X <500W"},
            {"key": "total12", "value": "500W<X <1000W"},
            {"key": "total12", "value": "1000W<X"},
];

        var coltitle_p = [{"no": "新手场"}, {"no": "初级场"}, {"no": "中级场"}, {"no": "高级场"}, {"no": "vip场"}];

        var rowdata = new Array();

        function getsumdata(time, key) {
            
            if (rowdata[key+time+m_gameid+m_roomid ] !== undefined)
            {
                var datay = rowdata[key+time+m_gameid+m_roomid ];
                var datax = eval("(" + datay + ")");
                var allcountx = datax["合计"];
                return '<div rawdatay=' + allcountx + ' rawdatax=' + datay + ' style="cursor:pointer;margin-top:3px;" onclick=doclick("' + key + '","' + time + '") id="id' + key + time + '">' + allcountx + '</div>';
            }
            
            var packet = {
                action: 'get_online_data',
                time: time,
                key: key,
                gameid: m_gameid,
                channel:m_roomid,
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
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reporttotal/get_reporttotal_data", packet, onsuccess, onerrors);
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

        });
        
        
        */

    </script>
</body>
</html>
