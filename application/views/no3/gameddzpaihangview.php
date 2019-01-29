<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

    <script id="datamodel1" type="text/html" >
        <tr id="model_id_${msgID}">
            <td >${type}</td>
             <td   class="center">${from}</td>
            <td   class="center">${to}</td>
            <td   class="center">${Chip}</td>
            <td   class="center">${Speaker}</td>
            <td   class="center">${Coupon}</td>
            <td   class="center">${SignCard}</td>
            <td   class="center">${NoteCardDevice}</td>
            <td   class="center">${KingFrameLevel}</td>
            <td   class="center">${WealthFrameLevel}</td>
            <td   class="center">${CanSaiQuan}</td>
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
                                            <h5><i class="icon-arrow-left"></i>斗地主排行建立策略管理 <i id="tipmessage" style="color: green;"> </></h5>
                                            
                                            

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>


                                        <div class="widget-toolbox padding-8 clearfix">
 
                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">刷新</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                            
                                             <button onclick="javascript:insert_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">写入国内中间层</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            
                                             <button onclick="javascript:insert_datataiguo()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">写入泰国中间层</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            

                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th>类别</th>
                                                            <th>排名起始</th>
                                                            <th>排名终止</th>
                                                            <th   class="center">Chip</th>
                                                            <th   class="center">Speaker</th>
                                                            <th   class="center">Coupon</th>
                                                            <th   class="center">SignCard</th>
                                                            <th   class="center">NoteCardDevice</th>
                                                            <th   class="center">KingFrameLevel</th>
                                                            <th   class="center">WealthFrameLevel</th>
                                                            <th   class="center">CanSaiQuan</td>


                                                        </tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“ 保存”，将配置保存到服务器上。</div>

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
        
        var current_gamecode = 0;
        var current_roomid = 0;
           
        function reset() {
            $("#userid1").val(userid_back);
        }
        
        
        function insert_data(){
            var packet = {
                action: 'get_online_data',
                gameid:  current_gamecode,
                roomid: current_roomid,
                inter: 10,
                msg: "tomodify",
               };
            function onsuccess(data) {
                 alert(data);
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzpaihang/insert_gamemessage_data", packet, onsuccess, onerrors);
        }
        
         function insert_datataiguo(){
            var packet = {
                action: 'get_online_data',
                gameid:  current_gamecode,
                roomid: current_roomid,
                inter: 10,
                msg: "tomodify",
               };
            function onsuccess(data) {
                 alert(data);
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzpaihang/insert_gamemessage_datataiguo", packet, onsuccess, onerrors);
        }
        
        
        function get_online_data() {
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data',
                 gameid:  current_gamecode,
                 roomid: current_roomid,
             };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var items =  new Array();
                for(var key in datax)
               {
                   for(var key1 in datax[key]){
                             items.push({"type":key,
                                  "from":datax[key][key1]["from"],
                                  "to":datax[key][key1]["to"],
                                  "Chip" :datax[key][key1]["Chip"],
                                  "Speaker":datax[key][key1]["Speaker"],
                                  "Coupon":datax[key][key1]["Coupon"],
                                  "SignCard" :datax[key][key1]["SignCard"],
                                  "NoteCardDevice" :datax[key][key1]["NoteCardDevice"],
                                  "KingFrameLevel" :datax[key][key1]["KingFrameLevel"],
                                  "WealthFrameLevel":datax[key][key1]["WealthFrameLevel"],
                                  "CanSaiQuan" :datax[key][key1]["CanSaiQuan"],
                                
                                
                             });
                        }
            }
                
               // items.push({"type":"111","name":"222","jindu":"333","coupon":"444","speaker":"555","buqianka":"666","jipaiqi":"777"});
                
                 $("#targetbody").html($("#datamodel1").tmpl(items));
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzpaihang/get_gamemessage_data", packet, onsuccess, onerrors);
        }

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        
    </script>
</body>
</html>
