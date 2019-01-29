<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>

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
                                            <h5><i class="icon-arrow-left"></i>js系统打包升级管理，目前操作对象：<i id="gametarget">ddz</i></h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>
                                        

                                        
                                <div class="widget-toolbox padding-8 clearfix">
                                    
                                     <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    升级游戏选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                    <li>
                                                        <a href="javascript:changegame('ddz')">ddz</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:changegame('guandan')">guandan</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:changegame('niuniu')">niuniu</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:changegame('wifiallkey')">wifiallkey</a>
                                                    </li>



                                                </ul>
                                            </div>
                                    
                                    
                                    
                                     <button onclick="javascript:gen('debug')" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;height:31px;">
                                          <i class="icon-pushpin icon-on-left"></i>
                                            <span class="bigger-110">生成测试环境</span>
                                    </button>
                                      <button onclick="javascript:gen('release')" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;height:31px;">
                                          <i class="icon-pushpin icon-on-left"></i>
                                            <span class="bigger-110">生成正式发包环境</span>
                                    </button>
                                    
                                    <button onclick="javascript:reflesh('debug')" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;height:31px;">
                                          <i class="icon-star-half icon-on-left"></i>
                                            <span class="bigger-110">获得生成的参数</span>
                                    </button>
                                    
                                </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th style="text-align: right;font-size:14px;">项目</th>
                                                            <th style="text-align: left;font-size:14px;width:150px;">现在的RES的MD5</th>
                                                            <th style="text-align: left;font-size:14px;width:150px;">现在的SRC的MD5</th>
                                                            <th style="text-align: left;font-size:14px;width:150px;">曾经的版本</th>
                                                            <th style="text-align: left;font-size:14px;">需要发布的版本</th>
                                                            </tr>
                                                    </thead>

                                                    <tbody >
                                                        <tr>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;" >hall版本</td>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;width:150px;" id="hallres">00000000000000000000000000000</td>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;width:150px;" id="hallsrc">00000000000000000000000000000</td>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;width:150px;" id="hallversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="hallversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                            </tr>
                                                           <tr>
                                                            <td style="text-align: right;font-size:14px;">hallstatic版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="hallstaticres">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="hallstaticsrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="hallstaticversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="hallstaticversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                           </tr>
                                                           <tr>
                                                            <td style="text-align: right;font-size:14px;">common版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="commonres">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="commonsrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="commonversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="commonversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                           </tr>
                                                         <tr>
                                                            <td style="text-align: right;font-size:14px;">gccommon版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="gccommonres">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="gccommonsrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="gccommonversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="gccommonversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                        </tr>
                                                           <tr>
                                                            <td style="text-align: right;font-size:14px;">ddz版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="ddzres">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="ddzsrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="ddzversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="ddzversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                           
                                                         </tr>
                                                         <tr>
                                                            <td style="text-align: right;font-size:14px;">guandan版本</td>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;" id="guandanres">00000000000000000000000000000</td>
                                                            <td style="text-align: right;font-size:14px;font-size:14px;" id="guandansrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="guandanversion">00000000</td>
                                                            <td><input type="text"    placeholder="version" id="guandanversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                            
                                                         </tr>
                                                          <tr>
                                                            <td style="text-align: right;font-size:14px;">niuniu版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="niuniures">00000000000000000000000000000</td>
                                                              <td style="text-align: right;font-size:14px;font-size:14px;" id="niuniusrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="niuniuversion">00000000</td>
                                                            <td><input type="text"    placeholder="version" id="niuniuversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                          </tr>
                                                         <tr>
                                                            <td style="text-align: right;font-size:14px;">zhajinhua版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="zhajinhuares">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="zhajinhuasrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="zhajinhuaversion">00000000</td>
                                                            <td><input type="text"    placeholder="version" id="zhajinhuaversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                          </tr>
                                                          <tr>
                                                            <td style="text-align: right;font-size:14px;">fishing版本</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="fishingres">00000000000000000000000000000</td>
                                                              <td style="text-align: right;font-size:14px;font-size:14px;" id="fishingsrc">00000000000000000000000000000</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;" id="fishingversion">00000000</td>
                                                            <td><input type="text"   placeholder="version" id="fishingversionx" value="00000000"  class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:220px;font-size:14px;"/></td>
                                                         </tr>
                                                     <!--    <tr>
                                                            <td style="text-align: right;font-size:14px;">最低版本淘汰开启</td>
                                                             <td style="text-align: right;font-size:14px;font-size:14px;">00000000</td>
                                                            <td><label><input name="switch-field-1" id="myenable" tag="${orderid}"  class="ace ace-switch ace-switch-5 mychoose2" type="checkbox" checked/><span class="lbl"></span></label></td>
                                                         </tr> -->
                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击后此地显示消息 </div>
                                                  
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
        
        var gamename = "ddz";
        
       function changegame(name){
           $("#gametarget").html(name);
           gamename = name;
        }
        
        
       function  gen(mode){
           var postdata={
               "hall":$("#hallversionx").val(),
               "hallstatic":$("#hallstaticversionx").val(),
               "common":$("#commonversionx").val(),
               "gccommon":$("#gccommonversionx").val(),
               "ddz":$("#ddzversionx").val(),
               "guandan":$("#guandanversionx").val(),
               "niuniu":$("#niuniuversionx").val(),
               "zhajinhua":$("#zhajinhuaversionx").val(),
               "fishing":$("#fishingversionx").val(),
           }
           var packet = {
                gamename: gamename,
                mode:mode,
                postdata:postdata
             };
            function onsuccess(data) {
                  alert(data);
             }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/typegame/save_config_data", packet, onsuccess, onerrors);
       }
       
       function reflesh(mode) {
           var packet = {
                gamename: gamename,
                mode:mode
             };
            function onsuccess(data) {
                  var datax = eval("(" + data + ")");
                 for (var itemx in datax)
                {
                   $("#"+itemx).html(datax[itemx]) ;
                    $("#"+itemx).val(datax[itemx]) ;
                }
             }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/typegame/get_config_data", packet, onsuccess, onerrors);
       }


    </script>
</body>
</html>
