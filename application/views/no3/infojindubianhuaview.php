<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    
    <body>
          
        <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center">玩家id</th>
            <th>金豆变化</th>	
            <th>时间</th>
            <th>结束金豆</th>	
            <th>起始金豆</th>	
            <th>底注</th>
            <th>游戏类型	</th>
            <th>事件类型	</th>
            <th><i class="icon-time bigger-110 hidden-480"></i>ip	</th>
            <th>房间id</th>	
            <th><i class="icon-time bigger-110 hidden-480"></i>座位id</th>
        </tr>
    </script>

    <script id="datamodel1" type="text/html" >
        <tr>
            <td class="center">${userid}</td>
            <td class="hidden-480">${chips}</td>
            <td><i class="icon-time bigger-110 hidden-480"></i>${happentime}</td>
            <td>${finalchips}</td>
            <td>${originalchips}</td>
            <td>${basescore}</td>
            <td>${gamecode}</td>
            <td>${eventtype}</td>
            <td>${ipaddress}</td>
            <td>${roomid}</td>
            <td>${tableid}</td>
            <td>${seatid}</td>
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
                                        
                                      
                                        <div class="widget-header header-color-blue2">
                                            <h5><i class="icon-arrow-left"></i>玩家金豆变化记录</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>

												


                                        <div class="widget-toolbox padding-8 clearfix">
                                           
                                     
                                            
                                            <div class="widget-toolbar no-border pull-left" style="width:250px;height:32px;" >
                                                  <select class="zsh-select form-control"  id="form-field-select-3" data-placeholder="Choose a Country..." style="height:32px;width:200px;">
                                                   <?php foreach ($gamelists as $myid => $myname) { ?>
                                                     <option value="<?php echo $myname ?>"><?php echo $myid ?></option>
                                                    <?php } ?>
                                                 </select>
                                            </div>
                                            
                                            
                                            <div class="widget-toolbar no-border pull-left" style="width:250px;height:32px;margin-left:-10px;margin-top:-5px;" >
                                                <select class="zsh-select form-control"  id="form-field-select-x" data-placeholder="Choose a Country..." style="height:32px;width:200px;">
                                                    <option value="-1"  selected="true">全部(-1)</option>
                                                    <option value="0" >默认(0)</option>
                                                    <option value="1">游戏加分(1)</option>
                                                    <option value="2"> 游戏减分(2)</option>
                                                    <option value="3"> 买道具(3)</option>
                                                    <option value="4"> 卖道具(4)</option>
                                                    <option value="5"> 买礼物(5)</option>
                                                    <option value="6"> 广告墙(6)</option>
                                                    <option value="8"> 赠送筹码(8)</option>
                                                    <option value="9"> 游戏中购买(9)</option>
                                                    <option value="10"> 在线奖励(10)</option>
                                                    <option value="11"> 桌子奖励(11)</option>
                                                    <option value="12"> 低保(12)</option>
                                                    <option value="13"> 登录奖励(13)</option>
                                                    <option value="14"> 转盘奖励(14)</option>
                                                    <option value="15"> 水果机奖励(15)</option>
                                                    <option value="16"> 三张牌喜钱(16)</option>
                                                    <option value="17"> 充值(17)</option>
                                                    <option value="18"> 后台加分(18)</option>
                                                    <option value="19"> 后台减分(19)</option>
                                                    <option value="20"> vip登录奖励(20)</option>
                                                    <option value="21"> 买喇叭(21)</option>
                                                    <option value="22"> 买vip(22)</option>
                                                    <option value="23"> 服务费(23)</option>
                                                    <option value="24"> 离线玩家结算(24)</option>
                                                    <option value="25"> 任务奖励(25)</option>
                                                    <option value="26"> 局数奖励(26)</option>
                                                    <option value="27"> 兑换产品(27)</option>
                                                    <option value="28"> 兑换vip(28)</option>
                                                    <option value="29"> 签到奖励(29)</option>
                                                    <option value="30"> 比赛报名费(30)</option>
                                                    <option value="31"> 机器人加减分(31)</option>
                                                    <option value="32"> 保险箱存取(32)</option>
                                                    <option value="33"> 排行榜奖励(33)</option>
                                                    <option value="34"> 活动奖励(34)</option>
                                                    <option value="35"> 兑奖券兑换(35)</option>
                                                    <option value="36"> 使用宝箱(36)</option>
                                                    <option value="37"> 新礼物(37)</option>
                                                    <option value="38"> 互动表情(38)</option>

                                            
                                                 </select>
                                            </div>
                                          
                                            <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:30px;width:120px;"/>
                                            <input type="text" id="account1" placeholder="用户帐号"   class="col-xs-10 col-sm-2" style = "height:30px;width:120px;"/> 

                                          
                                            <input class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="起始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />

                                            <div class="input-group bootstrap-timepicker" style="float:left;">
                                            <input id="id_time_picker_1" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
                                            </div>

                                            <span class="input-group-addon col-xs-10 col-sm-2" style = "height:30px;width:60px;">
                                                <i class="icon-calendar bigger-110  zshdate1" style="cursor:pointer;"></i>
                                                <i class="icon-time bigger-110 zshtime1" style="cursor:pointer;"></i>
                                            </span>


                                            <input class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />

                                            <div class="input-group bootstrap-timepicker" style="float:left;">
                                            <input id="id_time_picker_2" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
                                            </div>

                                            <span class="input-group-addon col-xs-10 col-sm-2" style = "height:30px;width:60px;">
                                                <i class="icon-calendar bigger-110 zshdate2" style="cursor:pointer;"></i>
                                                <i class="icon-time bigger-110 zshtime2" style="cursor:pointer;"></i>
                                            </span>
                                              
  
                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>


                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                              <button onclick="javascript:excelreflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">EXCEL导出</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">












                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th class="center">玩家id</th>
            <th>金豆变化</th>	
            <th>时间</th>
            <th>结束金豆</th>	
            <th>起始金豆</th>	
            <th>底注</th>
            <th>游戏类型	</th>
            <th>事件类型	</th>
            <th><i class="icon-time bigger-110 hidden-480"></i>ip	</th>
            <th>房间id</th>	
            <th>桌子id</th>
            <th><i class="icon-time bigger-110 hidden-480"></i>座位id</th>
         
                                                        </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“查询”从服务器加载数据</div>
                                                    <ul class="pagination pull-right no-margin">
                                                        <li class="pageitemleft">
                                                            <a href="javascript:void">
                                                                <i class="icon-double-angle-left"></i>
                                                            </a>
                                                        </li>

                                                        <li class="active pageitemnum">
                                                            <a href="javascript:void">1</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">2</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">3</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">4</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">5</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">6</a>
                                                        </li>
                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">7</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">8</a>
                                                        </li>

                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">9</a>
                                                        </li>
                                                        <li class="pageitemnum">
                                                            <a href="javascript:void">10</a>
                                                        </li>

                                                        <li class="pageitemright">
                                                            <a href="javascript:void">
                                                                <i class="icon-double-angle-right"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
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
    
    <script src="../res/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../res/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../res/js/chosen.jquery.min.js"></script>
		<script src="../res/js/fuelux/fuelux.spinner.min.js"></script>
     
    		<script src="../res/js/jquery.knob.min.js"></script>
		<script src="../res/js/jquery.autosize.min.js"></script>
		<script src="../res/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../res/js/jquery.maskedinput.min.js"></script>
		<script src="../res/js/bootstrap-tag.min.js"></script>
   
    <!-- ace scripts -->

    <script src="../res/js/jquery.dataTables.min.js"></script>
    <script src="../res/js/jquery.dataTables.bootstrap.js"></script>

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>
    

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

        var m_eventid = 0;
        var m_eventname = "全部(0)";

        var beginindex = 1;
        var allcount = 0;
        
        
        var gamelist = new Array();
        
        <?php foreach ($gamelists as $myid => $myname) { ?>
                gamelist["<?php echo $myname ?>"] = "<?php echo $myid ?>"      
        <?php } ?>

        var eventitem = new Array();

        eventitem["0"] = "2400分场";
        eventitem["1"] = "6000分场";
        eventitem["2"] = "15000分场";
        
        var xitem = new Array();
        xitem["0"]="默认";
