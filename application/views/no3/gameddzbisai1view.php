<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>
    <script id="datamodel1" type="text/html" >
        <tr id="model_${id}">
             <td width="160" class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;vertical-align: middle;">
             
             <div class="widget-toolbox padding-8 clearfix" style="background-color: white;border: 0px;">

                    <button class="btn btn-xs smaller btn-success "   onclick="javascript: delete_no1item(${id})" data-toggle="dropdown"  style="height:25px;">
                        删除
                        <i class="icon-remove icon-on-right"></i>
                    </button>
                    <button class="btn btn-xs smaller btn-success "   onclick="javascript: save_data_byid(${id})" data-toggle="dropdown"  style="height:25px;">
                        提交
                        <i class="icon-save icon-on-right"></i>
                    </button>

                </div>
             
             </td>
            <td width="100" class="hidden-480 myclass" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;vertical-align: middle;">${id}</td>
            <td    style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">
                <table id="table_${id}" class="table table-striped table-bordered table-hover" style="width:100%;margin: -1px;">
                    <thead id="targethead">
                        <tr>
                            <th width="100">起始</th>
                            <th width="100">终止</th>
                            <th>内容</th>
                            <th width="160">操作</th>
                        </tr>
                    </thead>
                    <tbody id="targetbody_${id}">
 
                    </tbody>
                     </table>
            </td>
        </tr>
    </script>    
    
    
    <script id="datamodel2" type="text/html" >
        <tr id="model_${id}_${placingFrom}_${placingTo}"  class="classmodel2_${id}">
            <td  class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;vertical-align: middle;">
                 <input id="From_${id}" class="tomodifyheight" type="text" value="${placingFrom}"  style = "width:100%;height:100%;margin: -1px;text-align: center;border: 0px;background-color:transparent;"  />
                
            </td>
            <td    style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;vertical-align: middle;">
                  <input id="To_${id}" class="tomodifyheight" type="text" value="${placingTo}"  style = "width:100%;height:100%;margin: -1px;text-align: center;border: 0px;background-color:transparent;"  />
            </td>
            <td  style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;">
                <table id="table_${id}_${placingFrom}_${placingTo}" class="table table-striped table-bordered table-hover" style="width:100%;margin: -1px;">
                    <thead id="targethead">
                        <tr>
                            <th >类型</th>
                            <th>数值</th>
                            <th width="160">操作</th>
                        </tr>
                    </thead>
                    <tbody id="targetbody_${id}_${placingFrom}_${placingTo}">

                    </tbody>
                </table>
            </td>
            <td  class="hidden-480" style="padding: 0px; border-top-width: 0px; border-bottom-width: 0px;text-align: center;vertical-align: middle;">

                <div class="widget-toolbox padding-8 clearfix" style="background-color: white;border: 0px;">
                    <button onclick="javascript:add_no2item(${id},${placingFrom},${placingTo})" class="btn btn-xs smaller btn-success " style="margin-top:1px;height:25px;">
                        <span class="bigger-110">添加</span>

                        <i class="icon-plus icon-on-right"></i>
                    </button>
                    <button class="btn btn-xs smaller btn-success "   onclick="javascript: delete_no2item(${id},${placingFrom},${placingTo})" data-toggle="dropdown"  style="height:25px;">
                        删除
                        <i class="icon-remove icon-on-right"></i>
                    </button>
                </div>

            </td>

        </tr>
    </script>
    
    
    <script id="datamodel3" type="text/html" >
        <tr id="model_${id}_${placingFrom}_${placingTo}_${itemType}_${itemValue}"  class="TypeValue">
            <td class="hidden-480" style="padding: 0px; text-align: center;">
                <select class="zsh-select form-control myclass_Type_${id}_${placingFrom}_${placingTo}"  id="TypeXX" data-placeholder="Choose a game..."  value="${itemType}"  style="height:100%;width:100%;border: 0px;background-color:transparent;">
                    <option value="0">筹码</option>
                    <option value="1">小喇叭</option>
                    <option value="2">兑换卷</option>
                    <option value="3">补签卡</option>
                    <option value="4">记牌器</option>
                    <option value="5">王者外框</option>
                    <option value="6">财富外框</option>
                    <option value="7">参赛劵</option>
                </select>
                                      
                
              <!--  <input id="id_date_${id}" class="tomodifyheight" type="text" value="${itemType}"  style = "width:100%;height:100%;margin: -1px;text-align: center;border: 0px;background-color:transparent;"  />  -->
            </td>
            <td  style="padding: 0px; text-align: center;">
                <input id="ValueXX" class="tomodifyheight myclass_Value_${id}_${placingFrom}_${placingTo}" type="text" value="${itemValue}"  style = "width:100%;height:100%;margin: -1px;text-align: center;border: 0px;background-color:transparent;"  />
             </td>
            <td  style="padding: 0px; text-align: center;">
                <div class="widget-toolbox padding-8 clearfix"  style="background-color: white;border: 0px;">
                    <button onclick="javascript:add_no3item(${id},${placingFrom},${placingTo},${itemType},${itemValue})" class="btn btn-xs smaller btn-success " style="margin-top:1px;height:25px;">
                        <span class="bigger-110">添加</span>

                        <i class="icon-plus icon-on-right"></i>
                    </button>

                    <button class="btn btn-xs smaller btn-success "   onclick="javascript: delete_no3item(${id},${placingFrom},${placingTo},${itemType},${itemValue})" data-toggle="dropdown"  style="height:25px;">
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
                                            <h5><i class="icon-arrow-left"></i>斗地主比赛场管理 </h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>


                                        <div class="widget-toolbox padding-8 clearfix">
                                            
                                             
                                             <button onclick="javascript:allreflesh()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                             <button onclick="javascript:insert_data()" class="btn btn-xs btn-success " style="margin-top:1px;height:30px;">
                                                <span class="bigger-110">添加</span>

                                                <i class="icon-plus icon-on-right"></i>
                                            </button>
                                            
                                              <button class="btn btn-xs btn-success "   onclick="javascript:save_data()" data-toggle="dropdown" style="margin-top:1px;height:30px;" >
                                                    提交
                                                    <i class="icon-save icon-on-right"></i>
                                                </button>
                                            

                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">


                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
                                                             <th width="160">操作</th>
                                                             <th width="80">奖项ID号</th>
                                                             <th>奖项内容</th>
                                                            
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
        
       var rewardindex = 0;
        
       var placingFromfuck = 0;
       var placingTofuck = 0;
       var itemTypefuck  = 0;
       var itemValuefuck  = 0;
           
        function reset() {
            $("#userid1").val(userid_back);
        }
        
       function  save_data(){
             $(".myclass").each(function(e) {
                var id =$(this).html();
                save_data_byid(id);
             });
        }
       
        function  save_data_byid(id){
             var NO1 = new Array();
              $(".classmodel2_"+id).each(function(e) {
                var From = $(this).find("#From_"+id).val();
                var To   = $(this).find("#To_"+id).val();
                var TypeValue   = $(this).find(".TypeValue");
                  var NO2 = new Array();
                
                TypeValue.each(function(w){
                    var TypeXX =  $(this).find("#TypeXX").val();
                    var ValueXX   = $(this).find("#ValueXX").val();
                     NO2.push({Type:TypeXX,Value:ValueXX});
                 });
                 NO1.push({From:From,To:To,Item: NO2});
              });
              
             var packet = {
                   action: 'get_online_data',
                   id:id,
                   msg: NO1,
                 };
              
               function onsuccess(data) {
                  alert(id+"号配置返回："+data);
               }
               function onerrors(data) {
                // alert(objtostr(data))
              }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/save_gamemessage_data", packet, onsuccess, onerrors);
        }
          
       function   add_no2item(id,placingFrom,placingTo){
             placingFromfuck = placingFromfuck+1;
             placingTofuck = placingTofuck +1;
             itemTypefuck = 1;
             itemValuefuck = itemValuefuck +1;
             $("#targetbody_"+id).append($("#datamodel2").tmpl({id:id,placingFrom:placingFromfuck,placingTo:placingTofuck}));
             $("#targetbody_"+id+"_"+placingFromfuck+"_"+placingTofuck).append($("#datamodel3").tmpl({"id":id,"placingFrom":placingFromfuck,"placingTo":placingTofuck,"itemType":itemTypefuck,"itemValue":itemValuefuck}));
                $(".zsh-select").each(function(e) {
                      var value = $(this).attr("value");
                       $(this).val(value);
                     });
    
    }
       
     
       function add_no3item(id,placingFrom,placingTo,itemType,itemValue){
          itemTypefuck = 1;
          itemValuefuck = itemValuefuck +1;
         $("#targetbody_"+id+"_"+placingFrom+"_"+placingTo).append($("#datamodel3").tmpl({"id":id,"placingFrom":placingFrom,"placingTo":placingTo,"itemType":itemTypefuck,"itemValue":itemValuefuck}));
                $(".zsh-select").each(function(e) {
                      var value = $(this).attr("value");
                       $(this).val(value);
                     });
    
    }
        
        
        function   delete_no1item(id){
               var packet = {
                   action: 'get_online_data',
                   id: id,
                 };
                 function onsuccess(data) {
                   if(data === "true"){
                      $("#model_"+id).remove();
                   }
               }
               function onerrors(data) {
                }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/delete_gamemessage_data", packet, onsuccess, onerrors);
        }
           
        function   delete_no2item(id,placingFrom,placingTo){
             $("#model_"+id+"_"+placingFrom+"_"+placingTo).remove();
        }
  
       function delete_no3item(id,placingFrom,placingTo,itemType,itemValue){
         $("#model_"+id+"_"+placingFrom+"_"+placingTo+"_"+itemType+"_"+itemValue).remove();
        }
       
         function  changegname(key,value){
           current_gamecode = key;
           $("#tipmessage").html("  当前游戏ID："+current_gamecode+",房间ID："+current_roomid);
         }
        
         function  changeroom(key,value){
            current_roomid = key;
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
                // $("#targetbody").append($("#datamodel1").tmpl([{id:1,gameid:  current_gamecode,roomid: current_roomid, inter: 10,msg: "tomodify",}]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai/save_gamemessage_data", packet, onsuccess, onerrors);
       }
        
        function delete_data(id){
             $("#model_"+id).remove();
        }
      
         function insert_data(){
             rewardindex = rewardindex+1;
              var packet = {"id":rewardindex};
             $("#targetbody").append($("#datamodel1").tmpl(packet));
             
             placingFromfuck = placingFromfuck+1;
             placingTofuck = placingTofuck +1;
             itemTypefuck = itemTypefuck +1;
             itemValuefuck = itemValuefuck +1;
             
             $("#targetbody_"+rewardindex).html($("#datamodel2").tmpl({id:rewardindex,placingFrom:placingFromfuck,placingTo:placingTofuck}));
             $("#targetbody_"+rewardindex+"_"+placingFromfuck+"_"+placingTofuck).append($("#datamodel3").tmpl({"id":rewardindex,"placingFrom":placingFromfuck,"placingTo":placingTofuck,"itemType":itemTypefuck,"itemValue":itemValuefuck}));

        }
        
        function allreflesh(){
            $("#targetbody").html("");
            var packet = {
                action: 'get_online_data',
                 gameid:  current_gamecode,
               };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var reward = datax["reward"];
                
                for (var i in reward ){
                  var id = reward[i]["id"];
                  
                  if(rewardindex <id) rewardindex = id;
                  $("#targetbody").append($("#datamodel1").tmpl({id:id}));
                  var no1 = reward[i]["no1"];
                  
                        for (var j in no1 ){
 
                       var placingFrom = no1[j]["placingFrom"];
                       var placingTo = no1[j]["placingTo"];
                       var no3 = no1[j]["no2"];
  
                        if( placingFromfuck < placingFrom) placingFromfuck = placingFrom ;
                        if( placingTofuck < placingTo) placingTofuck = placingTo;
  
                         $("#targetbody_"+id).append($("#datamodel2").tmpl({id:id,placingFrom:placingFrom,placingTo:placingTo}));
                        
                           for (var k in no3 ){
                              var itemType  = no3[k]["itemType"];
                              var itemValue  = no3[k]["itemValue"];
                              if(itemTypefuck < itemType)  itemTypefuck = itemType;
                              if( itemValuefuck < itemValue) itemValuefuck = itemValue;
                               $("#targetbody_"+id+"_"+placingFrom+"_"+placingTo).append($("#datamodel3").tmpl({"id":rewardindex,"placingFrom":placingFrom,"placingTo":placingTo,"itemType":itemType,"itemValue":itemValue}));
                           }
                     }
                 }
 
                    $(".zsh-select").each(function(e) {
                      var value = $(this).attr("value");
                       $(this).val(value);
                     });
               }
            function onerrors(data) {
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai1/get_allgamemessage_data", packet, onsuccess, onerrors);
            
            
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
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/gameddzbisai1/get_gamemessage_data", packet, onsuccess, onerrors);
        }

        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        
    </script>
</body>
</html>
