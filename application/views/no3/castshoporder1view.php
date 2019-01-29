<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
 <body>

<script id="datamodel1" type="text/html" >
    <tr>
        <td>${id}</td>
        <td>${orderid}</td>
        <td ><i class="icon-time bigger-110 hidden-480"></i>${submittime}</td>
       
        <td class="hidden-480">${ mobile}</td>
        <td>${userid}</td>


        <td>${huafei}</td>
        <td>${huafeiquan}</td>
        <td>${submitresult}</td>
        <td>${queryresult}--${status}</td>
 
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
                                        <h5><i class="icon-arrow-left"></i>实物订单管理</h5>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="1 icon-chevron-up bigger-125"></i>
                                            </a>
                                        </div>

                                    </div>




                                    <div class="widget-toolbox padding-8 clearfix">
                                         <input type="text" id="orderid"   placeholder="订单号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
                                         <input type="text" id="phoneid"   placeholder="手机号"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
                         

                                        <input type="text" id="userid"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
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

                                        <button onclick="javascript:getexcel()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                            <span class="bigger-110">导出EXCEL</span>

                                            <i class="icon-envelope icon-on-right"></i>
                                        </button>


                                    </div>

                                    <div class="widget-body">

                                        <div class="widget-main"  style ="padding:0;">





                                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                <thead id="targethead">
                                                    <tr>
                                                         <th>ID号</th>
                                                        <th>订单号</th>
                                                        <th><i class="icon-time bigger-110 hidden-480"></i>订单时间</th>
                                                        
                                                        <th>手机号码</th>
                                                        <th>用户ID</th>
                                                        
                                                        <th class="center">话费数</th>
                             
                                                        <th class="center">一元兑奖劵数</th>
                                                        

                                                        <th>兑换提交状态</th>
                                                        <th>兑换查询状态</th>
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

    var id_date_picker_1 = "";
    var id_time_picker_1 = "";
    var id_date_picker_2 = "";
    var id_time_picker_2 = "";

    var beginindex = 1;
    var allcount = 0;

    var userid_back = "";

    var gamename1 = new Array();
    
    var statuslist  = new Array();
    
    
     statuslist["0000"] = "提交成功";
     statuslist["1001"] = "参数不完整";
     statuslist["1002"] = "手机号不正确";
     statuslist["1003"] = "金额不正确";
     statuslist["1004"] = "用户不存在";
     statuslist["1005"] = "密码不正确";
     statuslist["2001"] = "用户暂停";
     statuslist["1006"] = "IP鉴权失败";
     statuslist["1007"] = "md5key验证不正确";
     statuslist["2002"] = "账户余额异常";
     statuslist["2003"] = "手机号是黑名单";
     statuslist["2004"] = "订单是重复";
     statuslist["2005"] = "余额不足";
     statuslist["2006"] = "该产品未开通";
     statuslist["9999"] = "系统错误";
     
     
     var statuslist1  = new Array();
    
    
     statuslist1["0000"] = "查询成功";
     statuslist1["1001"] = "参数不完整";
     statuslist1["1002"] = "手机号不正确";
     statuslist1["1003"] = "金额不正确";
     statuslist1["1004"] = "用户不存在";
     statuslist1["1005"] = "密码不正确";
     statuslist1["2001"] = "用户暂停";
     statuslist1["1006"] = "IP鉴权失败";
     statuslist1["1007"] = "md5key验证不正确";
     
     statuslist1["9999"] = "系统错误";
     
      var statuslist2  = new Array();
    
    
     statuslist2["1000"] = "订单支付成功";
     statuslist2["1001"] = "订单下单失败";
     statuslist2["1002"] = "订单支付中";
     statuslist2["1003"] = "订单支付失败";
     statuslist2["1004"] = "订单不存在";
   

<?php foreach ($gamelist as $myname => $myid) { ?>
        gamename1["<?php echo $myid ?>"] = "<?php echo $myname ?>";
<?php } ?>


    function reset() {
        $("#id_date_picker_1").val(id_date_picker_1);
        $("#id_time_picker_1").val(id_time_picker_1);
        $("#id_date_picker_2").val(id_date_picker_2);
        $("#id_time_picker_2").val(id_time_picker_2);
        $("#userid1").val(userid_back);
    }

    function commitphone() {
        $('#modal-tree-items').modal('show');
    }

    function get_online_data() {
        id_date_picker_1 = $("#id_date_picker_1").val();
        id_time_picker_1 = $("#id_time_picker_1").val();
        id_date_picker_2 = $("#id_date_picker_2").val();
        id_time_picker_2 = $("#id_time_picker_2").val();
        $("#targetbody").html("");
        userid_back = $("#userid1").val();
        var packet = {
            action: 'get_online_data',
            mystarttime: $("#id_date_picker_1").val() + " " + $("#id_time_picker_1").val(),
            myendtime: $("#id_date_picker_2").val() + " " + $("#id_time_picker_2").val(),
            userid: $("#userid").val(),
            phoneid: $("#phoneid").val(),
            orderid: $("#orderid").val(),
            beginindex: (beginindex - 1) * 20
        };
        function onsuccess(data) {
            var datax = eval("(" + data + ")");
            for (var itemx in datax)
            {
                datax[itemx]["submitresult"]  = statuslist[datax[itemx]["submitresult"]];
                datax[itemx]["queryresult"]  = statuslist1[datax[itemx]["queryresult"]];
                datax[itemx]["status"]  = statuslist2[datax[itemx]["status"]];
            }
            $("#targetbody").html($("#datamodel1").tmpl(datax));
        }
        function onerrors(data) {
            // alert(objtostr(data))
        }
        jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/castshoporder1/get_castshoporder1_data", packet, onsuccess, onerrors);
    }

    function reflesh() {
        beginindex = 1;
        get_online_data();
    }

    function deleteit(it) {
        $("#" + it).remove();
    }


    function getexcel() {

        var param = "castshoporder1/exportData?" +
                "mystarttime=" + $("#id_date_picker_1").val() + " " + $("#id_time_picker_1").val() +
                "&myendtime=" + $("#id_date_picker_2").val() + " " + $("#id_time_picker_2").val() +
                "&userid=" + $("#userid").val() +
                "&phoneid=" + $("#phoneid").val() +
                "&orderid=" + $("#orderid").val();


        var form = $("<form>");
        form.attr("style", "display:none");
        form.attr("target", "");
        form.attr("method", "post");
        form.attr("action", param);
        var input1 = $("<input>");
        input1.attr("type", "hidden");
        input1.attr("name", "exportData");
        input1.attr("value", (new Date()).getMilliseconds());
        $("body").append(form);
        form.append(input1);
        form.submit();
    }

    

    reflesh();
    jQuery(function($) {
        $("#id_date_picker_1").val(getdate(-24 * 60 * 60));
        $("#id_date_picker_2").val(getdate(0));
        $("#id_time_picker_1").val("00:00:0");
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
