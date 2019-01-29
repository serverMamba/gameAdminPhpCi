<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
	<!--
        <script id="headmodel_p" type="text/html" >
        <tr>
            <th class="center blue header-color-green" style="cursor: pointer;" onclick="javascript:backfather()" colspan="6" >${time}</th>

        </tr>
        <tr>
            <th class="center blue">科目</th>
            {{each titles_p}}
            <th class="center blue">${no}</th>
            {{/each}}
        </tr>
    </script>
    

    <script id="datamodel_p" type="text/html" >
        {{each rowtitles_p}}
        <tr>
            <td class="center">${value}</td>

            {{each titles_p}}
            <td class="center" style="padding: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;"><div style="margin-top: 6px;">${getsumdata_p(no,value,key,time)}</div></td>
            {{/each}}
        </tr>
        {{/each}}
    </script>



    <script id="innertable" type="text/html" >
        <table  class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
            <thead >
                <tr>
                    <th class="center blue">科目</th>
                    <th class="center blue">内容</th>
                </tr>
            </thead>

            <tbody>
                {{each titles}}
                <tr>
                    <td class="center">${key}</td>
                    <td class="center">${value}</td>
                </tr>
                {{/each}}
            </tbody>
        </table>
    </script>

    <script id="innertable1" type="text/html" >
        <table  class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;">
            <thead >
                <tr>
                    {{each titles}}
                    <th class="center blue">${key}</th>
                    {{/each}}
                </tr>
            </thead>

            <tbody>
                <tr>
                    {{each titles}}
                    <td class="center">${value}</td>
                    {{/each}}
                </tr>
            </tbody>
        </table>
    </script>

