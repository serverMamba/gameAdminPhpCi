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
            <th    status="1" id="myid${id}${ttxx}"  class="center" ></th>
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
                                            <h5><i class="icon-arrow-left"></i>电玩城运营总表<!--：<label id="mycurrentgameid"><?php echo $initdatastr ?></label>--></h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>



                                        <div class="widget-toolbox padding-8 clearfix">
                                             <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                         <!--       <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
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
                                         -->
                                            </div>
                                            
                                             <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">开始时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="mystarttime" type="text"  value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                             
                                              <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">结束时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="myendtime" type="text"  value="<?php echo date('Y-m-d', time()) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                            
                                            
                                              
                                             <!--
                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">开始时间</label>
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">结束时间</label>
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            -->


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


        var mystarttime_back = "";
        var myendtime_back = "";

        var offset = 0;

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }
      
      
 var headtitlename = [
{"id":1, "name": "水果机-在线峰值","child":[]}, 	
{"id":3,"name": "水果机-今日游戏总人数","child":[]}, 	
{"id":4,"name": "水果机-次日登录总人数","child":[]}, 	
{"id":5,"name": "水果机-今日首玩人数","child":[]}, 	
{"id":6,"name": "水果机-首玩次日登录人数","child":[]}, 	
{"id":7,"name": "水果机-次留","child":[]}, 
{"id":30,"name": "水果机-去新DAU","child":[]}, 	
{"id":8,"name": "水果机-总游戏局数","child":[]}, 	
{"id":9,"name": "水果机-平均单人游戏局数","child":[]}, 	
{"id":10,"name": "水果机-猜大小总局数","child":[]}, 	
{"id":11,"name": "水果机-总玩分","child":[]}, 	
{"id":12,"name": "水果机-总赢分","child":[]}, 	
{"id":13,"name": "水果机-系统总抽水","child":[]}, 
	
{"id":2,"name": "寻宝-高峰在线","child":[]}, 	
{"id":14,"name": "金豆寻宝-总游戏次数","child":[]}, 
{"id":15,"name": "金豆寻宝-总游戏人数","child":[]}, 
{"id":16,"name": "金豆寻宝-消耗玩家金豆","child":[]}, 	
{"id":20,"name": "金豆寻宝-总发放[金豆]","child":[]},
{"id":21,"name": "金豆寻宝-总发放[钻石]","child":[]},
{"id":22,"name": "金豆寻宝-总发放[银宝盒]","child":[]}, 
{"id":23,"name": "金豆寻宝-总发放[金宝盒]","child":[]},
{"id":24,"name": "金豆寻宝-总发放[兑奖券]","child":[]}, 

{"id":17,"name": "兑奖券寻宝-总游戏次数","child":[]}, 	
{"id":18,"name": "兑奖券寻宝-总游戏人数","child":[]}, 
{"id":19,"name": "兑奖券寻宝-消耗玩家兑奖券","child":[]}, 	
{"id":25,"name": "兑奖券寻宝-总发放[金豆]","child":[]},	
{"id":26,"name": "兑奖券寻宝-总发放[钻石]","child":[]},
{"id":27,"name": "兑奖券寻宝-总发放[银宝盒]","child":[]},
{"id":28,"name": "兑奖券寻宝-总发放[金宝盒]","child":[]},
{"id":29,"name": "兑奖券寻宝-总发放[兑奖券]","child":[]}];


var headtitlenamex = [];

for(var x in headtitlename){
    headtitlenamex[x+""] = headtitlename["name"];
}



        

        var headtitle = new Array();
        
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
            for (var start = endticket; start <= endticket; start = start - 24 * 60 * 60)
            {
                var timestr = getdate1(start);
                var xx =timestr.split("-");
                if(xx[1].length ===1) xx[1] = "0"+xx[1];
                if(xx[2].length ===1) xx[2] = "0"+xx[2];
                var timestrxx = xx[0]+xx[1]+xx[2];
                headtitle.push({"tt": timestr,"ttxx": timestrxx});
                if (headtitle.length >= 7)
                    break;
            }
          

            $("#targethead").html($("#headmodel1").tmpl({"titles": headtitle}));
           
           var packet = {
                action: 'get_online_data',
                starttime: starttime,
                endtime: endtime,
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                $("#targetbody").html($("#headdata1").tmpl({"titles": headtitle, "rowdataxxx": headtitlename}));
                var datay = eval("(" + data + ")");
                var leng = datay.length;
                 
                 for(var i = 0;i<leng;i++){
                    var datexx    = datay[i]["statistics_date"];
                    var name    = datay[i]["name"];
                    var value   = datay[i]["value"];
                    var xx = datexx.split("-");
                     $("#myid"+name+xx[0]+xx[1]+xx[2]).html( value);
                  }
                  
                
                  
                   for(var item in headtitlename){
                      if(headtitlename[item]["child"].length>0){
                           $("#myid"+headtitlename[item]["id"]).addClass("red");
                           $("#myid"+headtitlename[item]["id"]).css("cursor","pointer");
                           $("#myid"+headtitlename[item]["id"]).attr("child", JSON.stringify( headtitlename[item]["child"]));
                           
                             for(var rr in headtitlename[item]["child"]){
                               $("#myid"+headtitlename[item]["child"][rr]).addClass("hide"); 
                               $("#myid"+headtitlename[item]["child"][rr]).addClass("blue"); 
                             }
                           
                            $("#myid"+headtitlename[item]["id"]).click(function() {
                             
                                 var child = JSON.parse( $(this).attr("child"));
                                
                                 for(var rr in child ){
                                      if($("#myid"+child[rr]).hasClass("hide")){
                                         $("#myid"+child[rr]).removeClass("hide");   
                                      }else{
                                          $("#myid"+child[rr]).addClass("hide");   
                                           }
                                  }
                              });
                         
                      }
                  }
                  
                  
                
 
            }
            function onerrors(data) {
               $("#id" + key + time).html("error");
            }
            
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshunfish8dw/get_reportgame_data", packet, onsuccess, onerrors);
   
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
