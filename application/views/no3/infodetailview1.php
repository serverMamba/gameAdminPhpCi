<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        
        <script id="tablemodel1" type="text/html" >
        <tr>
            <td><input type="checkbox" id="check${id}" name="form-field-checkbox"></td>
            <td class="mynumcongzhi">${id}</td>
            <td >${user_email}</td>
            <td >${nickname}</td>
            <td> ${user_chips}</td>
            <td>${total_buy_chips}</td>
            <td> ${coupon_total_given}</td>
     
            <td >${ip}</td>
            <td > ${mac}</td>
            <td>${onlinetime}</td>
            <td class="hidden-480">${gamenum}</td>

            <td > ${winscore}</td>
            <td>${losescore}</td>

            <td class="hidden-480">${jinfen}</td>
         
            <td>${servicefee}</td>
        </tr>
    </script>   
        
        
        

 <div id="modal-tree-items" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width:450px;margin-top: 100px;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <label id="mytitlex" class="blue bigger" style="font-size: 18px;"></label>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            
                             <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-m"> 动作： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="myaction" placeholder="数值" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;text-indent: 10px;" readonly="true"/>
                                </div>
                            </div>
 
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-m"> 数值： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-mxx" placeholder="数值" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;text-indent: 10px;" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-m"> 描述： </label>

                                <div class="col-sm-9">
                                    <textarea rows="3" cols="20" id="form-field-mxy" placeholder="输入理由" class="col-xs-20 col-sm-10" style="margin-left: 10px;width:230px;" ></textarea>
                                </div>
                            </div>
 
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>
                        <button class="btn btn-sm btn-primary" onclick="dosave();"><i class="ace-icon fa fa-check"></i>执行</button>
                    </div>

                </div>
            </div>
        </div>
        <script id="tablemodel" type="text/html" >

            <div class="widget-box">

                <div class="widget-body">
                    <div class="widget-main no-padding">


    
                        </table>
                    </div>
                </div>
            </div>
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
                                                <h5><i class="icon-arrow-left"></i>玩家详细信息</h5>

                                                <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                        <i class="1 icon-chevron-up bigger-125"></i>
                                                    </a>
                                                </div>

                                            </div>




                                            <div class="widget-toolbox padding-8 clearfix">

                                                 <input type="text" id="accountid1"   placeholder="帐号ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:30px;width:120px;"/>
                                                <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
                                                <input type="text" id="mac1" placeholder="MAC" value="ygrobot_mac_doudizhu_huanle"  class="col-xs-10 col-sm-2" style = "height:30px;width:120px;"/> 
                                                <input type="text" id="ip1" placeholder="IP" class="col-xs-10 col-sm-2" style = "height:30px;width:120px;"/> 
     
                                                <input type="text" id="channel1" placeholder="渠道" class="col-xs-10 col-sm-2" style = "height:30px;width:120px;"/>

                                               



                                                <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                    <i class="icon-star-half icon-on-left"></i>
                                                    <span class="bigger-110">重置</span>
                                                </button>

                                                <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">查询</span>
                                                    <i class="icon-search icon-on-right"></i>
                                                </button>

                                                 <button onclick="javascript:addjindu()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">批添加金豆</span>
                                                    <i class="icon-pencil icon-on-right"></i>
                                                </button>

                                                 <button onclick="javascript:addcoupou()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">批添加兑奖劵</span>
                                                    <i class="icon-pencil icon-on-right"></i>
                                                </button>
                                                
                                                 <button onclick="javascript:modifynickname()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">批修改昵称</span>
                                                    <i class="icon-pencil icon-on-right"></i>
                                                </button>
                               

                                            </div>



                                            <div class="widget-body">

                                                <div class="row" >
                                                    <div id="tablecontent" class="col-xs-12" style="margin-top:-3px;">

                                                                            <table class="table table-striped table-bordered table-hover">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        
                                        批处理
                                    </th>
                                    <th>
                                        <i class="icon-user"></i>
                                        用户ID
                                    </th>
                                    
                                     <th>
                                        <i class="icon-user"></i>
                                        帐号
                                    </th>
                                    
                                     <th>
                                        <i class="icon-user"></i>
                                        昵称
                                    </th>

                                    <th>
                                        金豆数
                                    </th>
                                    <th class="hidden-480">加减筹码数</th>
                                    <th>
                                         总兑奖劵
                                    </th>

                                    <th>
                                        IP
                                    </th>
                                    <th class="hidden-480">MAC</th>
                                    <th>
                                        总在线时间
                                    </th>

                                    <th>
                                        总玩次数
                                    </th>
                                    <th class="hidden-480">总赢分</th>
                                    <th>
                                        总输分
                                    </th>
                                    <th>
                                        总净分
                                    </th>
                                    
                                     <th>
                                        最近一天总净分
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="targetcontent">
                               


                              
                                
                                 
                                
                           
                                
                            </tbody>
                            </table>
                                                        
                                                        
                                                    </div>
                                                </div>    




                                                <div class="row" >
                                                    <div class="col-xs-12" style="margin-top:-3px;">
                                                        <!-- PAGE CONTENT BEGINS -->


                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->  




                                                <div class="widget-main"  style ="padding:0;border: thin solid #307ecc;margin-top:-10px;">



                                                 











                                                    <div class="modal-footer no-margin-top">

                                                        <div class="dataTables_info pull-left" id="sample-table-2_info">点击“查询”从服务器加载数据</div>

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

        <script src="../res/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="../res/js/jquery.ui.touch-punch.min.js"></script>
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

            var userid_back = "";
            var mac_back = "";
            
            var allcount =0;
            var currentcount =0;
            var allitem;
            
            
             function addjindu(){
               $("#mytitlex").html("批修改金豆");
               $("#myaction").val("addjindu");
               $('#modal-tree-items').modal('show');
             }
             function addcoupou(){
               $("#mytitlex").html("批修改兑奖劵");
               $("#myaction").val("addcoupou");
               $('#modal-tree-items').modal('show');
             }
             
            function  modifynickname(){
               $("#mytitlex").html("批修改昵称");
               $("#myaction").val("modifynickname");
               $('#modal-tree-items').modal('show');
             }
            
             function dosave(){
                  var actionx=  $("#myaction").val();
                var valuex=  $("#form-field-mxx").val();
                var discriblex=  $("#form-field-mxy").val();
                
                var items = new Array();
                $(".mynumcongzhi").each(function(e) {
                  var id = $(this).html();
                  var tt =  $("#check"+id).get(0).checked;
                  if(tt){
                    items.push({id: id});
                   }
                 });
                 

                var packet = {
                    action:  actionx,
                    items: items,
                    value: valuex,
                    discrible: discriblex,
                };

                function onsuccess(data) {
                     if(data === "noprivate"){
                        alert("权限不够,这个功能找晓亮帮助完成！");
                    }
                    $('#modal-tree-items').modal('hide');    
                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infodetail1/save_bat_data", packet, onsuccess, onerrors);
 
       
            }
            
            
            function get_block_status(ip,id,mac){
                 var packet = {
                    ip: ip,
                    id: id,
                    mac: mac,
                 };
                function onsuccess(data) {
                      var datax = eval("(" + data + ")");
                      if(datax["m3"]>0) {$("#idquery").html("【已封】");$("#accountquery").html("【已封】");$("#accountquery1").html("解封帐号");} else{$("#idquery").html("【未封】");$("#accountquery").html("【未封】");}
                      if(datax["m2"]>0) {$("#macquery").html("【已封】");$("#macquery1").html("解封MAC");} else{$("#macquery").html("【未封】");}
                      if(datax["m1"]>0) {$("#ipquery").html("【已封】");$("#ipquery1").html("解封IP");} else{$("#ipquery").html("【未封】");}
                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infodetail/get_block_status", packet, onsuccess, onerrors);
            }
            
            function cleartable(){
                 $("#ddz_97_onlinetime").html("");
                 $("#ddz_97_gamenum").html("");
                 $("#ddz_97_winscore").html("");
                 $("#ddz_97_losescore").html("");
                 $("#ddz_97_jinfen").html("");
                 $("#ddz_97_servicefee").html("");
                 $("#ddz_97_realjinfen").html("");
                 $("#ddz_97_lastjinfen").html("");
                 $("#ddz_97_lastgametime").html("");
                 
                 $("#ddz_98_onlinetime").html("");
                 $("#ddz_98_gamenum").html("");
                 $("#ddz_98_winscore").html("");
                 $("#ddz_98_losescore").html("");
                 $("#ddz_98_jinfen").html("");
                 $("#ddz_98_servicefee").html("");
                 $("#ddz_98_realjinfen").html("");
                 $("#ddz_98_lastjinfen").html("");
                 $("#ddz_98_lastgametime").html("");
                 
                 $("#ddz_100_onlinetime").html("");
                 $("#ddz_100_gamenum").html("");
                 $("#ddz_100_winscore").html("");
                 $("#ddz_100_losescore").html("");
                 $("#ddz_100_jinfen").html("");
                 $("#ddz_100_servicefee").html("");
                 $("#ddz_100_realjinfen").html("");
                 $("#ddz_100_lastjinfen").html("");
                 $("#ddz_100_lastgametime").html("");
                 
                 $("#ddz_177_onlinetime").html("");
                 $("#ddz_177_gamenum").html("");
                 $("#ddz_177_winscore").html("");
                 $("#ddz_177_losescore").html("");
                 $("#ddz_177_jinfen").html("");
                 $("#ddz_177_servicefee").html("");
                 $("#ddz_177_realjinfen").html("");
                 $("#ddz_177_lastjinfen").html("");
                 $("#ddz_177_lastgametime").html("");
                 
                 $("#ddz_all_onlinetime").html("");
                 $("#ddz_all_gamenum").html("");
                 $("#ddz_all_winscore").html("");
                 $("#ddz_all_losescore").html("");
                 $("#ddz_all_jinfen").html("");
                 $("#ddz_all_servicefee").html("");
                 $("#ddz_all_realjinfen").html("");
                 $("#ddz_all_lastjinfen").html("");
                 $("#ddz_all_lastgametime").html("");
            }
            
            
            function get_game_status(id){
                 var packet = {
                     id: id,
                 };
                function onsuccess(data) {
                     var datax = eval("(" + data + ")");
                     
                     var ddz_all_onlinetime = 0;
                     var ddz_all_gamenum = 0;
                     var ddz_all_winscore = 0;
                     var ddz_all_losescore = 0;
                     var ddz_all_jinfen = 0;
                     var ddz_all_servicefee = 0;
                     var ddz_all_realjinfen = 0;
                     var ddz_all_lastjinfen = 0;
                     var ddz_all_lastgametime = 0;
                     
                      for (var itemx in datax)
                {
                    var gameid = datax[itemx]["gametype"];
                     switch(gameid){
                        case "97":
                            {
                              $("#ddz_97_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_97_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_97_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_97_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_97_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_97_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_97_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_97_lastjinfen").html("");
                              $("#ddz_97_lastgametime").html(datax[itemx]["lastgametime"]);
                              
                              ddz_all_onlinetime = ddz_all_onlinetime+parseInt(datax[itemx]["onlinetime"]);
                              ddz_all_gamenum = ddz_all_gamenum+parseInt(datax[itemx]["gamenum"]);
                              ddz_all_winscore = ddz_all_winscore+parseInt(datax[itemx]["winscore"]);
                              ddz_all_losescore = ddz_all_losescore+parseInt(datax[itemx]["losescore"]);
                              ddz_all_jinfen = ddz_all_jinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]);
                              ddz_all_servicefee = ddz_all_servicefee+parseInt(datax[itemx]["servicefee"]);
                              ddz_all_realjinfen = ddz_all_realjinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) -parseInt(datax[itemx]["servicefee"]) ;
                              ddz_all_lastjinfen = ddz_all_lastjinfen+0;
                              ddz_all_lastgametime = (ddz_all_lastgametime > datax[itemx]["lastgametime"])?ddz_all_lastgametime:datax[itemx]["lastgametime"];
                     
                            }
                            break;
                        case "98":
                              $("#ddz_98_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_98_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_98_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_98_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_98_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_98_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_98_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_98_lastjinfen").html("");
                              $("#ddz_98_lastgametime").html(datax[itemx]["lastgametime"]);
                              
                              ddz_all_onlinetime = ddz_all_onlinetime+parseInt(datax[itemx]["onlinetime"]);
                              ddz_all_gamenum = ddz_all_gamenum+parseInt(datax[itemx]["gamenum"]);
                              ddz_all_winscore = ddz_all_winscore+parseInt(datax[itemx]["winscore"]);
                              ddz_all_losescore = ddz_all_losescore+parseInt(datax[itemx]["losescore"]);
                              ddz_all_jinfen = ddz_all_jinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]);
                              ddz_all_servicefee = ddz_all_servicefee+parseInt(datax[itemx]["servicefee"]);
                              ddz_all_realjinfen = ddz_all_realjinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) -parseInt(datax[itemx]["servicefee"]) ;
                              ddz_all_lastjinfen = ddz_all_lastjinfen+0;
                              ddz_all_lastgametime = (ddz_all_lastgametime > datax[itemx]["lastgametime"])?ddz_all_lastgametime:datax[itemx]["lastgametime"];
                            break;
                        case "100":
                              $("#ddz_100_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_100_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_100_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_100_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_100_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_100_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_100_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]));
                              $("#ddz_100_lastjinfen").html("");
                              $("#ddz_100_lastgametime").html(datax[itemx]["lastgametime"]);
                              
                              ddz_all_onlinetime = ddz_all_onlinetime+parseInt(datax[itemx]["onlinetime"]);
                              ddz_all_gamenum = ddz_all_gamenum+parseInt(datax[itemx]["gamenum"]);
                              ddz_all_winscore = ddz_all_winscore+parseInt(datax[itemx]["winscore"]);
                              ddz_all_losescore = ddz_all_losescore+parseInt(datax[itemx]["losescore"]);
                              ddz_all_jinfen = ddz_all_jinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]);
                              ddz_all_servicefee = ddz_all_servicefee+parseInt(datax[itemx]["servicefee"]);
                              ddz_all_realjinfen = ddz_all_realjinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) -parseInt(datax[itemx]["servicefee"]) ;
                              ddz_all_lastjinfen = ddz_all_lastjinfen+0;
                              ddz_all_lastgametime = (ddz_all_lastgametime > datax[itemx]["lastgametime"])?ddz_all_lastgametime:datax[itemx]["lastgametime"];
                            break;
                        case "177":
                              $("#ddz_177_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_177_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_177_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_177_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_177_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_177_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_177_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_177_lastjinfen").html("");
                              $("#ddz_177_lastgametime").html(datax[itemx]["lastgametime"]);
                              
                              ddz_all_onlinetime = ddz_all_onlinetime+parseInt(datax[itemx]["onlinetime"]);
                              ddz_all_gamenum = ddz_all_gamenum+parseInt(datax[itemx]["gamenum"]);
                              ddz_all_winscore = ddz_all_winscore+parseInt(datax[itemx]["winscore"]);
                              ddz_all_losescore = ddz_all_losescore+parseInt(datax[itemx]["losescore"]);
                              ddz_all_jinfen = ddz_all_jinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]);
                              ddz_all_servicefee = ddz_all_servicefee+parseInt(datax[itemx]["servicefee"]);
                              ddz_all_realjinfen = ddz_all_realjinfen+parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) -parseInt(datax[itemx]["servicefee"]) ;
                              ddz_all_lastjinfen = ddz_all_lastjinfen+0;
                              ddz_all_lastgametime = (ddz_all_lastgametime > datax[itemx]["lastgametime"])?ddz_all_lastgametime:datax[itemx]["lastgametime"];
                            break;
                    }
                  }
                
                $("#ddz_all_onlinetime").html(ddz_all_onlinetime);
                $("#ddz_all_gamenum").html(ddz_all_gamenum);
                $("#ddz_all_winscore").html(ddz_all_winscore);
                $("#ddz_all_losescore").html(ddz_all_losescore);
                $("#ddz_all_jinfen").html(ddz_all_jinfen);
                $("#ddz_all_servicefee").html(ddz_all_servicefee);
                $("#ddz_all_realjinfen").html(ddz_all_realjinfen);
                $("#ddz_all_lastjinfen").html(ddz_all_lastjinfen);
                $("#ddz_all_lastgametime").html(ddz_all_lastgametime);
                
                      
                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infodetail/get_game_status", packet, onsuccess, onerrors);
            }
            
            
            
            
            function proflesh(){
                currentcount = currentcount -1;
                if(currentcount <0 ) currentcount = 0;
                 allitem[currentcount]["allcount"] = allcount;
                 allitem[currentcount]["currentcount"] = currentcount +1;
                 allitem[currentcount]["last_login_time1"] =getdatetime1(allitem[currentcount]["last_login_time"]);
                                  var rr = allitem[currentcount]["officalgiftinfo"];
                    if(rr.length>0){
                      var rx = rr.split(":");
                      rr = getdatetime1( rx[1])+"前，"+rx[0]+"次";
                    }
                    
                    allitem[currentcount]["officalgiftinfo1"]= rr;
                    cleartable();
                    get_game_status(allitem[currentcount]["id"]);
                     get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"]);
                 $("#tablecontent").html($("#tablemodel").tmpl( allitem[currentcount]));
            }
            function currflesh(){
                 allitem[currentcount]["allcount"] = allcount;
                 allitem[currentcount]["currentcount"] = currentcount +1;
                 allitem[currentcount]["last_login_time1"] =getdatetime1(allitem[currentcount]["last_login_time"]);
                 var rr = allitem[currentcount]["officalgiftinfo"];
                    if(rr.length>0){
                      var rx = rr.split(":");
                      rr = getdatetime1( rx[1])+"前，"+rx[0]+"次";
                    }
                    
                    allitem[currentcount]["officalgiftinfo1"]= rr;
                    cleartable();
                    get_game_status(allitem[currentcount]["id"]);
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"]);
               $("#tablecontent").html($("#tablemodel").tmpl( allitem[currentcount]));  
            }
            function nextflesh(){
                currentcount = currentcount+1;
                if(currentcount > allcount ) currentcount = 0;
                 allitem[currentcount]["allcount"] = allcount;
                 allitem[currentcount]["currentcount"] = currentcount +1;
                 allitem[currentcount]["last_login_time1"] =getdatetime1(allitem[currentcount]["last_login_time"]);
                 var rr = allitem[currentcount]["officalgiftinfo"];
                    if(rr.length>0){
                      var rx = rr.split(":");
                      rr = getdatetime1( rx[1])+"前，"+rx[0]+"次";
                    }
                    
                    allitem[currentcount]["officalgiftinfo1"]= rr;
                    cleartable();
                    get_game_status(allitem[currentcount]["id"]);
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"]);
                $("#tablecontent").html($("#tablemodel").tmpl( allitem[currentcount])); 
            }

            function reset() {
                $("#userid1").val(userid_back);
                $("#mac1").val(mac_back);
            }

            function update_usemsg(usemsg) {
                // alert(objtostr(usemsg));
                $("#ID").html(usemsg["userID"]);
                $("#nickname").html(usemsg["userNick"]);
                // $("#nickname").html(usemsg["userAvatar"]);
                // $("#ID").html(usemsg["userGender"]);
                $("#jd").html(usemsg["userScore"]);
                $("#dhj").html(usemsg["coupon"]);
                $("#jyz").html(usemsg["userExperience"]);
                // $("#ID").html(usemsg["winCount"]);
                $("#account").html(usemsg["userAccount"]);
                // $("#ID").html(usemsg["lostCount"]);
                // $("#ID").html(usemsg["drawCount"]);
                // $("#ID").html(usemsg["gift"]);
                // $("#ID").html(usemsg["speakerCount"]);
                $("#mac").html(usemsg["mac"]);

                $("#level").html(usemsg["vipLevel"]);

                $("#registertime").html(usemsg["registertime"]);

                $("#lastlogintime").html(usemsg["lastlogintime"]);

                $("#ip").html(usemsg["ip"]);

                $("#lastlogintime").html(usemsg["lastlogintime"]);

                var urlimg = "http://face.pokerjoin.com" + usemsg["userAvatar"];

                $("#gerentupian1").attr("href", urlimg);

                $("#gerentupian1").html(urlimg);

                $("#nxdl").html(usemsg["totalcompetitiontimes"]);

                var isblockmsg = usemsg["isblock"] == 0 ? "没封" : "封掉了";

                $("#isblock").html(isblockmsg);

                $("#vip").html(usemsg["viplasteffectivetime"]);




            }

            function get_online_data() {
                userid_back = $("#userid1").val();
                mac_back = $("#mac1").val();
                var packet = {
                    action: 'get_online_data',
                   // mystarttime: $("#id_date_picker_1").val() + " " + $("#id_time_picker_1").val(),
                  //  myendtime: $("#id_date_picker_2").val() + " " + $("#id_time_picker_2").val(),
                    userid: $("#userid1").val(),
                    accountid: $("#accountid1").val(),
                    mac: $("#mac1").val(),
                    ip: $("#ip1").val(),
                    channel: $("#channel1").val(),
                };
                function onsuccess(data) {
                    var datax = eval("(" + data + ")");
                    if (datax["status"] == "1") {
                        alert("userid或帐号至少填一个！");
                        return;
                    }
                    
                      /*
                    allcount = datax.length;
                    currentcount =0;
                    allitem = datax;
                    allitem[currentcount]["allcount"] = allcount;
                    allitem[currentcount]["currentcount"] = currentcount +1;
                    allitem[currentcount]["last_login_time1"] =getdatetime1(allitem[currentcount]["last_login_time"]);
                    
                    var rr = allitem[currentcount]["officalgiftinfo"];
                    if(rr.length>0){
                      var rx = rr.split(":");
                      rr = getdatetime1( rx[1])+"前，"+rx[0]+"次";
                    }
                    
                    allitem[currentcount]["officalgiftinfo1"]= rr;
                    // update_usemsg(datax["usemsg"]);
                     cleartable();
                    get_game_status(allitem[currentcount]["id"]);
                     get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"]);
                     */
                    $("#targetcontent").html($("#tablemodel1").tmpl( datax));

                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infodetail1/get_detail_data", packet, onsuccess, onerrors);
            }

            function changeevent(eventid, eventname) {
                m_eventid = eventid;
                m_eventname = eventname;
                beginindex = 1;
                $("#mycurrentgameid").html(eventname);
                get_online_data();
            }

            //  get_online_data();

            function reflesh() {
                beginindex = 1;
                get_online_data();
            }

            reflesh();
            jQuery(function($) {


                $("#id_date_picker_1").val(getdate(-24 * 60 * 60));
                $("#id_date_picker_2").val(getdate(0));
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


                $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function() {
                    $(this).next().focus();
                });


                $('#id_date_picker_1').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_1").focus();
                });
                $('#id_date_picker_2').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_2").focus();
                });

                $(".zshdate1").bind("click", function() {
                    $("#id_date_picker_1").focus();
                });

                $(".zshdate2").bind("click", function() {
                    $("#id_date_picker_2").focus();
                });


                $('#id_time_picker_1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                }).on(ace.click_event, function() {
                    $("#id_time_picker_1").focus();
                });

                $('#id_time_picker_2').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                }).on(ace.click_event, function() {
                    $("#id_time_picker_2").focus();
                });

                $(".zshtime1").bind("click", function() {
                    $("#id_time_picker_1").focus();
                });

                $(".zshtime2").bind("click", function() {
                    $("#id_time_picker_2").focus();
                });

                $(".zsh-select").chosen({disable_search_threshold: 50});

                $("#form_field_select_3_chosen").addClass("col-xs-10 col-sm-2");

                $("#form_field_select_3_chosen").attr("style", "width:150px;height:32px;");

                $("#form_field_select_4_chosen").addClass("col-xs-10 col-sm-2");

                $("#form_field_select_4_chosen").attr("style", "width:150px;height:32px;");




            });

        </script>



    </body>
</html>
