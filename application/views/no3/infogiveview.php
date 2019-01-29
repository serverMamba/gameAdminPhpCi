<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
    <body>
    <script id="headmodel1" type="text/html" >
        <thead id="targethead">
            <tr>
                <th class="center">赠送ID</th>
                <th class="center">赠送额度</th>
                <th class="center">剩余筹码</th>

                <th>接受ID</th>
                <th class="hidden-480">接受额度</th>
                <th>接受筹码</th>
                <th>游戏ID</th>
                <th><i class="icon-time bigger-110 hidden-480"></i>时间</th>
            </tr>
        </thead>
    </script>

    <script id="datamodel1" type="text/html" >
        <tr>
            <td>${userid}</td>
            <td>${userpresentscore}</td>
            <td class="hidden-480">${userleftscore}</td>
            <td>${touserid}</td>
            <td>${touseracceptscore}</td>
            <td>${touserleftscore}</td>
            <td>${gamecode}</td>
            <td>${happentime}</td>
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
                                            <h5><i class="icon-arrow-left"></i>玩家赠送记录报表</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                <div class="widget-toolbox padding-8 clearfix">
                                           
                                     
                                            
                                            
                                            <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:5px;height:32px;width:120px;"/>
                                            <input type="text" id="account1" placeholder="用户帐号"   class="col-xs-10 col-sm-2" style = "height:32px;width:120px;"/> 

                                            <input type="text" id="userid2"   placeholder="接受ID"   class="col-xs-10 col-sm-2" style = "margin-left:10px;height:32px;width:120px;"/>
                                            <input type="text" id="account2" placeholder="接受帐号"   class="col-xs-10 col-sm-2" style = "height:32px;width:120px;"/> 
 
                                             <div class="input-group" style="width:120px;float:left;margin-left:10px;">
                                                <input class="form-control date-picker" id="id_date_picker_1" type="text"  value="<?php echo date('Y-m-d', time()) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                            
                                             <div class="input-group" style="width:120px;float:left;">
                                                <input class="form-control date-picker" id="id_date_picker_2" type="text"  value="<?php echo date('Y-m-d', time()) ?>"  data-date-format="yyyy-mm-dd" />
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>


                                           
                                              

                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:1px;margin-left:10px;height:31px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>


                                            </button>

                                            <button onclick="javascript:reflesh(1)" class="btn btn-xs btn-success " style="margin-top:1px;;height:31px;">
                                                <span class="bigger-110">查询(时间)</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                            
                                                                    
                                            
                                        </div>

                                        
                                        

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">










                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th class="center">赠送ID</th>
                                                            <th class="center">赠送额度</th>
                                                            <th class="center">剩余筹码</th>
                                                           
                                                            <th>接受ID</th>
                                                            <th class="hidden-480">接受额度</th>
                                                            <th>接受筹码</th>
                                                            <th>游戏ID</th>
                                                            <th><i class="icon-time bigger-110 hidden-480"></i>时间</th>
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

        var beginindex = 1;
        var allcount = 0;
        var id_date_picker_1 = "";
        var id_date_picker_2 = "";
       
        var userid_back = "";
        var account_back = "";
        var numx= 1;
 
       var items = new Array();
        items[0] = '德州扑克';
        items[1] = '牛牛';
        items[2] = '百家乐';
        items[3] = '三张牌';
        items[4] = '水果机';
        items[5] = '大转轮';
        items[6] = '斗地主';
        items[7] = '梭哈';
        items[8] = '掼蛋';
        items[9] = '21点';
        items[10] = '抢庄牛牛';
        items[11] = '十三张';
        items[12] = "扑鱼OL";
        items[13] = "扑鱼在线";
        items[14] = "二人麻将";
        items[15] = "kLKPY(15)";

        function reset() {
            $("#id_date_picker_1").val(id_date_picker_1);
            $("#id_date_picker_2").val(id_date_picker_2);
            $("#userid1").val(userid_back);
            $("#account1").val(account_back);
        }

        function get_online_data(num) {
            $("#targetbody").html("");
            id_date_picker_1 = $("#id_date_picker_1").val();
            id_date_picker_2 = $("#id_date_picker_2").val();
  
            userid_back = $("#userid1").val();
            account_back = $("#account1").val();
            var packet = {
                action: 'get_online_data',
                mystarttime: $("#id_date_picker_1").val(),
                myendtime:   $("#id_date_picker_2").val(),
                num:num,
                userid: $("#userid1").val(),
                account: $("#account1").val(),
                userid1: $("#userid2").val(),
                account1: $("#account2").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: $("#form-field-select-3").val(),
            };
            function onsuccess(data) {
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
                    datax["detail"][itemx]["touserleftscore"]  =  datax["detail"][itemx]["touserleftscore"] +datax["detail"][itemx]["touseracceptscore"];
                    datax["detail"][itemx]["gamecode"]  =  items[datax["detail"][itemx]["gamecode"]];
                 }
                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("targethead").html($("#headmodel1").html());
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infogive/get_give_data", packet, onsuccess, onerrors);
        }

        function changeevent(gameid, gamename) {
            m_gameid = gameid;
            m_gamename = gamename;
            beginindex = 1;
            $("#mycurrentgameid").html(gamename);
            get_online_data();
        }
        

        function reflesh(num) {
            beginindex = 1;
            numx = num;
            get_online_data(num);
        }

        reflesh(1);
        jQuery(function($) {
            $("#id_date_picker_1").val(getdate(-24*60*60));
            $("#id_date_picker_2").val(getdate(0));
            
            $(".pageitemnum").addClass("hide");
            $(".pageitemleft").addClass("disabled");
            $(".pageitemright").addClass("disabled");
            $(".pageitemnum").bind("click", function() {
                $(".pageitemnum").removeClass("active");
                $(this).addClass("active");
                beginindex = parseInt($(this).children("a").html());
                get_online_data(numx);
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
            
            
            $('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
		$("#id_date_picker_1").focus();
				});
            $('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
		$("#id_date_picker_2").focus();
				});

        });

    </script>
</body>
</html>
