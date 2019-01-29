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
                                                    <option value="0">老板本（0）</option>
                                                    <option value="1">老板本（1）</option>
                                                    <option value="2">Android（2）</option>
                                                    <option value="3">IOS（3）</option>
                                                </select>
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-y"> 分类 </label>


                                <div class="col-sm-9">
                                                    <select class="zsh-select form-control"  id="form-field-select-y" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="15">掼蛋(15)</option>
                                                    <option value="16">麻将(16)</option>
                                                    <option value="17">斗地主(17)</option>
                                                    <option value="18">三张牌(18)</option>
                                                    <option value="19">牛牛(19)</option>
                                                    <option value="20">捕鱼(20)</option>
                                                    <option value="21">德州扑克(21)</option>
                                                </select>
                                </div>
                            </div>
                            <!--
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 主版本号 </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" placeholder="主版本号" class="col-xs-20 col-sm-10" />
                                </div>
                            </div>
                             -->
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
            <td class="center">${hissystype}</td>
            <td class="center">${histype}</td>
   
            <td class="hidden-480">${ game_sub_version}</td>
            <td><label><input name="switch-field-1" id="id${game_sub_version}" param="${game_sub_version}" class="ace ace-switch myallcheck" type="checkbox" ${adwallorder}/><span class="lbl"></span></label></td>


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
                                                    <option value="9999">全部</option>
                                                    <option value="0">老板本（0）</option>
                                                    <option value="1">老板本（1）</option>
                                                    <option value="2">Android（2）</option>
                                                    <option value="3">IOS（3）</option>
                                                </select>
                                            </div>

                                            <div class="widget-toolbar no-border pull-left" style="width:150px;height:32px;margin-left:-25px;">
                                                <select class="zsh-select form-control"  id="form-field-select-4" data-placeholder="Choose a game..." style="height:32px;width:130px;">
                                                    <option value="9999">全部</option>
                                                    <option value="15">掼蛋(15)</option>
                                                    <option value="16">麻将(16)</option>
                                                    <option value="17">斗地主(17)</option>
                                                    <option value="18">三张牌(18)</option>
                                                    <option value="19">牛牛(19)</option>
                                                    <option value="20">捕鱼(20)</option>
                                                    <option value="21">德州扑克(21)</option>
                                                </select>
                                            </div> 
                                          <!--  <input type="text" id="mainversionid"   placeholder="主版本号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>  -->
                                            <input type="text" id="subversionid"   placeholder="版本号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>





                                            <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>
                                            </button>








                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">查询</span>
                                                <i class="icon-search icon-on-right"></i>
                                            </button>

                                            <button onclick="javascript:saveconfig()()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                <span class="bigger-110">提交</span>
                                                <i class="icon-ok icon-on-right"></i>
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
                                                            <th>广告墙状态操作</th>
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

       
        var pte = new Array();
         pte["15"] = "掼蛋(15)";
         pte["16"] = "麻将(16)";
         pte["17"] = "斗地主(17)";
         pte["18"] = "三张牌(18)";
         pte["19"] = "牛牛(19)";
         pte["20"] = "捕鱼(20)";   
         pte["21"] = "德州扑克(21)";    
        
        
        var ptf = new Array();
          ptf["0"] = "老板本（0）";
          ptf["1"] = "老板本（1）";
          ptf["2"] = "Android（2）";
          ptf["3"] = "IOS（3）";




/*
        var gamename1 = new Array();

<?php foreach ($gamelist as $myname => $myid) { ?>
            gamename1["<?php echo $myid ?>"] = "<?php echo $myname ?>";
<?php } ?>
*/

        function reset() {
            $("#userid1").val(userid_back);
        }
        
        var maxid =0;

        function get_online_data() {
            $("#targetbody").html("");
            userid_back = $("#userid1").val();
            var packet = {
                action: 'get_online_data',
               // mainversionid: $("#mainversionid").val(),
                subversionid: $("#subversionid").val(),
                systemid: $("#form-field-select-3").val(),
                gameid: $("#form-field-select-4").val(),
                beginindex: (beginindex - 1) * 20
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                for (var itemx in datax)
                {
                    // alert(datax[itemx]["adwall_code"]+"_"+datax[itemx]["game_root_version"]+"_"+datax[itemx]["game_sub_version"]);
                  //  datax[itemx]["hissystype"] = ptf[datax[itemx]["adwall_code"] + "_" + datax[itemx]["game_root_version"] + "_" + datax[itemx]["game_sub_version"]];
                  //  datax[itemx]["histype"] = pte[datax[itemx]["adwall_code"] + "_" + datax[itemx]["game_root_version"] + "_" + datax[itemx]["game_sub_version"]];
                  
                   datax[itemx]["hissystype"] = ptf[datax[itemx]["game_root_version"] ];
                   datax[itemx]["histype"] = pte[datax[itemx]["gamecode"]];
                    
                    var tmpint = parseInt(datax[itemx]["game_sub_version"]);
                    
                    if(tmpint > maxid ) { maxid = tmpint;}

                    if (datax[itemx]["adwallorder"] == 0)
                        datax[itemx]["adwallorder"] = "checked";
                }
                $("#targetbody").html($("#datamodel1").tmpl(datax));
                
                $("#form-field-m").val(maxid+1);
                
                /*
                 $(".pageitemnum").removeClass("hide");
                 $(".pageitemleft").removeClass("disabled");
                 $(".pageitemright").removeClass("disabled");
                 var datax = eval("(" + data + ")");
                 if(datax["status"]=="1"){
                 alert("userid或帐号至少填一个！");
                 return ;
                 }
                 allcount = datax["count"][0]["count"];
                 
                 $(".pageitemnum").each(function(e) {
                 if (e * 20 < allcount) {
                 $(this).children("a").html(e + parseInt(beginindex / 10) * 10 + 1);
                 } else {
                 $(this).addClass("hide");
                 }
                 })
                 
                 for (var itemx in datax["detail"])
                 {
                 // datax["detail"][itemx]["account"]  = datax["account"];
                 datax["detail"][itemx]["startcouponnum"]  = datax["detail"][itemx]["newcouponnum"] - datax["detail"][itemx]["couponnumadded"];
                 datax["detail"][itemx]["gameid"]  =   gamename1[datax["detail"][itemx]["gamecode"]];
                 }
                 var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                 $("#sample-table-2_info").html(msg);
                 $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
                 */
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castadv/get_castadv_data", packet, onsuccess, onerrors);
        }
        
        
        function dosave(){
            var packet = {
                action: 'get_online_data',
                version: $("#form-field-m").val(),
                status: ($('#switch-field-n').get(0).checked == true)?0:1,
                systemid: $("#form-field-select-x").val(),
                gameid: $("#form-field-select-y").val()
            };
            function onsuccess(data) {
                 // $("#form-field-m").val(maxid+1);
                  $('#modal-tree-items').modal('hide');
                  reflesh();
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castadv/save_castadv_data", packet, onsuccess, onerrors);
        }
        
         function saveconfig(){
            var myconfig = new Array();
             $(".myallcheck").each(function(){ 
               var key = $(this).attr("param");
               var value = this.checked == true ?"0":"1";
               myconfig.push({key:key,value:value});
            }); 
            
            var packet = {
                action: 'get_online_data',
                data : myconfig
               };
            function onsuccess(data) {
               alert(data);
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castadv/save_config_data", packet, onsuccess, onerrors);
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
