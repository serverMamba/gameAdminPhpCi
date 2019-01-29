<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        <div id="modal-tree-items" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width:450px;margin-top: 100px;">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <label id="myidx" class="blue bigger" style="font-size: 18px;"></label>：<label id="mytitlex" class="blue bigger" style="font-size: 18px;"></label>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" role="form">

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-y"> 动作： </label>


                                <div id="myaction" class="col-sm-9" style="font-size: 16px"></div>
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

        <script id="tablemode1" type="text/html" >
        <tr>
            <td class="center">
                <label>
                    <input type="checkbox" param="${userip}" class="ace mychooseip" />
                    <span class="lbl"></span>
                </label>
            </td>
            <td >${userip}</td>
            <td>${describecontent}</td>
            <td>${ opertime}</td>
            <td><button onclick="javascript:fong('${userip}', '您真的要解封IP吗？', 'fongip');" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                    <i class="icon-star-half icon-on-left"></i>
                    <span class="bigger-110">恢复</span>
                </button></td>
        </tr>
    </script>



    <script id="tablemode3" type="text/html" >
        <tr>
            <td class="center">
                <label>
                    <input type="checkbox" param="${usermac}" class="ace mychoosemac" />
                    <span class="lbl"></span>
                </label>
            </td>
            <td >${usermac}</td>
            <td>${ describecontent}</td>
            <td>${opertime}</td>
            <td><button onclick="javascript:fong('${usermac}', '您真的要解封MAC吗？', 'fongmac');" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                    <i class="icon-star-half icon-on-left"></i>
                    <span class="bigger-110">恢复</span>
                </button></td>
        </tr>
    </script>

    <script id="tablemode4" type="text/html" >
        <tr>
            <td class="center">
                <label>
                    <input type="checkbox"  param="${userid}" class="ace mychooseid" />
                    <span class="lbl"></span>
                </label>
            </td>
            <td >${userid}</td>
            <td>${describecontent}</td>
            <td>${opertime}</td>
            <td><button onclick="javascript:fong('${userid}', '您真的要解封USERID吗？', 'fongzhanghao');" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                    <i class="icon-star-half icon-on-left"></i>
                    <span class="bigger-110">恢复</span>
                </button></td>
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
                                            <h5><i class="icon-arrow-left"></i>玩家详细信息</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>

                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">
											<input id="black_target" type="text" placeholder="被封IP/MAC/userID" name="black_target" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:130px;"/>
	                                            
                                            <input class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_1"  placeholder="起始时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />

                                            <div class="input-group bootstrap-timepicker" style="float:left;">
                                                <input id="id_time_picker_1" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
                                            </div>

                                            <span class="input-group-addon col-xs-10 col-sm-2" style = "height:30px;width:60px;">
                                                <i class="icon-calendar bigger-110  zshdate1" style="cursor:pointer;"></i>
                                                <i class="icon-time bigger-110 zshtime1" style="cursor:pointer;"></i>
                                            </span>


                                            <input class=" date-picker col-xs-10 col-sm-2" id="id_date_picker_2"  placeholder="终止时间" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />

                                            <div class="input-group bootstrap-timepicker" style="float:left;">
                                                <input id="id_time_picker_2" type="text" class="form-control col-xs-10 col-sm-2" style = "height:30px;width:100px;" />
                                            </div>
								
                                            <span class="input-group-addon col-xs-10 col-sm-2" style = "height:30px;width:60px;">
                                                <i class="icon-calendar bigger-110 zshdate2" style="cursor:pointer;"></i>
                                                <i class="icon-time bigger-110 zshtime2" style="cursor:pointer;"></i>
                                            </span>


                                            <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>
                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">查询</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            <button onclick="javascript:mychoose()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">解封批操作</span>
                                                <i class="icon-heart icon-on-right"></i>
                                            </button>
                                        </div>

										<div class="widget-toolbox padding-8 clearfix">
											<input id="black_alipay_account" type="text" placeholder="恶劣支付宝账号" name="black_target" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:130px;"/>
	                                        <button onclick="javascript:patchfenguser()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">批量踢出相关用户ID</span>
                                                <i class="icon-heart icon-on-right"></i>
                                            </button>
                                            <input id="black_pwd" type="text" placeholder="循环次数" name="black_target" class="col-xs-10 col-sm-2" style="margin-left:5px;height:34px;width:130px;"/>
	                                        <button onclick="javascript:patchfenguser_pwd()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">批量封用户ID-恶劣密码</span>
                                                <i class="icon-heart icon-on-right"></i>
                                            </button>
                                            <span id="show_msg"></span>
										</div>

                                        <div class="widget-body">
                                            <div class="row" >
                                                <div id="tablecontent" class="col-xs-12" style="margin-top:-3px;">
                                                    <div class="widget-box">
                                                        <div class="widget-header header-color-green3">

                                                            <h5 class="bigger lighter">IP黑名单</h5>

                                                        </div>

                                                        <div class="widget-body">
                                                            <div class="widget-main no-padding">


                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead class="thin-border-bottom">
                                                                        <tr>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                批处理
                                                                            </th>
                                                                            <th width="250px">
                                                                                <i class="icon-user"></i>
                                                                                用户IP
                                                                            </th>

                                                                            <th >
                                                                                <i>@</i>
                                                                                内容
                                                                            </th>
                                                                            <th class="hidden-480" width="150px">操作时间</th>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                操作
                                                                            </th>




                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="m1">





                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>    
                                            </div>

                                            <!--                             <div class="row" >
                                                                             <div id="tablecontent" class="col-xs-12" style="margin-top:-3px;">
                                                                                 <div class="widget-box">
                                                                                     <div class="widget-header header-color-green3">
                         
                                                                                         <h5 class="bigger lighter">IP区间黑名单</h5>
                         
                                                                                     </div>
                         
                                                                                     <div class="widget-body">
                                                                                         <div class="widget-main no-padding">
                         
                         
                                                                                             <table class="table table-striped table-bordered table-hover">
                                                                                                 <thead class="thin-border-bottom">
                                                                                                     <tr>
                                                                                                         <th width="100px">
                                                                                                             <i class="icon-user"></i>
                                                                                                             批处理
                                                                                                         </th>
                                                                                                         <th width="250px">
                                                                                                             <i class="icon-user"></i>
                                                                                                             起始IP
                                                                                                         </th>
                         
                                                                                                         <th width="450px">
                                                                                                            <i class="icon-user"></i>
                                                                                                             终止IP
                                                                                                         </th>
                                                                                                         <th class="hidden-480" width="150px">描述</th>
                                                                                                         <th>
                                                                                                             <i class="icon-user"></i>
                                                                                                             操作时间
                                                                                                         </th>
                         
                                                                                                         <th width="100px">
                                                                                                             <i class="icon-user"></i>
                                                                                                             操作
                                                                                                         </th>
                         
                         
                                                                                                     </tr>
                                                                                                 </thead>
                         
                                                                                                 <tbody id="m2">
                         
                         
                         
                         
                         
                                                                                                 </tbody>
                                                                                             </table>
                                                                                         </div>
                                                                                     </div>
                         
                                                                                 </div>
                                                                             </div>    
                                                                         </div>
                         
                                            -->

                                            <div class="row" >
                                                <div id="tablecontent" class="col-xs-12" style="margin-top:-3px;">
                                                    <div class="widget-box">
                                                        <div class="widget-header header-color-green3">

                                                            <h5 class="bigger lighter">MAC黑名单</h5>

                                                        </div>

                                                        <div class="widget-body">
                                                            <div class="widget-main no-padding">


                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead class="thin-border-bottom">
                                                                        <tr>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                批处理
                                                                            </th>
                                                                            <th width="250px">
                                                                                <i class="icon-user"></i>
                                                                                MAC地址
                                                                            </th>

                                                                            <th >
                                                                                <i>@</i>
                                                                                描述
                                                                            </th>
                                                                            <th class="hidden-480" width="150px">操作时间</th>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                操作
                                                                            </th>




                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="m3">





                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>    
                                            </div>


                                            <div class="row" >
                                                <div id="tablecontent" class="col-xs-12" style="margin-top:-3px;">
                                                    <div class="widget-box">
                                                        <div class="widget-header header-color-green3" >

                                                            <h5 class="bigger lighter">用户ID黑名单</h5>

                                                        </div>

                                                        <div class="widget-body">
                                                            <div class="widget-main no-padding">


                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <thead class="thin-border-bottom">
                                                                        <tr>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                批处理
                                                                            </th>
                                                                            <th width="250px">
                                                                                <i class="icon-user"></i>
                                                                                用户ID
                                                                            </th>

                                                                            <th >
                                                                                <i>@</i>
                                                                                描述
                                                                            </th>
                                                                            <th class="hidden-480" width="150px">操作时间</th>
                                                                            <th width="100px">
                                                                                <i class="icon-user"></i>
                                                                                操作
                                                                            </th>




                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="m4">





                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>



                                    </div><!-- /row -->

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



                function fong(id, param1, param2) {
                    $("#myidx").html(id);
                    $("#mytitlex").html(param1);
                    $("#myaction").html(param2);
                    $('#modal-tree-items').modal('show');
                }

                function mychoose() {

                    var arrip = new Array();
                    var arrmac = new Array();
                    var arrid = new Array();

                    $(".mychooseip").each(function() {
                        var param = $(this).attr("param");
                        if (this.checked == true) {
                            arrip.push(param);
                        }

                    });

                    $(".mychoosemac").each(function() {
                        var param = $(this).attr("param");
                        if (this.checked == true) {
                            arrmac.push(param);
                        }
                    });

                    $(".mychooseid").each(function() {
                        var param = $(this).attr("param");
                        if (this.checked == true) {
                            arrid.push(param);
                        }
                    });

                    if ((arrip.length + arrmac.length + arrid.length) == 0){
                        alert("当前数据为空，请选择数据！")
                    }
                    else {
                        var msg = "恢复IP数：" + arrip.length + "个；恢复MAC数：" + arrmac.length + "个；恢复用户ID数：" + arrid.length + "个?";

                        var returnValue = confirm(msg);

                        if (returnValue) {

                            var packet = {
                                action: 'get_online_data',
                                arrip: arrip,
                                arrmac: arrmac,
                                arrid: arrid,
                            };
                            function onsuccess(data) {
                                alert("执行OK！");
                            }
                            function onerrors(data) {
                                 alert("网络错误！");
                                // alert(objtostr(data))
                            }
                            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoblack/save_all_detail_data", packet, onsuccess, onerrors);
                        }
                    }
                }

                function patchfenguser(){
                	var black_alipay_account = $("#black_alipay_account").val();
                	if(!confirm('确定要踢出支付宝号'+black_alipay_account+'相关的所有玩家吗？')){
                    	return;
                    }
					
                    var packet = {
                    		black_alipay_account: black_alipay_account,
                    };
                	function onsuccess(data) {
                        alert("封号"+data+"个");
                    }
                    function onerrors(data) {
                        // alert(objtostr(data))
                    }
                	jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoblack/save_patchfenguser", packet, onsuccess, onerrors);
                }

				function patchfenguser_pwd(){
					var black_pwd = parseInt($("#black_pwd").val());
					if(black_pwd<=0){
						$("#show_msg").html(" over "+new Date());
						return;
					}
					$("#show_msg").html(black_pwd+" start "+new Date());
					black_pwd--;
					$("#black_pwd").val(black_pwd);
					/**
                	if(!confirm('确定要踢出密码'+black_pwd+'相关的所有玩家吗？')){
                    	return;
                    }**/
					
                    var packet = {
                    		black_pwd: black_pwd,
                    };
                	function onsuccess(data) {
                    	if(black_pwd>0){
                    		$("#show_msg").html(black_pwd+" end "+new Date());
                    		setTimeout('patchfenguser_pwd();', 600000);
                    	}
                    	else{
                    		$("#show_msg").html(" over "+new Date());
                    	}
                    }
                    function onerrors(data) {
                        // alert(objtostr(data))
                    }
                	jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoblack/patchfenguser_pwd", packet, onsuccess, onerrors);
				}
                
                function dosave() {
                    var idx = $("#myidx").html();
                    var actionx = $("#myaction").html();

                    var packet = {
                        action: actionx,
                        helpid: idx,
                    };
                    function onsuccess(data) {
                        $('#modal-tree-items').modal('hide');
                    }
                    function onerrors(data) {
                        // alert(objtostr(data))
                    }
                    jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoblack/save_detail_data", packet, onsuccess, onerrors);
                }


                function reset() {
                    $("#userid1").val(userid_back);
                    $("#mac1").val(mac_back);
                }



                function get_online_data() {
                    userid_back = $("#userid1").val();
                    mac_back = $("#mac1").val();
                    var packet = {
                        action: 'get_online_data',
                        black_target:$("#black_target").val(),
                        mystarttime: $("#id_date_picker_1").val() + " " + $("#id_time_picker_1").val(),
                        myendtime: $("#id_date_picker_2").val() + " " + $("#id_time_picker_2").val(),
                    };
                    function onsuccess(data) {
                        var datax = eval("(" + data + ")");

                        $("#m1").html($("#tablemode1").tmpl(datax ["m1"]));
                        //  $("#m2").html($("#tablemode2").tmpl( datax ["m2"]));
                        $("#m3").html($("#tablemode3").tmpl(datax ["m3"]));
                        $("#m4").html($("#tablemode4").tmpl(datax ["m4"]));

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
                         */

                        // allitem[currentcount]["officalgiftinfo1"]= rr;
                        // update_usemsg(datax["usemsg"]);
                        // $("#tablecontent").html($("#tablemodel").tmpl( allitem[currentcount]));

                    }
                    function onerrors(data) {
                        // alert(objtostr(data))
                    }
                    jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoblack/get_detail_data", packet, onsuccess, onerrors);
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


                    $("#id_date_picker_1").val(getdate(-24 * 60 * 60 * 365));
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
