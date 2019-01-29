<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

        <div id="modal-tree-items" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width:450px;margin-top: 100px;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">广告墙数据添加</h4>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-x"> 系统 </label>

                                <div class="col-sm-9">
                                    <select class="zsh-select form-control"  id="form-field-select-x" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="1">IOS（1）</option>
                                                    <option value="2">Android（2）</option>
                                                    <option value="3">Windows（3）</option>
                                                    
                                                </select>
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-y"> 分类 </label>

                                <div class="col-sm-9">
                                                    <select class="zsh-select form-control"  id="form-field-select-y" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="0">德州扑克(0)</option>
                                                    <option value="1">牛牛(1)</option>
                                                    <option value="3">三张牌(3)</option>
                                                    <option value="6">斗地主(6)</option>
                                                    <option value="8">掼蛋(8)</option>
                                                    <option value="13">捕鱼(13)</option>
                                                    <option value="14">麻将(14)</option>
                                                    <option value="19">电玩城(19)</option>
                                                 </select>
                                </div>
                            </div>
 
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-m"> 版本号 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-m" placeholder="付版本号" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;" />
                                </div>
                            </div>
                            
                              <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="switch-field-n"> 是否开通 </label>

                                <div class="col-sm-9">
                                    <label style="margin-left: 10px;"><input name="switch-field-n" id="switch-field-n" class="ace ace-switch col-xs-20 col-sm-10" type="checkbox"  checked/><span class="lbl"></span></label>
                                </div>
                            </div>


                        </form>




                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>
                        <button class="btn btn-sm btn-primary" onclick="dosave();"><i class="ace-icon fa fa-check"></i> Save</button>
                    </div>

                </div>
            </div>
        </div>

        <script id="datamodel1" type="text/html" >
        <tr>
            <td class="center">${DeviceTypeN}</td>
            <td class="center">${GameCodeN}</td>
   
            <td class="hidden-480">${Version}</td>
            <td><label><input name="switch-field-${DeviceType}-${GameCode}-${Version}" id="switch-field-${DeviceType}-${GameCode}-${Version}" param="${Version}" class="ace ace-switch myallcheck" type="checkbox" ${StatusN}/><span class="lbl"></span></label></td>
            <td><button onclick="javascript:saveconfig(${DeviceType},${GameCode},${Version})" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">提交</span>
                                                <i class="icon-ok icon-on-right"></i>
                                            </button></td>

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

                <?php $this->load->view('no3/common/nav_left1', $systemconfig, $choose, $menucheck); ?>

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
                                            <h5><i class="icon-arrow-left"></i>广告墙开关</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>

                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">



                                            <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;"  >
                                                <select class="zsh-select form-control"  id="form-field-select-3" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="-1">全部(-1)</option>
                                                     <option value="1">IOS（1）</option>
                                                    <option value="2">Android（2）</option>
                                                    <option value="3">Windows（3）</option>
                                                </select>
                                            </div>

                                            <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;margin-left:-15px;">
                                                <select class="zsh-select form-control"  id="form-field-select-4" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="-1">全部(-1)</option>
                                                     <option value="0">德州扑克(0)</option>
                                                    <option value="1">牛牛(1)</option>
                                                    <option value="3">三张牌(3)</option>
                                                    <option value="6">斗地主(6)</option>
                                                    <option value="8">掼蛋(8)</option>
                                                    <option value="14">麻将(14)</option>
                                                     <option value="19">电玩城(19)</option>
                                                </select>
                                            </div> 
                                          <!--  <input type="text" id="mainversionid"   placeholder="主版本号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>  -->
                                            <input type="text" id="subversionid"   placeholder="版本号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>


                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <span class="bigger-110">查询</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>

                                            


                                            <button onclick="javascript:popadd()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">添加</span>
                                                <i class="icon-plus icon-on-right"></i>
                                            </button>


                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">




                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th>系统</th>
                                                            <th>游戏</th>
                                                          
                                                            <th>版本号</th>
                                                            <th>状态修改</th>
                                                             <th>提交操作</th>
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
        
        
       
        var m_wupin = -1;
        var m_wupinname = "全部(-1)";

        var m_status = -1;
        var m_statusname = "全部(-1)";

        var beginindex = 1;
        var allcount = 0;

         var pte = new Array();
         pte["0"] = "德州扑克(1)";
         pte["1"] = "牛牛(1)";
         pte["3"] = "三张牌(3)";
         pte["6"] = "斗地主(6)";
         pte["8"] = "掼蛋(8)";
         pte["13"] = "捕鱼(13)";
         pte["14"] = "麻将(14)";
         pte["19"] = "电玩城(19)";
     
        
        var ptf = new Array();
          ptf["0"] = "未知（0）";
          ptf["1"] = "IOS（1）";
          ptf["2"] = "Android（2）";
          ptf["3"] = "Windows（3）";

        
        var maxid =0;

        function get_online_data() {
            $("#targetbody").html("");
             var subversionid = $("#subversionid").val();
            if(subversionid.length <1) subversionid = "-1";
              var packet = {
                action: 'get_online_data',
                DeviceType: $("#form-field-select-3").val(),
                GameCode: $("#form-field-select-4").val(),
                Version: subversionid
             };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var AdWallInfos = datax["AdWallInfos"];
                for (var itemx in AdWallInfos)
                {
                 
                   AdWallInfos[itemx]["DeviceTypeN"] = ptf[AdWallInfos[itemx]["DeviceType"] ];
                   AdWallInfos[itemx]["GameCodeN"] = pte[AdWallInfos[itemx]["GameCode"]];
                    
                    var tmpint = parseInt(AdWallInfos[itemx]["Version"]);
                    
                    if(tmpint > maxid ) { maxid = tmpint;}

                    if (AdWallInfos[itemx]["Status"] == 1)
                        AdWallInfos[itemx]["StatusN"] = "checked";
                }
                $("#targetbody").html($("#datamodel1").tmpl(AdWallInfos));
                
                $("#form-field-m").val(maxid+1);
  
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castnewadv/get_castadv_data", packet, onsuccess, onerrors);
        }
        

        function dosave(){
            var packet = {
                action: 'get_online_data',
                Version: $("#form-field-m").val(),
                Status: ($('#switch-field-n').get(0).checked == true)?1:0,
                DeviceType: $("#form-field-select-x").val(),
                GameCode: $("#form-field-select-y").val()
            };

            function onsuccess(data) {
                 // $("#form-field-m").val(maxid+1);
                  $('#modal-tree-items').modal('hide');
                  reflesh();
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castnewadv/save_castadv_data", packet, onsuccess, onerrors);
        }
        
  
         function saveconfig(DeviceType,GameCode,Version){
            var id = "#switch-field-"+DeviceType+"-"+GameCode+"-"+Version;
            var Status = ($(id).get(0).checked == true)?1:0;
             var packet = {
                action: 'get_online_data',
                Version: Version,
                Status: Status ,
                DeviceType: DeviceType,
                GameCode: GameCode
               };
            function onsuccess(data) {
               alert(data);
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castnewadv/update_castadv_data", packet, onsuccess, onerrors);
        }
       
   

        function reflesh() {
             beginindex = 1;
            get_online_data();
        }

        function popadd() {
            $('#modal-tree-items').modal('show');
        }

        reflesh();
        
 
        jQuery(function($) {

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

            $("#form_field_select_3_chosen").attr("style", "width:150px;height:32px;");

            $("#form_field_select_4_chosen").addClass("col-xs-10 col-sm-2");

            $("#form_field_select_4_chosen").attr("style", "width:150px;height:32px;");
   
            $("#form_field_select_x_chosen").addClass("col-xs-10 col-sm-2");

            $("#form_field_select_x_chosen").attr("style", "width:250px;height:32px;");

            $("#form_field_select_y_chosen").addClass("col-xs-10 col-sm-2");

            $("#form_field_select_y_chosen").attr("style", "width:250px;height:32px;");
  
        });

    </script>
</body>
</html>
