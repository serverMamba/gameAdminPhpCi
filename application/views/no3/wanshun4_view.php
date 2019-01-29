<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        <script id="headmodel1" type="text/html" >
        <tr>
             <th>排名</th>
            <th class="center"><i class="icon-time bigger-110 hidden-480"></i>统计日期</th>
           
            <th>玩家ID</th>
            <th>净分</th>
        </tr>
    </script>

    <script id="datamodel1" type="text/html" >
        <tr>
            <th>${no}</th>
            <td class="center">${statistics_date}</td>
            <td class="hidden-480">${userid}</td>
            <td>${winscore}</td>
           
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

                        <!--    <?php $this->load->view('no3/common/nav_top2', $header3); ?>  -->

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 widget-container-span">
                                    <div class="widget-box">
                                        <div class="widget-header header-color-blue2">
                                            <h5><i class="icon-arrow-left"></i>游戏净分排名  <!--游戏选择：<label id="mycurrentgameid">全部（10000）</label>--></h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">
                                            
                                                                
                                             <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;"  >
                                                  <select class="zsh-select form-control"  id="form-field-select-3" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                     <option value="1">周期净分</option>
                                                     <option value="2">日净分</option>
                                                     
                                                  </select>
                                            </div>
                                            
                                           <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;margin-left:-25px;">
                                                  <select class="zsh-select form-control"  id="form-field-select-4" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                     <option value="0">输分排名</option>
                                                     <option value="1">赢分排名</option>
                                                   </select>
                                            </div>
                                            
                                           <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;margin-left:-25px;">
                                                  <select class="zsh-select form-control"  id="form-field-select-5" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                     <option value="97">经典斗地主</option>
                                                     <option value="98">欢乐斗地主</option>
                                                     <option value="101">赖子斗地主</option>
                                                     <option value="145">掼蛋145</option>
                                                     <option value="146">掼蛋146</option>
                                                     <option value="193">捕鱼</option>
                                                     <option value="49">三张牌</option>
                                                     <option value="17">牛牛17</option>
                                                     <option value="18">牛牛18</option>
                                                   </select>
                                            </div>
                                          
                                            <input type="text" id="mydatexx"   placeholder="日期"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
     
                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>


                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">





                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
                                                              <th>排名</th>
             <th class="center"><i class="icon-time bigger-110 hidden-480"></i>统计日期</th>
                       <th>玩家ID</th>
            <th>净分</th>
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
        var m_wupin = 1;
        var m_wupinname = "全部(1)";
        
        var m_status = 1;
        var m_statusname = "全部(1)";
     
        var beginindex = 1;
        var allcount = 0;

        var userid_back = "";
        
        var id_date_picker_1 = "";
        var id_time_picker_1 = "";
        var id_date_picker_2 = "";
        var id_time_picker_2 = "";
       
 
        var producttype1 = new Array();
       
        producttype1[0] = "兑换卡片";
        producttype1[1] = "兑换实物";
        producttype1[2] = "兑换道具";
        
        
        var gamename1 = new Array();
        
         <?php foreach ($gamelist as $myname => $myid) { ?>
             gamename1["<?php echo $myid ?>"] = "<?php echo $myname ?>";
        <?php } ?>
     

        function reset() {
            $("#userid1").val(userid_back);
        }

        function get_online_data() {
            $("#targetbody").html("");
            userid_back = $("#userid1").val();
            var packet = {
                action: 'get_online_data',
                mydate:$("#mydatexx").val(),
                wintype:$("#form-field-select-3").val(),
                iswin:$("#form-field-select-4").val(),
                gametype:$("#form-field-select-5").val(),
                beginindex: 0
             };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                
                var len = datax.length;
                
                for(var item = 0; item < len;item++){
                   datax[item]["no"] = item+1;
                }
                 $("#targetbody").html($("#datamodel1").tmpl(datax));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/wanshun4/get_exchange_data", packet, onsuccess, onerrors);
        }

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        jQuery(function($) {
            
            $("#mydatexx").val(getdate(-60*24*24*2));
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
          
            
            $(".zsh-select").chosen({disable_search_threshold: 50}); 
            
            $("#form_field_select_3_chosen").addClass("col-xs-10 col-sm-2");
            
            $("#form_field_select_3_chosen").attr("style","width:150px;height:32px;");
            
            $("#form_field_select_4_chosen").addClass("col-xs-10 col-sm-2");
            
            $("#form_field_select_4_chosen").attr("style","width:150px;height:32px;");
            
            $("#form_field_select_5_chosen").addClass("col-xs-10 col-sm-2");
            
            $("#form_field_select_5_chosen").attr("style","width:150px;height:32px;");
 
        });

    </script>
</body>
</html>
