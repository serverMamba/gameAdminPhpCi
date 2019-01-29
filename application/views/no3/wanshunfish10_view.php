<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        <script id="headmodel1" type="text/html" >
        <tr>
            <th class="center">userID</th>
            <th>帐号</th>
            <th>昵称</th>

            <th class="hidden-480">开洗分类型</th>
            <th>初始金贝</th>
            <th class="hidden-480">结束金贝</th>
            <th>操作金额</th>
            <th>记录时间/th>

            <th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
        </tr>
    </script>

    <script id="datamodel1" type="text/html" >
        <tr>
           
            
             <th class="center">${id}</th>
                                                            <th>${userid}</th>
                                                          
                                                            <th class="hidden-480">${roomid}</th>
                                                             <th>${missionid}</th>
                                                             
                                                               <th>${missionresult}</th>
                                                            

                                                            <th>${missionrewardid}</th>
                                                            <th>${missionrewardnum}</th>
                                                            <th>${beforerewardpool}</th>
                                                            <th>${afterrewardpool}</th>
                                                             <th>${recordtime}</th>
            
            
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
                                            <h5><i class="icon-arrow-left"></i>捕鱼任务查询</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                <div class="widget-toolbox padding-8 clearfix">
                                           
                                     
                                            
                                      <!--      <div class="widget-toolbar no-border pull-left" style="width:250px;height:32px;" >
                                                  <select class="zsh-select form-control"  id="form-field-select-3" data-placeholder="Choose a game..." style="height:32px;width:200px;">
                                                   <?php foreach ($gamelist as $myid => $myname) { ?>
                                                     <option value="<?php echo $myname ?>"><?php echo $myid ?></option>
                                                    <?php } ?>
                                                 </select>
                                            </div>  -->
                                          
                                            <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:30px;width:120px;"/>
                                            <input type="text" id="account1" placeholder="用户帐号"   class="col-xs-10 col-sm-2" style = "height:30px;width:120px;"/> 

                                          
                                                   <label    class="col-xs-10 col-sm-2" style = "height:26px;width:80px;margin-top:5px;">任务时间</label>
                                            <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="mystarttime" type="text"  value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>

                                  
                                                                                       
                  
                                            
                                            
                                       <!--     
                                         
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d H:i:s', time() - 1 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d H:i:s', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            
                                      -->

                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>


                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        
                                        
                                        
                                        
                                        
                                        

