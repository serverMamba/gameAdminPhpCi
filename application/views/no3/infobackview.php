<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
        
        
        
        
      <script id="datamodel2" type="text/html" >
        <tr>
            <td class="center">${ytime}</td>
            <td width="360">${qmsg}</td>
            <td style="padding: 0px;margin: 0px;">   <input id="id_date_${id}" class="tomodifyheight" type="text" value=" ${answer}"  style = "width:100%;height:100%;margin: -1px;"  /> </td>
            <td width="120"> <button onclick="javascript:modifyas('${id}','${userid}')" class="btn btn-xs btn-success " >
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-60">回复</span>
                                            </button></td>
        </tr>
   
    </script>  
        
        
        
        
        
        
        
        
        
        
        

    <script id="datamodel1" type="text/html" >
        <tr>
            <td class="center">${tt}</td>
            <td>${userid}</td>
            <td>${cc}</td>
            <td>${qmsg}</td>
            <td>${answer}</td>
            <td width="120"> <button onclick="javascript:setdisplay('${userid}')" class="btn btn-xs btn-success " >
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-60">开/关</span>
                                            </button></td>
        </tr>
         <tr id="myid${userid}" style="display: none;">
            <td class="center">${userid}</td>
            <td id="subid${userid}" colspan="5" style="height:100px;padding: 0px;">
                
                 <table id="sample-table-2" class="table table-striped table-bordered table-hover" style="margin: 0;">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th width="180"><i class="icon-time bigger-110 hidden-480"></i>提交时间</th>
                                                           

                                                            <th>问</th>
                                                            <th >答</th>
                                                            <th width="120">操作</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="targetbodyx${userid}">

                                                    </tbody>
                                                </table>
                
                
            </td>
          
          
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
                                            <h5><i class="icon-arrow-left"></i>玩家反馈建议</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
 
                                        </div>




                                        <div class="widget-toolbox padding-8 clearfix">
                                            
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
                                              
                                      
                                             <button onclick="javascript:reset()" class="btn btn-xs btn-success " style="margin-top:3px;margin-left:10px;">
                                                <i class="icon-star-half icon-on-left"></i>
                                                <span class="bigger-110">重置</span>
                                            </button>

                                            <button onclick="javascript:reflesh()" class="btn btn-xs btn-success " style="margin-top:3px;">
                                                <span class="bigger-110">查询</span>

                                                <i class="icon-search icon-on-right"></i>
                                            </button>
                                        </div>

                                        <div class="widget-body">

                                            <div class="widget-main"  style ="padding:0;">




                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                        <tr>
                                                            <th width="180"><i class="icon-time bigger-110 hidden-480"></i>提交时间</th>
                                                            <th>帐号</th>
                                                            <th width="64">次数</th>

                                                            <th>最后的提问</th>
                                                            <th width="320">提问回答</th>
                                                            <th>操作</th>
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
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <!-- ace scripts -->

    <script src="../res/js/jquery.dataTables.min.js"></script>
    <script src="../res/js/jquery.dataTables.bootstrap.js"></script>

    <script src="../res/js/ace-elements.min.js"></script>
    <script src="../res/js/ace.min.js"></script>
    <script src="../res/js/jspacket.js"></script>

    <!-- inline scripts related to this page -->

    <script type="text/javascript">

        var m_statusid = 999;
        var m_statusname = "全部(999)";
        
        var m_gameid = 0;
        var m_gamename = "全部(0)";

        var beginindex = 1;
        var allcount = 0;

        var producttype = new Array();
       
        producttype["0201"] = "筹码(0201)";
        producttype["0202"] = "小喇叭(0202)";
        producttype["0204"] = "vip卡(0204";
        producttype["0208"] = "标志(0208)";
        
        
       function modifyas(id,userid){
         var data =  $.trim($("#id_date_"+id).val());
         if(data.length === 0){
             alert("文字不能为空，请输入！");
             return;
         }
           var packet = {
                action: 'get_online_data',
                id:id,
                userid: userid,
                data: data,
              };
            function onsuccess(data) {
                    alert("存储OK!");
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoback/save_single_data", packet, onsuccess, onerrors);
       }
        
        
           function get_single_data(userid) {
            var packet = {
                action: 'get_online_data',
                userid: userid,
    
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                 $("#targetbodyx"+userid).html($("#datamodel2").tmpl(datax));
                 
                 $(".tomodifyheight").each(function(key, val) {      
      　            
                    $(this).css("height",$(this).parent().css("height"));
                  
 　　             });   
                 
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoback/get_single_data", packet, onsuccess, onerrors);
        } 
        
        
       function  setdisplay(userid){
           if( $("#myid"+userid).attr("style").length === 0){
              $("#myid"+userid).attr("style","display:none"); 
           }else{
              $("#myid"+userid).attr("style",""); 
              get_single_data(userid);
           }
         }
        
        
         var gamelistx = new Array();
         <?php foreach ($gamelist as $myid => $myname) { ?>
             gamelistx["<?php echo $myid ?>"] = "<?php echo $myname ?>";
        <?php } ?>
       
        var paylistx = new Array();
        <?php foreach ($paylist as $myid => $myname) { ?>
            paylistx["<?php echo $myid ?>"] = "<?php echo $myname["name"] ?>";
        <?php } ?>
        
        var ordertype = new Array();
        ordertype[0] = "Х";
        ordertype[1] = "√";

        var mystarttime_back = "";
        var myendtime_back = "";
        var userid_back = "";
        var account_back = "";

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
            $("#userid1").val(userid_back);
            $("#account1").val(account_back);
        }

        function get_online_data() {
            $("#targetbody").html("");
            mystarttime_back = $("#mystarttime").val();
            myendtime_back = $("#myendtime").val();
            userid_back = $("#userid1").val();
            account_back = $("#account1").val();
            var packet = {
                action: 'get_online_data',
                mystarttime: $("#mystarttime").val(),
                myendtime: $("#myendtime").val(),
                userid: $("#userid1").val(),
                account: $("#account1").val(),
                beginindex: (beginindex - 1) * 20,
                gameid: m_gameid,
                statusid: m_statusid,
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
                   datax["detail"][itemx]["producttype"]  = producttype[datax["detail"][itemx]["producttype"]];
                   datax["detail"][itemx]["gameid"]       = gamelistx[datax["detail"][itemx]["gameid"]];
                   datax["detail"][itemx]["paytype"]      = paylistx[datax["detail"][itemx]["paytype"]];
                   datax["detail"][itemx]["callbackstatus"]      = ordertype[datax["detail"][itemx]["callbackstatus"]];
                }
                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
            }
            function onerrors(data) {
                // alert(objtostr(data))
            }
            jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infoback/get_back_data", packet, onsuccess, onerrors);
        }

        function changegame(gameid, gamename) {
            m_gameid = gameid;
            m_gamename = gamename;
            beginindex = 1;
            $("#mygameid").html(gamename);
            get_online_data();
        }
        
         function changestatus(statusid, statusname) {
            m_statusid = statusid;
            m_statusname = statusname;
            beginindex = 1;
            $("#mystatusid").html(statusname);
            get_online_data();
        }


        function reflesh() {
            beginindex = 1;
            get_online_data();
        }

        reflesh();
        jQuery(function($) {
            
            
            
               $('#id_date_picker_1').datepicker({autoclose:true}).on(ace.click_event, function(){
		$("#id_date_picker_1").focus();
				});
            $('#id_date_picker_2').datepicker({autoclose:true}).on(ace.click_event, function(){
		$("#id_date_picker_2").focus();
				});
                                
            $(".zshdate1").bind("click",function(){
               $("#id_date_picker_1").focus();
            });
              
            $(".zshdate2").bind("click",function(){
              $("#id_date_picker_2").focus();
            });
                                
                                  
            $('#id_time_picker_1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).on(ace.click_event, function(){
					$("#id_time_picker_1").focus();
  				});
                                
             $('#id_time_picker_2').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).on(ace.click_event, function(){
					$("#id_time_picker_2").focus();
				});  
                                
            $(".zshtime1").bind("click",function(){
              $("#id_time_picker_1").focus();
            });
              
            $(".zshtime2").bind("click",function(){
              $("#id_time_picker_2").focus();
            });
           
            
            
            
              $("#id_date_picker_1").val(getdate(-24*60*60*30));
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
        });

    </script>
</body>
</html>
