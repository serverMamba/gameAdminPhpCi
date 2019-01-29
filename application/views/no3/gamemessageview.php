<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>
    <script id="datamodel1" type="text/html" >
        <tr id="model_id_${msgID}">
            <td width="80" class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${gameid}</td>
            <td  width="80"  style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">${roomID}</td>
          
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;width:60px;text-align: center;">${msgID}</td>
              <td style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;">
                   <input type="text" id="id_msg_${msgID}"   placeholder="消息" value="${textmsg}"  class="col-xs-10 col-sm-2" style = "width: 100%;height:100%;border:0px;margin-top: 10px;"/>
              </td>
            <td class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;width:80px;">
                 <input type="text" id="id_inter_${msgID}"   placeholder="消息" value="${intervalBySeconds}"  class="col-xs-10 col-sm-2" style = "width: 100%;height:100%;border:0px;margin-top: 10px;"/>
             </td>
 
            <td  width="180" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;">
                <div class="widget-toolbox padding-8 clearfix">
                <button class="btn btn-xs smaller btn-success "   onclick="javascript: modify_message(${msgID},${gameid},${roomID})" data-toggle="dropdown"  style="height:25px;">
                    修改
                    <i class="icon-save icon-on-right"></i>
                </button>
                <button class="btn btn-xs smaller btn-success "   onclick="javascript: delete_data(${msgID})" data-toggle="dropdown"  style="height:25px;">
                    删除
                    <i class="icon-remove icon-on-right"></i>
                </button>
                </div>
            </td>
            
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
                                            <h5><i class="icon-arrow-left"></i>游戏内消息管理<i id="tipmessage" style="color:green">  当前游戏ID：0,房间ID：0</i> </h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>


                                        <div class="widget-toolbox padding-8 clearfix">
                                            
                                              <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
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
                                            </div>
                                            
                                            
                                             <div class="widget-toolbar no-border pull-left" style="margin-top:-2px;">

                                                <button class="btn btn-xs bigger btn-success dropdown-toggle" data-toggle="dropdown">
                                                    房间选择
                                                    <i class="icon-chevron-down icon-on-right"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">

                                               
                                                        <li>
                                                            <a href="javascript:changeroom('房间0','0')">房间0</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间1','1')">房间1</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间2','2')">房间2</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间3','3')">房间3</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间4','4')">房间4</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间5','5')">房间5</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间6','6')">房间6</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间7','7')">房间7</a>
                                                        </li>
                                                         <li>
                                                            <a href="javascript:changeroom('房间8','8')">房间8</a>
                                                        </li>


                                                    <li class="divider"></li>


                                                </ul>
                                            </div>
                                            
                                              <button onclick="javascript:allreflesh()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">查询全部</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                             
                                             <button onclick="javascript:get_online_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                             <button onclick="javascript:insert_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">添加</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            
           
                                            

                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
                                                             <th>游戏ID</th>
                                                             <th>房间ID</th>
                                                              <th>消息号</th>
                                                             <th >消息</th>

                                                             <th>时间间隔</th>
                                                            
                                                             <th>操作</th>
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
        
        function  changegame(key,value){
           current_gamecode = key;
           $("#tipmessage").html("  当前游戏ID："+current_gamecode+",房间ID："+current_roomid);
        }
        
         function  changeroom(key,value){
            current_roomid = value;
            $("#tipmessage").html("当前游戏ID："+current_gamecode+",房间ID："+current_roomid);
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
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gamemessagecct/save_gamemessage_data", packet, onsuccess, onerrors);
       }
        
        function delete_data(id){
              var packet = {
                action: 'get_online_data',
                id :id,
               };
             function onsuccess(data) {
                $("#model_id_"+id).remove();
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gamemessagecct/delete_gamemessage_data", packet, onsuccess, onerrors);
          }
        
        function insert_data(){
            var packet = {
                action: 'get_online_data',
                gameid: current_gamecode,
                roomid: current_roomid,
                inter: 10,
                msg:"test",
               };
              
            function onsuccess(data) {
                var packet =  {"gameid":current_gamecode,"roomID":current_roomid,"textmsg":"test","msgID":data,"intervalBySeconds":10};
                 $("#targetbody").append($("#datamodel1").tmpl(packet));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gamemessagecct/insert_gamemessage_data", packet, onsuccess, onerrors);
         }
        
        function allreflesh(){
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data',
                gameid:  current_gamecode,
               };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                $("#targetbody").html($("#datamodel1").tmpl(datax));
            }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gamemessagecct/get_allgamemessage_data", packet, onsuccess, onerrors);
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
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gamemessagecct/get_gamemessage_data", packet, onsuccess, onerrors);
        }

        allreflesh();
        
    </script>
</body>
</html>