-->

	<script id="headmodel1" type="text/html">
        <tr>
            <th class="center blue  header-color-green">项目</th>
            <th class="center blue  header-color-green"><a href="javascript:void"><i class="icon-double-angle-left choosedataleft"></i></a></th>
            {{each titles}}
            <th  id="mmid${tt}"  status="1"  onclick="javascript:dotimeclick_p('${tt}')" class="center blue header-color-green" style="cursor: pointer;">${tt}</th>
            {{/each}}

            <th class="center blue  header-color-green"> <a href="javascript:void"><i class="icon-double-angle-right choosedataright"></i></a></th>
        </tr>
    </script>


	<script id="datamodel1" type="text/html">
        {{each rowtitles}}
        <tr class="${key}cls">
            <td class="center">${value}</td>
            <td class="center"><a href="javascript:void"><i class="icon-hospital"></i></a></td>
            {{each titles}}
            <td class="center" style="padding: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px;">{{tmpl(0) getsumdata(tt,key)}}</td>
            {{/each}}
            <td class="center"> <a href="javascript:void"><i class="icon-beer"></i></a></td>
        </tr>

        {{/each}}

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
			<a class="menu-toggler" id="menu-toggler" href="#"> <span
				class="menu-text"></span>
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
					<i class="icon-double-angle-left"
						data-icon1="icon-double-angle-left"
						data-icon2="icon-double-angle-right"></i>
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
                	<?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                	<?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>

                    <div class="row">
						<div class="col-xs-12">

							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">
										<div class="widget-header header-color-green2">
											<h5>
												渠道选择：<label id="mycurrentchannelid">All（全部渠道:10000）</label>
											</h5>

											<div class="widget-toolbar">
												<a href="#" data-action="collapse"> <i
													class="1 icon-chevron-up bigger-125"></i>
												</a>
											</div>
										</div>


										<div class="widget-toolbox padding-8 clearfix"></div>

										<div class="widget-toolbar no-border pull-left"
											style="margin-top: -2px;">

											<button class="btn btn-xs bigger btn-success dropdown-toggle"
												data-toggle="dropdown">
												渠道选择 <i class="icon-chevron-down icon-on-right"></i>
											</button>

											<ul
												class="dropdown-menu dropdown-yellow pull-right dropdown-caret dropdown-close">
												<li><a
													href="javascript:changechannel('<?php echo 10000 ?>','<?php echo "All（全部渠道:10000）" ?>')"><?php echo "All（全部渠道:10000）" ?></a>
												</li>
                                                    <?php foreach ($channellist as $channelid => $channelidname) { ?>
                                                        <li><a
													href="javascript:changechannel('<?php echo $channelid ?>','<?php echo $channelidname ?>')"><?php echo $channelidname ?></a>
												</li>
                                                    <?php } ?>


                                                    <li class="divider"></li>


											</ul>

										</div>

										<label class="col-xs-10 col-sm-2"
											style="height: 26px; width: 80px; margin-top: 5px;">开始时间</label>
										<input type="text" id="mystarttime" placeholder="起始时间"
											value="<?php echo date('Y-m-d', time() - 2 * 24 * 60 * 60) ?>"
											class="col-xs-10 col-sm-2"
											style="height: 34px; width: 160px;" /> <label
											class="col-xs-10 col-sm-2"
											style="height: 26px; width: 80px; margin-top: 5px;">结束时间</label>
										<input type="text" id="myendtime" placeholder="终止时间"
											value="<?php echo date('Y-m-d', time()) ?>"
											class="col-xs-10 col-sm-2"
											style="height: 34px; width: 160px;" />



										<ul class="pagination pull-left no-margin "
											style="padding-left: 10px;">
											<li class="timemenu"><a href="javascript:void">今日</a></li>
											<li class="timemenu"><a href="javascript:void">昨日</a></li>
											<li class="timemenu active"><a href="javascript:void">本周</a>
											</li>
											<li class="timemenu"><a href="javascript:void">本月</a></li>
										</ul>

										<button onclick="javascript:reset()"
											class="btn btn-xs btn-success "
											style="margin-top: 3px; margin-left: 10px;">
											<i class="icon-star-half icon-on-left"></i> <span
												class="bigger-110">重置</span>


										</button>

										<button onclick="javascript:reflesh()"
											class="btn btn-xs btn-success " style="margin-top: 3px;">
											<span class="bigger-110">查询</span> <i
												class="icon-search icon-on-right"></i>
										</button>

										<div style="display: none; margin-top: 1px; margin-left: 10px"
											id="forOutterWrapper">
											<input type="checkbox" class="ace ace-checkbox-2"
												id="forOutter" /> <label class="lbl"
												for="ace-settings-navbar">对外数据</label>
										</div>

										<button onclick="javascript:getexcel()"
											class="btn btn-xs btn-success " style="margin-top: 1px;">
											<span class="bigger-110">导出EXCEL</span> <i
												class="icon-envelope icon-on-right"></i>
										</button>
									</div>

									<div class="widget-body">

										<div class="widget-main" style="padding: 0;">



											<table id="sample-table-2"
												class="table table-striped table-bordered table-hover"
												style="margin-bottom: 0px;">
												<thead id="targethead">

												</thead>

												<tbody id="targetbody">

												</tbody>
											</table>
											<div class="modal-footer no-margin-top">

												<div class="dataTables_info pull-left"
													id="sample-table-2_info">单层报表！</div>

											</div>




											<div class="modal-body no-padding"></div>





										</div>


									</div>
								</div>
							</div>



						</div>
						<!-- /row -->

						<div class="hr hr32 hr-dotted"></div>

						<div class="row"></div>

						<div class="hr hr32 hr-dotted"></div>


					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.page-content -->
		</div>
		<!-- /.main-content -->

		<div class="ace-settings-container" id="ace-settings-container">
			<div class="btn btn-app btn-xs btn-warning ace-settings-btn"
				id="ace-settings-btn">
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
					<input type="checkbox" class="ace ace-checkbox-2"
						id="ace-settings-navbar" /> <label class="lbl"
						for="ace-settings-navbar"> Fixed Navbar</label>
				</div>

				<div>
					<input type="checkbox" class="ace ace-checkbox-2"
						id="ace-settings-sidebar" /> <label class="lbl"
						for="ace-settings-sidebar"> Fixed Sidebar</label>
				</div>

				<div>
					<input type="checkbox" class="ace ace-checkbox-2"
						id="ace-settings-breadcrumbs" /> <label class="lbl"
						for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
				</div>

				<div>
					<input type="checkbox" class="ace ace-checkbox-2"
						id="ace-settings-rtl" /> <label class="lbl" for="ace-settings-rtl">
						Right To Left (rtl)</label>
				</div>

				<div>
					<input type="checkbox" class="ace ace-checkbox-2"
						id="ace-settings-add-container" /> <label class="lbl"
						for="ace-settings-add-container"> Inside <b>.container</b>
					</label>
				</div>
			</div>
		</div>
		<!-- /#ace-settings-container -->
	</div>
	<!-- /.main-container-inner -->

	<a href="#" id="btn-scroll-up"
		class="btn-scroll-up btn btn-sm btn-inverse"> <i
		class="icon-double-angle-up icon-only bigger-110"></i>
	</a>
	</div>
	<!-- /.main-container -->

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

        var m_gameid = 0;
        var m_gamename = "<?php echo $initdatastr ?>";
        
        var m_channelid = 10000;
        var m_channelname = "All（全部渠道10000）";

        var mystarttime_back = "";
        var myendtime_back = "";

        var offset = 0;

        function reset() {
            $("#mystarttime").val(mystarttime_back);
            $("#myendtime").val(myendtime_back);
        }

        var headtitle = new Array();

        var rowtitle = <?php echo $this->config->item('report_field');?>;

        var coltitle_p = [{"no": "新手场"}, {"no": "初级场"}, {"no": "中级场"}, {"no": "高级场"}, {"no": "vip场"}];

        var rowdata = new Array();

        function getsumdata(time, key) {
            
            if (rowdata[key+time+m_gameid+m_channelid ] !== undefined)
            {
                var datay = rowdata[key+time+m_gameid+m_channelid ];
                var datax = eval("(" + datay + ")");
                var allcountx = datax["合计"];
                return '<div rawdatay=' + allcountx + ' rawdatax=' + datay + ' style="cursor:pointer;margin-top:3px;" onclick=doclick("' + key + '","' + time + '") id="id' + key + time + '">' + allcountx + '</div>';
            }
            
            var packet = {
                action: 'get_online_data',
                time: time,
                key: key,
                channel:m_channelid,
            };
            function onsuccess(data) {
                var datax = eval("(" + data + ")");
                var allcountx = datax["合计"];
                $("#id" + key + time).attr("rawdatax", data);
                $("#id" + key + time).attr("rawdatay", allcountx);
                $("#id" + key + time).html(allcountx);
            }
            function onerrors(data) {
               $("#id" + key + time).html("error");
            }
            jQuery.comm.sendmessage("<?php echo site_url('no3/reporttotal/get_reporttotal_data');?>", packet, onsuccess, onerrors);
            return '<div  style="cursor:pointer;height:auto;margin-top:6px;" onclick=doclick("' + key + '","' + time + '")  id="id' + key + time + '"><img src="../res/css/select2-spinner.gif"></div>';
        }
        
        /*

        function backfather() {
            reflesh();
        }


        function getsumdata_p(no, value, key, time) {

            if ((rowdata[key] !== undefined) && (rowdata[key][time] !== undefined)) {
                if ((rowdata[key][time]).length > 5) {
                    var datax = eval("(" + rowdata[key][time] + ")");
                    if (datax[no] === undefined) {
                        return "0";
                    }
                    return datax[no];
                } else {
                    return "0";
                }

                return rowdata[key][time];
            }

            return "0";
        }

*/

        function dotimeclick_p(time) {
          //  $("#targethead").html($("#headmodel_p").tmpl({"time": time, "titles_p": coltitle_p}));
           // $("#targetbody").html($("#datamodel_p").tmpl({"time": time, "titles_p": coltitle_p, "rowtitles_p": rowtitle_p}));
        }

        function dotimeclick(time) {
            if ($("#mmid" + time).attr("status") === "1")
            {
                $("#mmid" + time).attr("status", "2");
                for (var itemz in rowtitle) {
                    var key = rowtitle[itemz]["key"];
                    var data = $("#id" + key + time).attr("rawdatax");
                    if (data.length > 10)
                    {
                        var allcountx = $("#id" + key + time).attr("rawdatay");
                        var datax = eval("(" + data + ")");
                        var itemx = new Array();
                        for (var itemy in datax) {
                            itemx.push({key: itemy, value: datax[itemy]});
                        }
                        $("#id" + key + time).html($("#innertable1").tmpl({"titles": itemx}));
                    }
                }
            } else {
                $("#mmid" + time).attr("status", "1");
                for (var itemz in rowtitle) {
                    var key = rowtitle[itemz]["key"];
                    var data = $("#id" + key + time).attr("rawdatax");
                    if (data.length > 10)
                    {
                        var allcountx = $("#id" + key + time).attr("rawdatay");
                        $("#id" + key + time).html(allcountx);
                    }
                }
            }
        }

        function doclick(key, time) {
            /*
            if ($("#id" + key + time).html().length < 20)
            {
                var data = $("#id" + key + time).attr("rawdatax");
                var allcountx = $("#id" + key + time).attr("rawdatay");
                var datax = eval("(" + data + ")");
                var itemx = new Array();
                for (var itemy in datax) {
                    itemx.push({key: itemy, value: datax[itemy]});
                }
                $("#id" + key + time).html($("#innertable").tmpl({"titles": itemx}));
            } else
            {
                var allcountx = $("#id" + key + time).attr("rawdatay");
                $("#id" + key + time).html(allcountx);
            }
            */
        }
        
        function changechannel(channelid, channelname) {
            offset = 0;
            m_channelid = channelid;
            m_channelname = channelname;
            $("#mycurrentchannelid").html(channelname);
            var lstarttime = $("#mystarttime").val();
            var lendtime = $("#myendtime").val();
            // startdata(lstarttime, lendtime);

            // [170310] 只有欲望都市对外的导出数据会不一样
            var needForOutter = [
                    32,
                    277,
                    91006,
                    91007,
                    91009
                    ];
            if (needForOutter.indexOf(parseInt(m_channelid)) >= 0)
            {
                // 显示对外导出选项
                $('#forOutterWrapper').css("display", "inline");
            }
            else
            {
                // 隐藏对外导出选项
                $('#forOutterWrapper').css("display", "none");
            }
        }

        function changegame(gameid, gamename) {
            offset = 0;
            m_gameid = gameid;
            m_gamename = gamename;
            $("#mycurrentgameid").html(gamename);
            var lstarttime = $("#mystarttime").val();
            var lendtime = $("#myendtime").val();
            // startdata(lstarttime, lendtime);
        }

        function reflesh() {
            offset = 0;
            var starttime = $("#mystarttime").val();
            var endtime = $("#myendtime").val();
            startdata(starttime, endtime);
        }

        /**
        * [170310] 导出excel表格
        */
        function getexcel()
        {
            var starttime = $("#mystarttime").val();
            var endtime = $("#myendtime").val();
            var forOutter = $("#forOutter").prop("checked") ? 1 : 0;

			var actionUrl = "<?php echo site_url('no3/reporttotal/exportData');?>" + "?channelId=" + m_channelid + "&forOutter=" + forOutter + "&startDate=" + starttime + "&endDate=" + endtime;

			var form = $("<form>");
			form.attr("style", "display:none");
			form.attr("target", "");
			form.attr("method", "post");
			form.attr("action", actionUrl);
			var input1 = $("<input>");
			input1.attr("type", "hidden");
			input1.attr("name", "exportData");
			input1.attr("value", (new Date()).getMilliseconds());
			$("body").append(form);
        	form.append(input1);
			form.submit();
        }

        function startdata(starttime, endtime) {
            mystarttime_back = starttime;
            myendtime_back = endtime;

            var startticket = gettimeticketfromstr(starttime);
            var endticket = gettimeticketfromstr(endtime);

            if (offset <= startticket)
                offset = startticket;
            if (offset >= (endticket - 24 * 60 * 60 * 6))
                offset = startticket;

            headtitle.length = 0;
            for (var start = offset; start <= endticket; start = start + 24 * 60 * 60)
            {
                var timestr = getdate1(start);
                headtitle.push({"tt": timestr});
                if (headtitle.length >= 7)
                    break;
            }

            $("#targethead").html($("#headmodel1").tmpl({"titles": headtitle}));
            $("#targetbody").html($("#datamodel1").tmpl({"titles": headtitle, "rowtitles": rowtitle}));

            $(".choosedataleft").bind("click", function() {
                offset = offset - 24 * 60 * 60;
                var lstarttime = $("#mystarttime").val();
                var lendtime = $("#myendtime").val();
                startdata(lstarttime, lendtime);
            });
            $(".choosedataright").bind("click", function() {
                offset = offset + 24 * 60 * 60;
                var lstarttime = $("#mystarttime").val();
                var lendtime = $("#myendtime").val();
                startdata(lstarttime, lendtime);
            });
        }

        jQuery(function($) {
            var lstarttime = '<?php echo date('Y-m-d',strtotime('-7 days'));?>';         
            var lendtime = '<?php echo date('Y-m-d',strtotime('-1 day'));?>';
			//alert(lstarttime + ' '+lendtime);
            $("#mystarttime").val(lstarttime);
            $("#myendtime").val(lendtime);
            startdata(lstarttime, lendtime);

            $(".timemenu").bind("click", function() {
                $(".timemenu").removeClass("active");
                $(this).addClass("active");
                var timxx = $(this).children("a").html();
                switch (timxx)
                {
                    case "今日":
                        offset = 0;
                        var starttime = '<?php echo date('Y-m-d');?>'
                        var endtime ='<?php echo date('Y-m-d');?>';
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "昨日":
                        offset = 0;
                        var starttime = '<?php echo date('Y-m-d',strtotime('-1 day'));?>';
                        var endtime = '<?php echo date('Y-m-d',strtotime('-1 day'));?>';
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本周":
                        offset = 0;
                        var starttime = '<?php echo date('Y-m-d',strtotime('-7 days'));?>';
                        var endtime = '<?php echo date('Y-m-d',strtotime('-1 day'));?>';
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                    case "本月":
                        offset = 0;
                        var starttime = getdate(-24 * 60 * 60 * 30);
                        var endtime = getdate(0);
                        $("#mystarttime").val(starttime);
                        $("#myendtime").val(endtime);
                        startdata(starttime, endtime);
                        break;
                }
            });

        });

    </script>
</body>
</html>