xitem["1"]="游戏加分";
xitem["2"]="游戏减分";
xitem["3"]="买道具";
xitem["4"]="卖道具";
xitem["5"]="买礼物";
xitem["6"]="广告墙";
xitem["8"]="赠送筹码";
xitem["9"]="游戏中购买";
xitem["10"]="在线奖励";
xitem["11"]="桌子奖励";
xitem["12"]="低保";
xitem["13"]="登录奖励";
xitem["14"]="转盘奖励";
xitem["15"]="水果机奖励";
xitem["16"]="三张牌喜钱";
xitem["17"]="充值";
xitem["18"]="后台加分";
xitem["19"]="后台减分";
xitem["20"]="vip登录奖励";
xitem["21"]="买喇叭";
xitem["22"]="买vip";
xitem["23"]="服务费";
xitem["24"]="离线玩家结算";
xitem["25"]="任务奖励";
xitem["26"]="局数奖励";
xitem["27"]="兑换产品";
xitem["28"]="兑换vip";
xitem["29"]="签到奖励";
xitem["30"]="比赛报名费";
xitem["31"]="机器人加减分";
xitem["32"]="保险箱存取";
xitem["33"]="排行榜奖励";
xitem["34"]="活动奖励";
xitem["35"]="兑奖券兑换";
xitem["36"]="使用宝箱";
xitem["37"]="新礼物";
xitem["38"]="互动表情";

       
        
        
        var id_date_picker_1 = "";
        var id_time_picker_1 = "";
        var id_date_picker_2 = "";
        var id_time_picker_2 = "";

        var userid_back = "";
        var account_back = "";

        function reset() {
         
            $("#id_date_picker_1").val(id_date_picker_1);
            $("#id_time_picker_1").val(id_time_picker_1);
            $("#id_date_picker_2").val(id_date_picker_2);
            $("#id_time_picker_2").val(id_time_picker_2);
          
            $("#userid1").val(userid_back);
            $("#account1").val(account_back);
        }

        function get_online_data(eventid) {
            $("#targetbody").html("");
            var useridx = $("#userid1").val();
            var accountx = $("#account1").val();
            var xx =accountx+useridx;
            if(xx.length <=0){
                alert("数据量巨大，帐号必须！")
                return;
            }
         
            id_date_picker_1 = $("#id_date_picker_1").val();
            id_time_picker_1 = $("#id_time_picker_1").val();
            id_date_picker_2 = $("#id_date_picker_2").val();
            id_time_picker_2 = $("#id_time_picker_2").val();
           
            userid_back = $("#userid1").val();
            account_back = $("#account1").val();
            var packet = {
                action: 'get_online_data',
                mystarttime: $("#id_date_picker_1").val()+" "+$("#id_time_picker_1").val(),
                myendtime:   $("#id_date_picker_2").val()+" "+$("#id_time_picker_2").val(),
                userid: $("#userid1").val(),
                account: $("#account1").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: $("#form-field-select-3").val(),
                eventid: $("#form-field-select-x").val(),
            };
            function onsuccess(data) {
                
                 $(".pageitemnum").removeClass("hide");
                $(".pageitemleft").removeClass("disabled");
                $(".pageitemright").removeClass("disabled");
                var datax = eval("(" + data + ")");
                /*
                if(datax["status"]=="1"){
                    alert("userid或帐号至少填一个！");
                    return ;
                }
                */
                allcount = datax["count"][0]["count"];
                
                 $(".pageitemnum").each(function(i,e) {
                    if (parseInt($(e).children().html()) * 20 - 20 < allcount) {
                        $(this).children("a").html($(e).children().html());
                    } else {
                        $(this).addClass("hide");
                    }
                })

                for (var itemx in datax["detail"])
                {
                    datax["detail"][itemx]["eventtype"] = xitem[datax["detail"][itemx]["eventtype"]];
                    var xxx = gamelist[""+datax["detail"][itemx]["gamecode"]];
                    if(xxx == undefined){
                        
                    }else{
                       datax["detail"][itemx]["gamecode"] = xxx; 
                    }
                    
  
                }
                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infojindubianhua/get_jindubianhua_data", packet, onsuccess, onerrors);
        }

        function changeevent(eventid, eventname) {
            m_eventid = eventid;
            m_eventname = eventname;
            beginindex = 1;
            $("#mycurrentgameid").html(eventname);
            get_online_data(eventid);
        }

        //  get_online_data(m_eventid);

        function reflesh() {
            beginindex = 1;
            get_online_data(m_eventid);
        }
        
        
         function excelreflesh() {
          
            var param = "infojindubianhua/get_jindubianhua_data_excel?" +
                "mystarttime=" + $("#id_date_picker_1").val()+" "+$("#id_time_picker_1").val() +
                "&myendtime=" + $("#id_date_picker_2").val()+" "+$("#id_time_picker_2").val() +
                "&userid=" + $("#userid1").val() +
                "&account=" + $("#account1").val() +
                "&gameid=" + $("#form-field-select-3").val()+
                "&eventid=" + $("#form-field-select-x").val();
    
 		
        var form = $("<form>");
        form.attr("style", "display:none");
        form.attr("target", "");
        form.attr("method", "post");
        form.attr("action", param);
        var input1 = $("<input>");
        input1.attr("type", "hidden");
        input1.attr("name", "exportData");
        input1.attr("value", (new Date()).getMilliseconds());
        $("body").append(form);
        form.append(input1);
        form.submit();
            
            
            
            
            
            
            /*
            $("#targetbody").html("");
            var useridx = $("#userid1").val();
            var accountx = $("#account1").val();
            var xx =accountx+useridx;
            if(xx.length <=0){
                alert("数据量巨大，帐号必须！")
                return;
            }
         
            id_date_picker_1 = $("#id_date_picker_1").val();
            id_time_picker_1 = $("#id_time_picker_1").val();
            id_date_picker_2 = $("#id_date_picker_2").val();
            id_time_picker_2 = $("#id_time_picker_2").val();
           
            userid_back = $("#userid1").val();
            account_back = $("#account1").val();
            var packet = {
                action: 'get_online_data',
                mystarttime: $("#id_date_picker_1").val()+" "+$("#id_time_picker_1").val(),
                myendtime:   $("#id_date_picker_2").val()+" "+$("#id_time_picker_2").val(),
                userid: $("#userid1").val(),
                account: $("#account1").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: $("#form-field-select-3").val(),
                eventid: $("#form-field-select-x").val(),
            };
            
            function onsuccess(data) {
                
                
            
                
                 $(".pageitemnum").removeClass("hide");
                $(".pageitemleft").removeClass("disabled");
                $(".pageitemright").removeClass("disabled");
                var datax = eval("(" + data + ")");
                allcount = datax["count"][0]["count"];
                
                 $(".pageitemnum").each(function(e) {
                    if (e * 20 < allcount) {
                        $(this).children("a").html(e + parseInt(beginindex / 10) * 10 + 1);
                    } else {
                        $(this).addClass("hide");
                    }
                })

                for (var itemx in datax["detail"])
                {
                    datax["detail"][itemx]["eventtype"] = xitem[datax["detail"][itemx]["eventtype"]];
                    var xxx = gamelist[""+datax["detail"][itemx]["gamecode"]];
                    if(xxx == undefined){
                        
                    }else{
                       datax["detail"][itemx]["gamecode"] = xxx; 
                    }
                    
  
                }
                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
             
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infojindubianhua/get_jindubianhua_data_excel", packet, onsuccess, onerrors);
            
            */
        }

        reflesh();
        jQuery(function($) {
            
            $("#id_date_picker_1").val(getdate(-24*60*60));
            $("#id_date_picker_2").val(getdate(24*60*60));
            $(".pageitemnum").addClass("hide");
            $(".pageitemleft").addClass("disabled");
            $(".pageitemright").addClass("disabled");
            $(".pageitemnum").bind("click", function() {
                $(".pageitemnum").removeClass("active");
                $(this).addClass("active");
                beginindex = parseInt($(this).children("a").html());
                get_online_data(m_eventid);
            });

            $(".pageitemleft").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) - 10;
                        if (tmp <= 0)
                            return;
                        $(this).children("a").html(tmp);
                        $(this).removeClass("hide");
                    })

                }
            });

            $(".pageitemright").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) + 10;
                        if (tmp * 20 - 20 >= allcount){
                        	$(this).children("a").html(tmp);
                        	$(this).addClass("hide");
                        }else{
                       		$(this).children("a").html(tmp);
                        }
                    });
                }
            });
            
            
            $('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
					$("#id_date_picker_1").focus();
				});
            $('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
					$("#id_date_picker_2").focus();
				});
                                
             $(".zshdate1").bind("click",function(){
              $("#id_date_picker_1").focus();
            });
              
            $(".zshdate2").bind("click",function(){
              $("#id_date_picker_2").focus();
            });
                                
                                  
            $('#id_time_picker_1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).on(ace.click_event, function(){
					$("#id_time_picker_1").focus();
  				});
                                
             $('#id_time_picker_2').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).on(ace.click_event, function(){
					$("#id_time_picker_2").focus();
				});  
                                
            $(".zshtime1").bind("click",function(){
              $("#id_time_picker_1").focus();
            });
              
            $(".zshtime2").bind("click",function(){
              $("#id_time_picker_2").focus();
            });
           
            
            $(".zsh-select").chosen({disable_search_threshold: 50}); 
            
            $("#form_field_select_3_chosen").addClass("col-xs-10 col-sm-2");
            
            $("#form_field_select_3_chosen").attr("style","width:250px;height:32px;");
           
            
        });

    </script>
</body>
</html>
