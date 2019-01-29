<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

     <script id="headmodel_p" type="text/html" >
        <tr>
            <th class="center blue header-color-green" style="cursor: pointer;" onclick="javascript:backfather()" colspan="6" >${time}</th>

        </tr>
        <tr>
            <th class="center blue">科目</th>
            {{each titles_p}}
            <th class="center blue">${no}</th>
            {{/each}}
        </tr>
    </script>

    <script id="datamodel_p" type="text/html" >
        {{each rowtitles_p}}
        <tr>
            <td class="center">${value}</td>

            {{each titles_p}}
            <td class="center" style="padding: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;"><div style="margin-top: 6px;">${getsumdata_p(no,value,key,time)}</div></td>
            {{/each}}
        </tr>
        {{/each}}
    </script>

    <script id="innertable" type="text/html" >
        <table  class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
            <thead >
                <tr>
                    <th class="center blue">科目</th>
                    <th class="center blue">内容</th>
                </tr>
            </thead>

            <tbody>
                {{each titles}}
                <tr>
                    <td class="center">${key}</td>
                    <td class="center">${value}</td>
                </tr>
                {{/each}}
            </tbody>
        </table>
    </script>

    <script id="innertable1" type="text/html" >
        <table  class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
            <thead >
                <tr>
                    {{each titles}}
                    <th class="center blue">${key}</th>
                    {{/each}}
                </tr>
            </thead>

            <tbody>
                <tr>
                    {{each titles}}
                    <td class="center">${value}</td>
                    {{/each}}
                </tr>
            </tbody>
        </table>
    </script>

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

                       <!--     <?php $this->load->view('no3/common/nav_top2', $header3); ?>  -->



                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-blue2">
                                            <h5><i class="icon-arrow-left"></i>玩家游戏记录：<label id="mycurrentgameid"><?php echo $initdatastr ?></label></h5>

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

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">三层报表，点击报表中的数据，会弹出子报表！</div>

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


        var m_gameid = <?php echo $initdata ?>;
        var m_gamename = "MJ2P(二人麻将)";

        var mystarttime_back = "";
        var myendtime_back = "";

        var offset = 0;

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

        var headtitle = new Array();


        var rowtitle = [{"key": "yxjs", "value": "游戏局数"}, {"key": "yxjshi", "value": "游戏局时（小时）"}, {"key": "dryxrs", "value": "当日游戏人数"},
            {"key": "zgzxrs", "value": "最高在线人数"}, {"key": "djhs", "value": "单局耗时（秒）"}, {"key": "dryxsc", "value": "单人游戏时长（分钟）"},
            {"key": "xzyh", "value": "新增用户"},  {"key": "jdff", "value": "金豆发放"}, {"key": "zczs", "value": "注册赠送"},
            {"key": "jjlq", "value": "救济领取"}, {"key": "dljl", "value": "登录奖励"}, {"key": "rwjl", "value": "任务奖励"},
            {"key": "zzf", "value": "总桌费"},
            {"key": "jqrjf", "value": "机器人净分"},
            {"key": "jqrgf", "value": "机器人加分"},
             {"key": "jqrsf", "value": "机器人减分"},
            
        
        {"key": "dhjzn", "value": "兑换券总量"},
            {"key": "bzff", "value": "豹子获胜发放"},
            {"key": "bzffcs", "value": "豹子获胜发放次数"},
            {"key": "A235hsff", "value": "235获胜发放"},
            {"key": "A235hsffcs", "value": "235获胜发放次数"},
            {"key": "allbzff", "value": "全A豹子发放"},
            {"key": "allbzffcs", "value": "全A豹子发放次数"},
            
            {"key": "nnhsdhjsl", "value": "牛牛获胜兑换券数量"},
            {"key": "jlhsdhjsl", "value": "金牛获胜兑换券数量"},
            {"key": "nnhsdhjcs", "value": "牛牛获胜兑换券次数"},
            {"key": "jlhsdhjcs", "value": "金牛获胜兑换券次数"},
        
            {"key": "dhjzffrs", "value": "兑换券总发放人数"},
            {"key": "dhjrjhd", "value": "兑换券人均获得"},{"key": "dhjmxsff", "value": "兑换券每小时发放"},
            {"key": "scsr", "value": "商城收入"}, {"key": "dxl", "value": "掉线率(%)"}];

        var rowtitle_p = [{"key": "yxjs", "value": "游戏局数"}, {"key": "yxjshi", "value": "游戏局时"}, {"key": "dryxrs", "value": "当日游戏人数"},
           {"key": "djhs", "value": "单局耗时"}, {"key": "dryxsc", "value": "单人游戏时长"},{"key": "jqrjf", "value": "机器人净分"},
            {"key": "dhjzn", "value": "兑换券总量"},{"key": "dhjzffrs", "value": "兑换券总发放人数"},{"key": "dhjrjhd", "value": "兑换券人均获得"},{"key": "dhjmxsff", "value": "兑换券每小时发放"},
            {"key": "zzf", "value": "总桌费"}, {"key": "yxzk", "value": "游戏状况"}];

        var coltitle_p = [{"no": "新手场"}, {"no": "初级场"}, {"no": "中级场"}, {"no": "高级场"}, {"no": "vip场"}];

        var rowdata = new Array();

        function ontime_dryxsc(time, key) {
            window.setTimeout(function() {
                if ((rowdata["yxjshi"+time+m_gameid] !== undefined) && (rowdata["dryxrs"+time+m_gameid] !== undefined)) {
                    
                    var datax = eval("(" + rowdata["yxjshi"+time+m_gameid] + ")");
                    var datay = eval("(" + rowdata["dryxrs"+time+m_gameid] + ")");
                     
                    var valuex = "{";
                    for (var item in datay) {
                        var value = 0;
                        if(parseInt(datay[item])!==0){
                             value =  datax[item ]*60 / datay[item];
                         }
                        value =  value.toFixed(2);
                        valuex = valuex + item + ":" + value + ",";
                    }
                     valuex =  valuex + "}";
  
                     var valuey = 0;
                     if(parseFloat(datay["合计"])>0){
                        valuey =  (parseInt(datax["合计"])*60)/parseInt(datay["合计"]);
                     }
 
                    rowdata[key+time+m_gameid] = valuex;
                    valuey =valuey.toFixed(2)
                    $("#id" + key + time).attr("rawdatax", valuex);
                    $("#id" + key + time).attr("rawdatay", valuey);
                    $("#id" + key + time).html(valuey);
  
                } else {
                    ontime_dryxsc(time, key);
                }
            }, 100);
        }
        
         function ontime_jdff(time, key) {
            window.setTimeout(function() {
                if ((rowdata["zczs"+time+m_gameid] !== undefined) && (rowdata["jjlq"+time+m_gameid] !== undefined)&& (rowdata["dljl"+time+m_gameid] !== undefined)&& (rowdata["rwjl"+time+m_gameid] !== undefined)&& (rowdata["zzf"+time+m_gameid] !== undefined)) {
                 
                 var datay = parseFloat($("#id"+"zczs"+time).html())+ parseFloat($("#id"+"jjlq"+time).html())+ parseFloat($("#id"+"dljl"+time).html())+ parseFloat($("#id"+"rwjl"+time).html());
                 
                 var datax ="{"+"合计"+":"+datay+"}";
                   
                    rowdata[key+time+m_gameid] = datax;
                    $("#id" + key + time).attr("rawdatax", datax);
                    $("#id" + key + time).attr("rawdatay", datay);
                    $("#id" + key + time).html(datay);
                    
                    
                    var datay1 = parseFloat($("#id"+"zzf"+time).html()) -  datay;
                    
                    var datax1 ="{"+"合计"+":"+datay1+"}"

                    $("#id" + "yxzk" + time).attr("rawdatax", datax1);
                    $("#id" + "yxzk" + time).attr("rawdatay", datay1);
                    $("#id" + "yxzk" + time).html(datay1);
  
                } else {
                    ontime_jdff(time, key);
                }
            }, 1000);
        }
        

        function getsumdata(time, key) {
   
            if (key === "dryxsc") {
                ontime_dryxsc(time, key);
                return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
            }
            
            if (key === "jdff") {
                ontime_jdff(time, key);
                return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
            }
            
            if ( (rowdata[key+time+m_gameid] !== undefined))
            {
                var datay = rowdata[key+time+m_gameid];
                var datax = eval("(" + datay + ")");
                   
                var allcountx = datax["合计"];
                return '<div rawdatay=' + allcountx + ' rawdatax=' + datay + ' style="cursor:pointer;margin-top:3px;" onclick=doclick("' + key + '","' + time + '") id="id' + key + time + '">' + allcountx + '</div>';
            }

             var packet = {
                action: 'get_online_data',
                time: time,
                key: key,
                gameid: m_gameid,
            };
            function onsuccess(data) {
                 rowdata[key+time+m_gameid] = data;
                var datax = eval("(" + data + ")");
                var allcountx = datax["合计"];
                $("#id" + key + time).attr("rawdatax", data);
                $("#id" + key + time).attr("rawdatay", allcountx);
                $("#id" + key + time).html(allcountx);
            }
            function onerrors(data) {
               $("#id" + key + time).html("error");
            }
              jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/reportgame/get_reportgame_data", packet, onsuccess, onerrors);
            return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
        }

        function backfather() {
            reflesh();
        }

        function getsumdata_p(no, value, key, time) {
            if ( (rowdata[key+time+m_gameid] !== undefined)) {
                if ((rowdata[key+time+m_gameid]).length > 1) {
                    var datax = eval("(" + rowdata[key+time+m_gameid] + ")");
                     if (datax[no] === undefined) {
                        return "0";
                    }
                    return datax[no];
                } else {
                    return "0";
                }
                return rowdata[key+time+m_gameid];
            }
            return "0";
        }

        function dotimeclick_p(time) {
            $("#targethead").html($("#headmodel_p").tmpl({"time": time, "titles_p": coltitle_p}));
            $("#targetbody").html($("#datamodel_p").tmpl({"time": time, "titles_p": coltitle_p, "rowtitles_p": rowtitle_p}));
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
        
         function open18(){
              $(".nnhsdhjslcls").removeClass("hide");
             $(".jlhsdhjslcls").removeClass("hide");
             $(".nnhsdhjcscls").removeClass("hide");
             $(".jlhsdhjcscls").removeClass("hide");
             }
        
       function close18(){
             $(".nnhsdhjslcls").addClass("hide");
             $(".jlhsdhjslcls").addClass("hide");
             $(".nnhsdhjcscls").addClass("hide");
             $(".jlhsdhjcscls").addClass("hide");
        }
        
        
        function open49(){
             $(".bzffcls").removeClass("hide");
             $(".bzffcscls").removeClass("hide");
             $(".A235hsffcls").removeClass("hide");
             $(".A235hsffcscls").removeClass("hide");
             $(".allbzffcls").removeClass("hide");
             $(".allbzffcscls").removeClass("hide");
          }
        
       function close49(){
             $(".bzffcls").addClass("hide");
             $(".bzffcscls").addClass("hide");
             $(".A235hsffcls").addClass("hide");
             $(".A235hsffcscls").addClass("hide");
             $(".allbzffcls").addClass("hide");
             $(".allbzffcscls").addClass("hide");
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
   
 
            $(".dyhyyhcls").addClass("hide blue");
            $(".qrhyyhcls").addClass("hide blue");
            $(".ssrhyyhcls").addClass("hide blue");

            $(".xzyhcls").children("td").first().bind("click", function() {
                if ($(".dyhyyhcls").hasClass("hide"))
                {
                    $(".dyhyyhcls").removeClass("hide");
                    $(".qrhyyhcls").removeClass("hide");
                    $(".ssrhyyhcls").removeClass("hide");
                } else {
                    $(".dyhyyhcls").addClass("hide");
                    $(".qrhyyhcls").addClass("hide");
                    $(".ssrhyyhcls").addClass("hide");
                }
            });

            $(".jdffcls").children("td").first().addClass("pink");
            $(".jdffcls").children("td").first().attr("style", "text-decoration:underline;cursor:pointer");


            $(".zczscls").addClass("hide blue");
            $(".jjlqcls").addClass("hide blue");
            $(".dljlcls").addClass("hide blue");
            $(".rwjlcls").addClass("hide blue");

            $(".jdffcls").children("td").first().bind("click", function() {
                if ($(".zczscls").hasClass("hide")) {
                    $(".zczscls").removeClass("hide");
                    $(".jjlqcls").removeClass("hide");
                    $(".dljlcls").removeClass("hide");
                    $(".rwjlcls").removeClass("hide");
                } else {
                    $(".zczscls").addClass("hide");
                    $(".jjlqcls").addClass("hide");
                    $(".dljlcls").addClass("hide");
                    $(".rwjlcls").addClass("hide");
                }
            });
            
            if(parseInt(m_gameid) === 49){
                open49();
            }else{
                close49();      
           }
           
            if(parseInt(m_gameid) === 18){
                open18();
            }else{
                close18();      
           }


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