<!--

                                      <div class="widget-toolbox padding-8 clearfix">
                                              <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    游戏选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                    <?php foreach ($gamelist as $myname => $myid) { ?>
                                                        <li>
                                                            <a href="javascript:changeevent('<?php echo $myid ?>','<?php echo $myname ?>')"><?php echo $myname ?></a>
                                                        </li>
                                                    <?php } ?>


                                                    <li class="divider"></li>


                                                </ul>
                                            </div>
                                             
                                            
                      
                                            <input type="text" id="userid1"  placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:34px;width:160px;"/>
                                            <input type="text" id="account1" placeholder="用户帐号"   class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 

                                            <label></label>
                                            <input type="text" id="mystarttime" placeholder="起始时间" value="<?php echo date('Y-m-d H:i:s', time() - 1 * 24 * 60 * 60) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 
                                            <input type="text" id="myendtime"   placeholder="终止时间" value="<?php echo date('Y-m-d H:i:s', time()) ?>" class="col-xs-10 col-sm-2" style = "height:34px;width:160px;"/> 

                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:3px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>


                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        
                                        -->
                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">












                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th class="center">编号</th>
                                                            <th>玩家ID</th>
                                                          
                                                            <th class="hidden-480">房间ID</th>
                                                             <th>任务内容</th>
                                                             
                                                               <th>是否完成任务</th>
                                                            

                                                            <th>任务奖励ID</th>
                                                            <th>奖励数量</th>
                                                            <th>开始奖励库值</th>
                                                            <th>结束奖励库值</th>
                                                             <th>任务结束时间</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“获得数据”从服务器加载数据</div>
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

        var m_gameid = 177;
        var m_gamename = "MJ2P(二人麻将177)";
        $("#form-field-select-3").val(177);
        
        var beginindex = 1;
        var allcount = 0;

        var id_date_picker_1 = "";
        var id_time_picker_1 = "";
        var id_date_picker_2 = "";
        var id_time_picker_2 = "";
        
        var userid_back = "";
        var account_back = "";
       
 
        var producttype1 = new Array();
       
        producttype1[0] = "兑换卡片";
        producttype1[1] = "兑换实物";
        producttype1[2] = "兑换道具";
        
        var eventex = new Array();
        
        eventex[0] = "未知";
        eventex[1] = "充值";
        eventex[2] = "vip登录奖励";
        eventex[3] = "抽奖";
        eventex[4] = "使用冰冻卡";
        eventex[5] = "使用锁定卡";
        eventex[6] = "升级炮台";
        eventex[7] = "掉落";

        
        
       var taskname1 = new Array();
       
       
        taskname1[37] = "游戏10局";
        taskname1[38] = "游戏20局";
        taskname1[39] = "连胜5局";
       
        taskname1[40] = "游戏5局";
        taskname1[41] = "游戏10局";
        taskname1[42] = "游戏50局";
        taskname1[43] = "购买6元金豆";
        taskname1[44] = "上传自己照片";
        
         var tasknamenn = new Array();
        
        tasknamenn[1]="小米鱼";
        tasknamenn[6]="绿鱼";
        tasknamenn[21]="绿色条纹鱼";
        tasknamenn[43]="大眼鱼";
        tasknamenn[10]="热带鱼";
        tasknamenn[8]="小丑鱼";
        tasknamenn[42]="河豚";
        tasknamenn[48]="蓝鱼";
        tasknamenn[2]="灯笼鱼";
        tasknamenn[24]="仙女鱼";
        tasknamenn[3]="海龟";
        tasknamenn[23]="蝴蝶鱼";
        tasknamenn[25]="剑鱼";
        tasknamenn[14]="蝙蝠鱼";
        tasknamenn[26]="银鲨";
        tasknamenn[38]="金鲨";
        tasknamenn[72]="深海金龙";
        tasknamenn[71]="金钱龟";
        tasknamenn[63]="宝箱";
        tasknamenn[49]="算盘";
        tasknamenn[4]="宝塔";
        
         var tasknamenn1 = new Array();
         
         tasknamenn1[0]="成功";
         tasknamenn1[1]="失败";
         
         var tasknamenn2 = new Array();
         
          tasknamenn2[0]="无";
         tasknamenn2[2]="钻石";
         tasknamenn2[3]="银宝盒";
         tasknamenn2[4]="金宝盒";
         tasknamenn2[5]="兑奖券";
         tasknamenn2[100]="冰冻卡";
         tasknamenn2[101]="瞄准卡";
         
         
          var tasknamennn = new Array();
         
         tasknamennn[1] = new Array();
         tasknamennn[2] = new Array();
         tasknamennn[3] = new Array();
         tasknamennn[4] = new Array();
         
    
         

tasknamennn[1][1] = "裙摆鱼|蝙蝠鱼|银鲨";
tasknamennn[1][2] = "仙女鱼|蝴蝶鱼|金鲨";
tasknamennn[1][3] = "剑鱼|金鲨|大眼鱼";
tasknamennn[1][4] = "海龟|金鲨|裙摆鱼";
tasknamennn[1][5] = "银鲨|仙女鱼|蝙蝠鱼";
tasknamennn[1][6] = "深海金龙|裙摆鱼|蝙蝠鱼";
tasknamennn[1][7] = "小米鱼|深海金鲨|银鲨";
tasknamennn[1][8] = "金鲨|蝙蝠鱼|银鲨";
tasknamennn[1][9] = "蝙蝠鱼|剑鱼|银鲨";
tasknamennn[1][10] = "灯笼鱼|金鲨|蝙蝠鱼";

tasknamennn[2][1] = "裙摆鱼|蝙蝠与|银鲨";
tasknamennn[2][2] = "仙女鱼|蝴蝶鱼|金鲨";
tasknamennn[2][3] = "银鲨|仙女鱼|蝙蝠鱼";
tasknamennn[2][4] = "深海金鲨|裙摆鱼|蝙蝠鱼";
tasknamennn[2][5] = "海龟|金鲨|裙摆鱼";
tasknamennn[2][6] = "小米鱼|深海金龙|银鲨";
tasknamennn[2][7] = "金鲨|银鲨|蝙蝠鱼";
tasknamennn[2][8] = "金鲨|蝙蝠鱼|银鲨";
tasknamennn[2][9] = "绿鱼|金钱龟|绿色条纹";
tasknamennn[2][10] = "灯笼鱼|金鲨|蝙蝠鱼";


tasknamennn[3][1] = "小丑鱼|算盘|绿鱼";
tasknamennn[3][2] = "大眼鱼|金钱龟|热带鱼";
tasknamennn[3][3] = "小米鱼|宝箱|绿鱼";
tasknamennn[3][4] = "金鲨|仙女鱼|蝴蝶鱼";
tasknamennn[3][5] = "裙摆鱼|蝙蝠鱼|深海金龙";
tasknamennn[3][6] = "小米鱼|深海金龙|银鲨";
tasknamennn[3][7] = "海龟|金鲨|裙摆鱼";
tasknamennn[3][8] = "蝙蝠鱼|裙摆鱼|银鲨";
tasknamennn[3][9] = "银鲨|蝙蝠鱼|仙女鱼";
tasknamennn[3][10] = "剑鱼|蝙蝠鱼|裙摆鱼";

