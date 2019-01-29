<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('no3/common/header'); ?>
<body>
    <script id="datamodel1" type="text/html" >
        <tr>
            <td class="center">${userid}</td>
            <td>${roomid}</td>
            <td>${machineid}</td>
            <td>${machinecreditbefore}</td>
            <td>${machinecreditafter}</td>
            <td>${action}</td>
            <td>${goldchange}</td>
            <td>${goldbefore}</td>
            <td>${goldafter}</td>
            <td>${creditbefore}</td>
            <td>${creditafter}</td>
            <td>${betcredit}</td>
            <td>${wincredit}</td>
            <td>${bonuscredit}</td>
            <td>${realwincredit}</td>
            <td>${gameresult}</td>
            <td>${gameresultwincredit}</td>
            <td>${comparewinratio}</td>
            <td><a onclick="reviewGameProcedure('${gameprocedure}', '${gameresult}', '${comparewinratio}')" style="display:${hide}">查看</a></td>
            <td><i class="icon-time bigger-110 hidden-480"></i>${recordtime}</td>
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
                                            <h5><i class="icon-arrow-left"></i>连环炮游戏记录</h5>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="1 icon-chevron-up bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="widget-toolbox padding-8 clearfix">
                                            <input type="text" id="userid1"   placeholder="用户ID"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
                                            <input type="text" id="machineId"   placeholder="机器ID"   class="col-xs-10 col-sm-2" style = "margin-left:0px;height:30px;width:120px;"/>
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
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main"  style ="padding:0;">
                                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                    <thead id="targethead">
                                                         <tr>
															<th class="center">userID</th>
															<th>房间</th>
															<th>机器id</th>
															<th>机器开始积分</th>
															<th>机器结束积分</th>
															<th>动作</th>
															<th>金豆变化</th>
															<th>开始金豆</th>
															<th>结束金豆</th>
															<th>开始积分</th>
															<th>结束积分</th>
															<th>下注积分</th>
															<th>中奖积分</th>
															<th>赚取积分</th>
															<th>游戏结果</th>
															<th>游戏结果对应奖励</th>
															<th>比倍倍数</th>
															<th>游戏过程</th>
															<th><i class="icon-time bigger-110 hidden-480"></i>游戏时间</th>
														</tr>
                                                    </thead>

                                                    <tbody id="targetbody">

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer no-margin-top">

                                                    <div class="dataTables_info pull-left" id="sample-table-2_info">点击“查询”从服务器加载数据</div>
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
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

	<!-- 显示游戏过程的模态框 -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="procedure_modal">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="chatModalTitle">游戏过程</h4>
			    </div>
			    <div class="modal-body">
					<div style="margin-top: 10px;width: 100%; overflow:hidden; font-weight:bold; color:darkorange">
						结果：
						<div id="result" style="display:inline-block"></div>
						&nbsp&nbsp&nbsp倍数：
						<div id="compareRatio" style="display:inline-block"></div>
					</div>
					<div style="margin-top: 10px;width: 100%; overflow:hidden">
						<div>
						第一轮牌：
						<div id="firstPoker" style="display:inline-block"></div>
						</div>
						<div>
						Hold：
						<div id="hold" style="display:inline-block"></div>
						</div>
						<div>
						第二轮牌：
						<div id="secondPoker" style="display:inline-block"></div>
						</div>
						<div>
						比倍：
						<div id="compareProcedure" style="display:inline-block"></div>
						</div>
					</div>
				</div>
    		</div>
  		</div>
	</div>

    <script type="text/javascript">
        window.jQuery || document.write("<script src='../res/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>

    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='../res/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="../res/js/bootstrap.min.js"></script>
    <script src="../res/js/typeahead-bs2.min.js"></script>

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

    <script type="text/javascript">
        var beginindex = 1;
        var allcount = 0;

        var userid_back = "";
        var machineid_back = "";
        
        var id_date_picker_1 = "";
        var id_time_picker_1 = "";
        var id_date_picker_2 = "";
        var id_time_picker_2 = "";

        var ACTION_TEXT = {
			0 : '未知',
			1 : '上分',
			2 : '下分',
			3 : '游戏',
			4 : '保留机器',
        }

        var GAME_RESULT_TEXT = {
			0 : "",
			1 : "1P(一对,10以上)",
			2 : "2P(两对)",
			3 : "3K(三张相同)",
			4 : "ST(顺子)",
			5 : "FL(清一色)",
			6 : "FH(葫芦,3带2)",
			7 : "4K(四张相同)",
			8 : "SF(同花顺)",
			9 : "RS(皇家同花顺)",
			10 : "5K(五张相同)",
        }
        
        function reset() {
            $("#id_date_picker_1").val(id_date_picker_1);
            $("#id_time_picker_1").val(id_time_picker_1);
            $("#id_date_picker_2").val(id_date_picker_2);
            $("#id_time_picker_2").val(id_time_picker_2);
            $("#userid1").val(userid_back);
            $("#machineId").val(machineid_back);
        }

        function get_record_data() {
            var userid = $("#userid1").val();
            var machineId = $("#machineId").val();
            if(userid.length < 3 && machineId.length <= 0){
                alert("请正确输入用户ID或机器Id！");
                return;
            }
            id_date_picker_1 = $("#id_date_picker_1").val();
            id_time_picker_1 = $("#id_time_picker_1").val();
            id_date_picker_2 = $("#id_date_picker_2").val();
            id_time_picker_2 = $("#id_time_picker_2").val();
            $("#targetbody").html("");
            userid_back = userid;
            machineid_back = machineId;
            var packet = {
                mystarttime : $("#id_date_picker_1").val()+" "+$("#id_time_picker_1").val(),
                myendtime:   $("#id_date_picker_2").val()+" "+$("#id_time_picker_2").val(),
                userid: $("#userid1").val(),
                machineid: machineId,
                beginindex: (beginindex - 1) * 20
             };
            function onsuccess(data) {
                $(".pageitemnum").removeClass("hide");
                $(".pageitemleft").removeClass("disabled");
                $(".pageitemright").removeClass("disabled");
                var datax = eval("(" + data + ")");
                if(datax["status"]=="1"){
                    alert("userid必须填写！");
                    return ;
                }

                allcount = datax["count"];
                
                if(allcount == 0)
				{
					alert("没有满足条件的数据！");
					return;
				}
                
                $(".pageitemnum").each(function(e) {
                    if (e * 20 < allcount) {
                        $(this).children("a").html(e + parseInt(beginindex / 10) * 10 + 1);
                    } else {
                        $(this).addClass("hide");
                    }
                })

                // 处理数据
                for (var itemx in datax["detail"])
                {
                    var actionType = parseInt(datax['detail'][itemx]['action']);
                    datax['detail'][itemx]['action'] = ACTION_TEXT[actionType];
                    datax['detail'][itemx]['gameresult'] = GAME_RESULT_TEXT[parseInt(datax['detail'][itemx]['gameresult'])];
                    datax['detail'][itemx]['hide'] = actionType == 3 ? "inline-block" : "none";
                }

                var msg = "总共数据：" + allcount + "条,现在是在第：" + beginindex + "页，每页20条。"
                $("#sample-table-2_info").html(msg);
                $("#targetbody").html($("#datamodel1").tmpl(datax["detail"]));
            }

            function onerrors(data) {
            }
            jQuery.comm.sendmessage("<?php echo site_url('no3/lhpgamerecord/get_record_data')?>", packet, onsuccess, onerrors);
        }

        function reviewGameProcedure(gameProcedure, result, compareRatio)
        {
			var procArray = gameProcedure.split('|*|');
			var firstArray = [];
			var holdArray = [];
			var secondArray = [];
			var compare = [];
			if (procArray.length == 4)
			{
				firstArray = procArray[0].split('|');
				holdArray = procArray[1].split('|');
				secondArray = procArray[2].split('|');
				compare = procArray[3].split('$');
			}
			else if (procArray.length == 3)
			{
				firstArray = procArray[0].split('|');
				holdArray = procArray[1].split('|');
				secondArray = procArray[2].split('|');
			}
			else 
			{
				alert("记录的数据不正确");
				return;
			}

			$('#result').html(result);
			$('#compareRatio').html(compareRatio);

			$('#firstPoker').html(generateCardList(firstArray));
			$('#hold').html(generateHoldList(holdArray));
			$('#secondPoker').html(generateCardList(secondArray));
			$('#compareProcedure').html(generateCompareList(compare));

			// 弹出二级框
			$('#procedure_modal').modal('show');
        }

        // 生成hold字符串
        function generateHoldList(holdArray)
        {
            if (holdArray.length == 0)
            {
                return "没有hold";
            }

            var result = "第";

            for (var i in holdArray)
            {
                result += "" + (parseInt(holdArray[i]) + 1) + "、";
            }

            result = result.substr(0, result.length - 1) + "张";

            return result;
        }

        // 生成比倍字符串
        function generateCompareList(compareArray)
        {
            if (compareArray.length == 0)
            {
                return "<span style='color:gray'>没有比倍</span>";
            }

            var result = "";
            for (var i in compareArray)
            {
                if (compareArray[i] == '1')
                {
                    result += "<span style='color:darkgreen'>成功</span>|";
                }
                else
                {
                    result += "<span style='color:red'>失败</span>|";
                }
            }

            result = result.substr(0, result.length - 1);

            return result;
        }

        // 根据字符串生成牌序
		function generateCardList(cards_ary) {
			var content = '';
			$.each(cards_ary, function(key, value) {
				content += '<span class="card">' + getCard(value) + '</span>';
			});
			return content;
		}

        // 获取单张牌
		function getCard(card_num) {
			var card = card_num.toString();
			if (card.length == 1) {
				card = '0' + card;
			}

			var color = '';
			var num = '';

			switch (card[0]) {
			case '0':
				color = '&clubs;';
				break;
			case '1':
				color = '&diams;';
				break;
			case '2':
				color = '&hearts;';
				break;
			case '3':
				color = '&spades;';
				break;
			default:
				color = '';
				break;
			}

			switch (card[1]) {
			case '1':
				num = 'A';
				break;
			case 'a':
				num = '10';
				break;
			case 'b':
				num = 'J';
				break;
			case 'c':
				num = 'Q';
				break;
			case 'd':
				num = 'K';
				break;
			case 'e':
				num = '小王';
				break;
			case 'f':
				num = '大王';
				break;
			default:
				num = card[1];
				break;
			}

			if (card[1] == 'e' || card[1] == 'f') {
				return num;
			}
			return color + num;
		}

        function reflesh() {
            beginindex = 1;
            get_record_data();
        }

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
                get_record_data();
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

            // 日期选择
            $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function() {
                $(this).next().focus();
            });
              
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
                                  
            // 时间选择
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
        });
    </script>
</body>
</html>
