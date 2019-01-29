<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

        <script id="datamodel1" type="text/html" >
        <tr style="background-color:gainsboro;">
            <td rowspan="13">${channelid}</td>
            <td>渠道名称</td>
            <td>${channelname}</td>
        </tr>

        <tr>
          
             <td>渠道描述</td>
            <td>${channeldiscrible}</td>
        </tr>
        <tr>
            
             <td>游戏名称</td>
            <td>${gamename}</td>
        </tr>
        <tr>
           
            <td>游戏ID</td>
            <td>${gameid}</td>
        </tr>
        <tr>
              <td>下载地址</td>
            <td>${downloadurl}</td>
        </tr>
        <tr>
            <td>游戏版本</td>
            <td>${version}</td>
        </tr>
       <tr>
            <td>版本客户端显示</td>
            <td>${versionstr}</td>
        </tr>
        
        <tr>
            <td>游戏md5</td>
            <td>${md5}</td>
        </tr>
        <tr>
            <td>大小</td>
            <td>${size}</td>
        </tr>
        <tr>
            <td>包名</td>
            <td>${packagename}</td>
        </tr>
        <tr>
            <td>下载版本</td>
            <td>${updateversion}</td>
        </tr>
        <tr>
            <td>下载类型</td>
            <td>${updatetype}</td>
        </tr>
        <tr >
             <td>内容提示</td>
            <td  >${updatecontent}</td>
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
                                            <h5><i class="icon-arrow-left"></i>斗地主升级策略管理 </h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                         </div>

                                        <div class="widget-toolbox padding-8 clearfix">
                                            
  
                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                             <button onclick="javascript:insert_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">发布</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            

                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
                                                             <th>渠道ID</th>
                                                             <th>项目名称</th>
                                                             <th class="center">渠道描述</th>
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
        
        function  modify_message(id,gameid,roomid){
           var msgx  = $("#id_msg_"+id).val();
           var interx  = $("#id_inter_"+id).val();
           
           if(parseInt(interx)<=0){
                alert("时间间隔必须大于1");
               return ;
           }
           
           var packet = {
                action: 'get_online_data',
                id :id,
                gameid: gameid,
                roomid: roomid,
                inter: interx ,
                msg: msgx,
               };
              
            function onsuccess(data) {
                alert(data);
                // $("#targetbody").append($("#datamodel1").tmpl([{id:1,gameid:  current_gamecode,roomid: current_roomid, inter: 10,msg: "tomodify",}]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzupload/save_gamemessage_data", packet, onsuccess, onerrors);
       }
        
          
        function insert_data(){
         $.post(window.location.protocol + "//" + window.location.host + "/no3/gameddzupload/insert_gamemessage_data",{"action":"1","do":"1"},
         function(data){
           alert(data);
          });
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
                 $("#targetbody").html($("#datamodel1").tmpl(datax));
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzupload/get_gamemessage_data", packet, onsuccess, onerrors);
        }

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        
    </script>
</body>
</html>
