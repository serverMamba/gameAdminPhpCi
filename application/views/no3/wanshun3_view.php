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
                                             <h5><i class="icon-arrow-left"></i>模式选择：<label id="mycurrentgameid">金豆分布(0)</label>；</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="widget-toolbox padding-8 clearfix">
                                            
                                               <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    模式选择选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="javascript:changegame('0','金豆分布(0)')">兑奖劵分布(0)</a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a href="javascript:changegame('1','兑奖劵分布(1)')">金豆分布(1)</a>
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



    var m_modeid = 0;
    var m_modename = "兑奖劵分布(0)";

    var mystarttime_back = "";
    var myendtime_back = "";

     
    var arr = {};
    
     function get_tablehead(itemhead){
        var tablehead_tmpl = $.templates( "<th class='widget-header header-color-green' style='height:35px;background-color:green;'><i class='ace-icon fa fa-cog'></i>{{:title}}</th>" );
        return tablehead_tmpl.render(itemhead);
    }

    function get_tablebody(itemhead,itembody){
       var tablehead_tmpl = $.templates( "<td>{{:ids}}</td>" );
       var tablebody_tmpl =$.templates(  "<tr>" +tablehead_tmpl.render(itemhead)+"</tr>");
       return tablebody_tmpl.render(itembody);
    }
        
    function changegame(channelid, channelname) {
        
        m_modeid = channelid;
        m_modename = channelname;
        $("#mycurrentgameid").html(channelname);
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
                modeid:m_modeid,
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
                   
                   var rangestr =  datax[index]["mincoupon"]+" 至 "+datax[index]["maxcoupon"];
                   
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
                         itemsub["id0"] = row1[yy];
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
        jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshun3/get_reporttotal_data", packet, onsuccess, onerrors);
       
     }
  

    </script>
</body>
</html>
