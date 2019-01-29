<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

       <div id="modal-tree-items" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width:450px;margin-top: 100px;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">系统监控</h4>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                                             
                            <div class="space-4"></div>
                            
                            <div class="form-group">
                                
                           <label class="col-sm-3 control-label no-padding-right" for="form-field-x"> 标识 </label>
                                <div class="col-sm-9">
                                    <div class="col-sm-9">
                                    <input type="text" id="form-field-mx" placeholder="升级标识（ddz_general_3010）" class="col-xs-20 col-sm-10" style="width:230px;" />
                                </div>
                                </div>
                            </div>

                            <div class="space-4"></div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-m"> 版本号 </label>
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-my" placeholder="升级触发本号" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;" />
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
        <tr >
              <td class="left" id="myTag${gamename}">${IP}</td>
            <td class="left" id="myTag${gamename}">${modulename}</td>
            <td class="left" >${systemttl}</td>
            <td class="left" >${databasettl}</td>
            <td class="left" >${Redisttl}</td>
            <td class="left">${Dispatchttl}</td>
            <td class="left">2</td>
            <td class="left">2016-05-12 16：58：58</td>

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
                                            <h5><i class="icon-arrow-left"></i>系统监控</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>

                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">


                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">刷新</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                         <!--    <button onclick="javascript:popadd()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">添加</span>
                                                <i class="icon-plus icon-on-right"></i>
                                            </button>  -->

                                          

                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">



                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                             <th class="left" style="width：100px">服务器IP</th>
                                                             <th class="left">监控对象</th>
                                                             <th>响应时间(毫秒)</th>
                                                             <th style="width:350px">数据库响应时间和状态</th>
                                                             <th style="width:350px">Redis响应时间和状态</th>
                                                             <th style="width:350px">dispatch响应时间和状态</th>
                                                             <th>系统监控时间间隔</th>
                                                            <th>zabbix最后汇报时间</th>
                                                          </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“获得数据”从服务器加载数据</div>
                                              
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
        
        var item = new Array();
        item[6]  = "斗地主大厅";
        item[8]  = "掼蛋大厅";
      

        function get_online_data() {
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data'
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                $("#targetbody").html($("#datamodel1").tmpl(datax));
             }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/xitongjiankong/get_proxy_data", packet, onsuccess, onerrors);
        }
        
        
        function updateconfig(gamename,serverip,BindingAddress){
              var ip = serverip;
                  ip = ip.replace(".","_");
                  ip = ip.replace(".","_");
                  ip = ip.replace(".","_");
                  ip = ip.replace(".","_");
                  
                  
                 if (BindingAddress == "not conncted" ){
                      alert("目标服务器没有启动");
                      return
                 }
                  
         
            var ConnectAddress = $("#refid"+gamename+ip).val();
             if ( ConnectAddress.length <10){
                alert("输入的长度不对");
                return
            }
              
             var packet = {
                action: 'get_online_data',
                gamename  : gamename,
                serverip  : serverip,
                BindingAddress:BindingAddress,
                ConnectAddress:ConnectAddress
                
             };
            function onsuccess(data) {
                alert("已经提交，请刷新，看看成功了没")
                     // reflesh();
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
              jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/xitongjiankong/update_proxy_data", packet, onsuccess, onerrors);
        }
        

        function popadd() {
            $('#modal-tree-items').modal('show');
        }

        function reflesh() {
            get_online_data();
        }
        
      /*  
        function  dosave(){
              var packet = {
                action: 'get_online_data',
                Version  : $("#form-field-my").val(),
                Tag  : $("#form-field-mx").val(),
             };
            function onsuccess(data) {
                if(data == "false"){
                    $('#modal-tree-items').modal('hide');
                   alert("数据添加错误"); 
                }else{
                  $('#modal-tree-items').modal('hide');
                  reflesh(); 
                }
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/jsversionex/save_jsversion_data", packet, onsuccess, onerrors); 
                
                
         }
         
         */


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
