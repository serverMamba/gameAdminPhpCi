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
                                            <h5><i class="icon-arrow-left"></i>捕鱼运营总表<!--：<label id="mycurrentgameid"><?php echo $initdatastr ?></label>--></h5>

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
      
      
      /*
        var headtitlename = [
            {"id":1, "name": "最高在线人数","child":[]}, 	
{"id":2,"name": "登录用户数量","child":[]}, 	
{"id":3,"name": "游戏用户数量","child":[]}, 	
{"id":4,"name": "升级炮台用户数量","child":[]}, 	
{"id":5,"name": "使用表情用户数量","child":[]}, 	
{"id":6,"name": "使用技能用户数量","child":[]}, 	
{"id":7,"name": "昨日今日均游戏用户数量","child":[]}, 	
{"id":8,"name": "首次游戏用户数量","child":[]}, 	
{"id":9,"name": "首次游戏用户升级炮台数量","child":[]}, 	
{"id":10,"name": "首次游戏用户使用表情数量","child":[]}, 	
{"id":11,"name": "首次游戏用户使用技能数量","child":[]}, 	
{"id":12,"name": "前日首次游戏用户今天游戏数量","child":[]}, 	
{"id":13,"name": "次日留存","child":[]}, 	
{"id":14,"name": "所有捕鱼游戏玩家数量","child":[]}, 	
{"id":15,"name": "银宝箱发放数（扣贡献度）","child":[]}, 	
{"id":16,"name": "银宝箱发放数（不扣贡献度）","child":[]}, 	
{"id":17,"name": "银宝箱发放数（总）","child":[18,19,20]}, 	
{"id":18,"name": "银宝箱发放总价值","child":[]}, 	
{"id":19,"name": "掉落银宝盒人数","child":[]}, 	
{"id":20,"name": "金宝箱发放数（扣贡献度）","child":[]}, 	
{"id":21,"name": "金宝箱发放数（不扣贡献度）","child":[]}, 	
{"id":22,"name": "金宝箱发放数（总）","child":[]}, 	
{"id":23,"name": "金宝箱发放总价值","child":[]}, 	
{"id":24,"name": "掉落金宝盒人数","child":[]}, 	
{"id":25,"name": "捕鱼赢分玩家人数","child":[]}, 	
{"id":26,"name": "捕鱼输分玩家人数","child":[]}, 	
{"id":27,"name": "赢分玩家比例","child":[]}, 	
{"id":28,"name": "输分玩家比例","child":[]}, 	
{"id":29,"name": "总玩分","child":[]}, 	
{"id":30,"name": "总赢分","child":[]}, 	
{"id":31,"name": "抽水","child":[]}, 	
{"id":32,"name": "总净分","child":[]}, 	
{"id":33,"name": "所有玩家金豆＜1000","child":[]}, 	
{"id":34,"name": "所有玩家金豆1000－5000","child":[]}, 	
{"id":35,"name": "所有玩家金豆5000－20000","child":[]}, 	
{"id":36,"name": "所有玩家金豆20000－50000","child":[]}, 	
{"id":37,"name": "所有玩家金豆50000＋","child":[]}, 	
{"id":38,"name": "金豆分布所有玩家总和","child":[]}, 	
{"id":39,"name": "所有玩家炮台≤5","child":[]}, 	
{"id":40,"name": "所有玩家炮台5－10","child":[]}, 	
{"id":41,"name": "所有玩家炮台10－15","child":[]}, 	
{"id":42,"name": "所有玩家炮台15－20","child":[]}, 	
{"id":43,"name": "所有玩家炮台20－35","child":[]}, 	
{"id":44,"name": "所有玩家炮台＞35","child":[]}, 	
{"id":45,"name": "炮台分布所有玩家总和","child":[]}, 	
{"id":46,"name": "流失玩家金豆＜1000","child":[]}, 	
{"id":47,"name": "流失玩家金豆1000－5000","child":[]}, 	
{"id":48,"name": "流失玩家金豆5000－20000","child":[]}, 	
{"id":49,"name": "流失玩家金豆20000－50000","child":[]}, 	
{"id":50,"name": "流失玩家金豆50000＋","child":[]}, 	
{"id":51,"name": "金豆分布流失玩家总和","child":[]}, 	
{"id":52,"name": "流失玩家炮台≤5","child":[]}, 	
{"id":53,"name": "流失玩家炮台5－10","child":[]}, 	
{"id":54,"name": "流失玩家炮台10－15","child":[]}, 	
{"id":55,"name": "流失玩家炮台15－20","child":[]}, 	
{"id":56,"name": "流失玩家炮台20－35","child":[]}, 	
{"id":57,"name": "流失玩家炮台＞35","child":[]}, 	
{"id":58,"name": "炮台分布流失玩家总和","child":[]}];

*/
/*
 
            var headtitlename = [
            {"id":1, "name": "最高人数","child":[]}, 	
{"id":2,"name": "登录数量","child":[]}, 	
{"id":3,"name": "游戏数量","child":[]}, 	
{"id":4,"name": "升级炮台数量","child":[]}, 	
{"id":5,"name": "使用表情数量","child":[]}, 	
{"id":6,"name": "使用技能数量","child":[]}, 	
{"id":7,"name": "昨日今日均游戏数量","child":[]}, 	
{"id":8,"name": "首次游戏数量","child":[]}, 	
{"id":9,"name": "首玩升级炮台数量","child":[]}, 	
{"id":10,"name": "首玩使用表情数量","child":[]}, 	
{"id":11,"name": "首玩使用技能数量","child":[]}, 	
{"id":12,"name": "昨日首玩游戏数量","child":[]}, 	
{"id":13,"name": "次日留存","child":[]}, 	
{"id":14,"name": "所有捕鱼游戏玩家数量","child":[]}, 
{"id":15,"name": "银宝箱发放数（总）","child":[16,17]}, 
{"id":16,"name": "银宝箱发放数（不扣贡献度）","child":[]}, 	
{"id":17,"name": "银宝箱发放数（扣贡献度）","child":[]}, 			
{"id":18,"name": "银宝箱发放总价值","child":[]}, 	
{"id":19,"name": "掉落银宝盒人数","child":[]}, 
{"id":20,"name": "金宝箱发放数（总）","child":[21,22]}, 	
{"id":21,"name": "金宝箱发放数（不扣贡献度）","child":[]},	
{"id":22,"name": "金宝箱发放数（扣贡献度）","child":[]}, 	
{"id":23,"name": "金宝箱发放总价值","child":[]}, 	
{"id":24,"name": "掉落金宝盒人数","child":[]}, 	
{"id":25,"name": "捕鱼赢分玩家人数","child":[]}, 	
{"id":26,"name": "捕鱼输分玩家人数","child":[]}, 	
{"id":27,"name": "赢分玩家比例","child":[]}, 	
{"id":28,"name": "输分玩家比例","child":[]}, 	
{"id":29,"name": "总玩分","child":[]}, 	
{"id":30,"name": "总赢分","child":[]}, 	
{"id":31,"name": "抽水","child":[]}, 	
{"id":32,"name": "总净分","child":[]},
{"id":33,"name": "金豆分布所有玩家总和","child":[34,35,36,37,38]}, 	 	
{"id":34,"name": "所有玩家金豆＜1000","child":[]}, 	
{"id":35,"name": "所有玩家金豆1000－5000","child":[]}, 	
{"id":36,"name": "所有玩家金豆5000－20000","child":[]}, 	
{"id":37,"name": "所有玩家金豆20000－50000","child":[]}, 	
{"id":38,"name": "所有玩家金豆50000＋","child":[]},
{"id":39,"name": "炮台分布所有玩家总和","child":[40,41,42,43,44,45]}, 	 		
{"id":40,"name": "所有玩家炮台≤5","child":[]}, 	
{"id":41,"name": "所有玩家炮台5－10","child":[]}, 	
{"id":42,"name": "所有玩家炮台10－15","child":[]}, 	
{"id":43,"name": "所有玩家炮台15－20","child":[]}, 	
{"id":44,"name": "所有玩家炮台20－35","child":[]}, 	
{"id":45,"name": "所有玩家炮台＞35","child":[]},
{"id":46,"name": "金豆分布流失玩家总和","child":[47,48,49,50,51]},
{"id":47,"name": "流失玩家金豆＜1000","child":[]}, 	
{"id":48,"name": "流失玩家金豆1000－5000","child":[]}, 	
{"id":49,"name": "流失玩家金豆5000－20000","child":[]}, 	
{"id":50,"name": "流失玩家金豆20000－50000","child":[]}, 	
{"id":51,"name": "流失玩家金豆50000＋","child":[]},
{"id":52,"name": "炮台分布流失玩家总和","child":[53,54,55,56,57,58]},	
{"id":53,"name": "流失玩家炮台≤5","child":[]}, 	
{"id":54,"name": "流失玩家炮台5－10","child":[]}, 	
{"id":55,"name": "流失玩家炮台10－15","child":[]}, 	
{"id":56,"name": "流失玩家炮台15－20","child":[]}, 	
{"id":57,"name": "流失玩家炮台20－35","child":[]}, 	
{"id":58,"name": "流失玩家炮台＞35","child":[]}];

*/
var headtitlename = [
            {"id":1, "name": "最高人数","child":[]}, 	
{"id":2,"name": "登录数量","child":[]}, 	
{"id":3,"name": "游戏数量","child":[]}, 	
{"id":4,"name": "升级炮台数量","child":[]}, 	
{"id":5,"name": "使用表情玩家数量","child":[]}, 	
{"id":6,"name": "使用技能玩家数量","child":[]}, 	
{"id":7,"name": "昨日今日均游戏数量","child":[]}, 	
{"id":8,"name": "首次游戏数量","child":[]}, 	
{"id":9,"name": "首玩升级炮台数量","child":[]}, 	
{"id":10,"name": "首玩使用表情数量","child":[]}, 	
{"id":11,"name": "首玩使用技能数量","child":[]}, 	
{"id":12,"name": "昨日首玩游戏数量","child":[]}, 	
{"id":13,"name": "次日留存","child":[]}, 	
{"id":14,"name": "所有捕鱼游戏玩家数量","child":[]}, 
{"id":15,"name": "银宝箱发放数（总）","child":[16,17,93,94,101,102]}, 
{"id":16,"name": "银宝箱发放数（不扣贡献度）","child":[]}, 	
{"id":17,"name": "银宝箱发放数（扣贡献度）","child":[]},
{"id":93,"name": "银宝箱发放数（天降鸿福不扣贡献度）","child":[]},
{"id":101,"name": "银宝箱发放数（天降鸿福扣贡献度）","child":[]}, 
{"id":94,"name": "银宝箱发放数（豪华抽奖不扣贡献度）","child":[]},
{"id":102,"name": "银宝箱发放数（豪华抽奖扣贡献度）","child":[]}, 
{"id":18,"name": "银宝箱发放总价值","child":[]}, 	
{"id":19,"name": "掉落银宝盒人数","child":[]}, 
{"id":20,"name": "金宝箱发放数（总）","child":[21,22,95,96,103,104]}, 	
{"id":21,"name": "金宝箱发放数（不扣贡献度）","child":[]},	
{"id":22,"name": "金宝箱发放数（扣贡献度）","child":[]},
{"id":95,"name": "金宝箱发放数（天降鸿福不扣贡献度）","child":[]},
{"id":103,"name": "金宝箱发放数（天降鸿福扣贡献度）","child":[]},
{"id":96,"name": "金宝箱发放数（豪华抽奖不扣贡献度）","child":[]},
{"id":104,"name": "金宝箱发放数（豪华抽奖扣贡献度）","child":[]},
{"id":23,"name": "金宝箱发放总价值","child":[]}, 	
{"id":24,"name": "掉落金宝盒人数","child":[]}, 	
{"id":25,"name": "捕鱼赢分玩家人数","child":[]}, 	
{"id":26,"name": "捕鱼输分玩家人数","child":[]}, 	
{"id":27,"name": "赢分玩家比例","child":[]}, 	
{"id":28,"name": "输分玩家比例","child":[]}, 	
{"id":29,"name": "总玩分","child":[59,61,63,65]},
{"id":59,"name": "房间1","child":[]}, 
{"id":61,"name": "房间2","child":[]}, 
{"id":63,"name": "房间3","child":[]}, 
{"id":65,"name": "房间4","child":[]}, 
{"id":30,"name": "总赢分","child":[60,62,64,66]}, 
{"id":60,"name": "房间1","child":[]}, 
{"id":62,"name": "房间2","child":[]}, 
{"id":64,"name": "房间3","child":[]}, 
{"id":66,"name": "房间4","child":[]}, 
{"id":31,"name": "抽水","child":[]}, 	
{"id":32,"name": "总净分","child":[]},
{"id":69,"name": "平均在线时间","child":[]},
{"id":97,"name": "杀死BOSS数量","child":[70,71,72,73]},
{"id":70,"name": "金鲨之王","child":[]},
{"id":71,"name": "金蟾蜍","child":[]},
{"id":72,"name": "美人鱼","child":[]},
{"id":73,"name": "哪吒三太子","child":[]},
{"id":98,"name": "杀死精英鱼数量","child":[74,75,76,77,78,79,80,81,82,83,84]},
{"id":74,"name": "银鲨","child":[]},
{"id":75,"name": "金鲨","child":[]},
{"id":76,"name": "深海金龙","child":[]},
{"id":77,"name": "金钱龟","child":[]},
{"id":78,"name": "好运宝箱","child":[]},
{"id":79,"name": "算盘","child":[]},
{"id":80,"name": "宝塔","child":[]},
{"id":81,"name": "三组合","child":[]},
{"id":82,"name": "四组合","child":[]},
{"id":83,"name": "五组合","child":[]},
{"id":84,"name": "四菱形组合","child":[]},
{"id":85,"name": "今日掉落钻石总数","child":[]},
{"id":99,"name": "今日使用钻石总数","child":[86,87,88]},
{"id":88,"name": "升级炮台","child":[]},
{"id":86,"name": "冰冻","child":[]},
{"id":87,"name": "瞄准","child":[]},
{"id":89,"name": "今日使用技能总数","child":[90,91,92]},
{"id":90,"name": "冰冻","child":[]},
{"id":91,"name": "瞄准","child":[]},
{"id":100,"name": "今日掉落兑奖券总数","child":[]},
{"id":33,"name": "金豆分布所有玩家总和","child":[34,35,36,37,38]}, 	 	
{"id":34,"name": "所有玩家金豆＜1000","child":[]}, 	
{"id":35,"name": "所有玩家金豆1000－5000","child":[]}, 	
{"id":36,"name": "所有玩家金豆5000－20000","child":[]}, 	
{"id":37,"name": "所有玩家金豆20000－50000","child":[]}, 	
{"id":38,"name": "所有玩家金豆50000＋","child":[]},
{"id":39,"name": "炮台分布所有玩家总和","child":[40,41,42,43,44,45]}, 	 		
{"id":40,"name": "所有玩家炮台≤5","child":[]}, 	
{"id":41,"name": "所有玩家炮台5－10","child":[]}, 	
{"id":42,"name": "所有玩家炮台10－15","child":[]}, 	
{"id":43,"name": "所有玩家炮台15－20","child":[]}, 	
{"id":44,"name": "所有玩家炮台20－35","child":[]}, 	
{"id":45,"name": "所有玩家炮台＞35","child":[]},
{"id":46,"name": "金豆分布流失玩家总和","child":[47,48,49,50,51]},
{"id":47,"name": "流失玩家金豆＜1000","child":[]}, 	
{"id":48,"name": "流失玩家金豆1000－5000","child":[]}, 	
{"id":49,"name": "流失玩家金豆5000－20000","child":[]}, 	
{"id":50,"name": "流失玩家金豆20000－50000","child":[]}, 	
{"id":51,"name": "流失玩家金豆50000＋","child":[]},
{"id":52,"name": "炮台分布流失玩家总和","child":[53,54,55,56,57,58]},	
{"id":53,"name": "流失玩家炮台≤5","child":[]}, 	
{"id":54,"name": "流失玩家炮台5－10","child":[]}, 	
{"id":55,"name": "流失玩家炮台10－15","child":[]}, 	
{"id":56,"name": "流失玩家炮台15－20","child":[]}, 	
{"id":57,"name": "流失玩家炮台20－35","child":[]}, 	
{"id":58,"name": "流失玩家炮台＞35","child":[]}];

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
            
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshunfish8/get_reportgame_data", packet, onsuccess, onerrors);
   
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