tasknamennn[4][1] = "小米鱼|金钱龟|绿鱼";
tasknamennn[4][2] = "绿鱼|宝箱|小丑鱼";
tasknamennn[4][3] = "海龟|金鲨|裙摆鱼";
tasknamennn[4][4] = "金鲨|剑鱼|大眼鱼";
tasknamennn[4][5] = "银鲨|仙女鱼|蝙蝠鱼";
tasknamennn[4][6] = "金鲨|灯笼鱼|蝙蝠鱼";
tasknamennn[4][7] = "银鲨|小米鱼|深海金龙";
tasknamennn[4][8] = "裙摆鱼|蝙蝠鱼|银鲨";
tasknamennn[4][9] = "仙女鱼|海龟|银鲨";
tasknamennn[4][10] = "仙女鱼|金鲨|蝴蝶鱼";

         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
 
        
        var gamename1 = new Array();
        
         <?php foreach ($gamelist as $myname => $myid) { ?>
             gamename1["<?php echo $myid ?>"] = "<?php echo $myname ?>";
        <?php } ?>
      
        

        function reset() {
            $("#id_date_picker_1").val(id_date_picker_1);
            $("#id_time_picker_1").val(id_time_picker_1);
            $("#id_date_picker_2").val(id_date_picker_2);
            $("#id_time_picker_2").val(id_time_picker_2);
            
            $("#userid1").val(userid_back);
            $("#account1").val(account_back);
        }

        function get_online_data() {
            
          // alert( gamename1[$("#form-field-select-3").val()]);
           
           
            $("#targetbody").html("");
            
             id_date_picker_1 = $("#id_date_picker_1").val();
            id_time_picker_1 = $("#id_time_picker_1").val();
            id_date_picker_2 = $("#id_date_picker_2").val();
            id_time_picker_2 = $("#id_time_picker_2").val();
            
            userid_back = $("#userid1").val();
            account_back = $("#account1").val();
            var packet = {
                action: 'get_online_data',
                mytasktime: $("#mystarttime").val(),
                userid: $("#userid1").val(),
                account: $("#account1").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: $("#form-field-select-3").val(),
            };
            function onsuccess(data) {
                $(".pageitemnum").removeClass("hide");
                $(".pageitemleft").removeClass("disabled");
                $(".pageitemright").removeClass("disabled");
                var datax = eval("(" + data + ")");
                if(datax["status"]=="1"){
                    alert("userid或帐号至少填一个！");
                    return ;
                }
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
                    datax["detail"][itemx]["missionid"]  =  tasknamennn[datax["detail"][itemx]["roomid"] ][ parseInt( datax["detail"][itemx]["missionid"])];
                     datax["detail"][itemx]["missionresult"]  =  tasknamenn1[ parseInt( datax["detail"][itemx]["missionresult"])];
                      datax["detail"][itemx]["missionrewardid"]  =  tasknamenn2[ parseInt( datax["detail"][itemx]["missionrewardid"])];
                  //  datax["detail"][itemx]["account"]  = datax["account"];
                  //  datax["detail"][itemx]["gamename"]  = gamename1[$("#form-field-select-3").val()];
                 }
                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshunfish10/get_zhanshi_data", packet, onsuccess, onerrors);
        }

        function changeevent(gameid, gamename) {
            m_gameid = gameid;
            m_gamename = gamename;
            beginindex = 1;
            $("#mycurrentgameid").html(gamename);
            get_online_data();
        }
        

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        jQuery(function($) {
             $('.date-picker').datepicker({autoclose: true}).next().on(ace.click_event, function() {
                $(this).prev().focus();
            });
            
            $(".pageitemnum").addClass("hide");
            $(".pageitemleft").addClass("disabled");
            $(".pageitemright").addClass("disabled");
            $(".pageitemnum").bind("click", function() {
                $(".pageitemnum").removeClass("active");
                $(this).addClass("active");
                beginindex = parseInt($(this).children("a").html());
                get_online_data();
            });

            $(".pageitemleft").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) - 10;
                        if (tmp <= 0)
                            return;
                        $(this).children("a").html(tmp);
                    })

                }
            });

            $(".pageitemright").bind("click", function() {
                if (!$(this).hasClass("disabled")) {
                    $(".pageitemnum").each(function(e) {
                        var tmp = parseInt($(this).children("a").html()) + 10;
                        if (tmp * 20 > allcount)
                            return;
                        $(this).children("a").html(tmp);
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
