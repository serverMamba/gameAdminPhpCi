<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>

	<div id="modal-tree-items" class="modal" tabindex="-1">
		<div class="modal-dialog" style="width: 450px; margin-top: 100px;">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<label id="myidx" class="blue bigger" style="font-size: 18px;"></label>：<label
						id="mytitlex" class="blue bigger" style="font-size: 18px;"></label>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" role="form">

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-y"> 提示： </label>


							<div id="myhanyi" class="col-sm-9" style="font-size: 16px"></div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-y"> 动作： </label>


							<div id="myaction" class="col-sm-9" style="font-size: 16px"></div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-m"> 数值： </label>

							<div class="col-sm-9">
								<input type="text" id="form-field-mxx" placeholder="数值"
									class="col-xs-20 col-sm-10"
									style="margin-left: 10px; width: 230px;" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-m"> 描述： </label>
							<div class="col-sm-9">
								<textarea rows="3" cols="20" id="form-field-mxy"
									placeholder="输入理由" class="col-xs-20 col-sm-10"
									style="margin-left: 10px; width: 230px;"></textarea>
							</div>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i> Cancel
					</button>
					<button class="btn btn-sm btn-primary" onclick="dosave();">
						<i class="ace-icon fa fa-check"></i>执行
					</button>
				</div>

			</div>
		</div>
	</div>
	<div id="modal-tree-items1" class="modal" tabindex="-1">
		<div class="modal-dialog" style="width: 450px; margin-top: 100px;">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<label id="myidx1" class="blue bigger" style="font-size: 18px;"></label>：<label
						id="mytitlex1" class="blue bigger" style="font-size: 18px;"></label>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" role="form">

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-y"> 提示： </label>


							<div id="myhanyi1" class="col-sm-9" style="font-size: 16px"></div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-y"> 动作： </label>
							<div id="myaction1" class="col-sm-9" style="font-size: 16px"></div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-m"> 支付宝帐号： </label>
							<div id="form-field-mxx1" class="col-sm-9"
								style="font-size: 16px"></div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-m"> 支付宝实名： </label>
							<div id="form-field-mxx2" class="col-sm-9"
								style="font-size: 16px"></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"
								for="form-field-m"> 描述： </label>

							<div class="col-sm-9">
								<textarea rows="3" cols="20" id="form-field-mxy1"
									placeholder="输入理由" class="col-xs-20 col-sm-10"
									style="margin-left: 10px; width: 230px;"></textarea>
							</div>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i> Cancel
					</button>
					<button class="btn btn-sm btn-primary"
						onclick="doAddBlackAlipay();">
						<i class="ace-icon fa fa-check"></i>执行
					</button>
				</div>
			</div>
		</div>
	</div>

	
	<script id="tablemodel" type="text/html">


            <div class="widget-box">
                <div class="widget-header header-color-blue">

                    <h5 class="bigger lighter">
                         【${id}】
                     
                          <button onclick="javascript:proflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">《</span>
                                                   
                                                </button>
                        <button onclick="javascript:currflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110"> 当前第${currentcount}条/总共${allcount}条</span>
                                                   
                                                </button>
                          <button onclick="javascript:nextflesh()" class="btn btn-xs btn-success " style="margin-top:1px;">
                                                    <span class="bigger-110">》</span>
                                                 
                                                </button>
                      
                    
                      
                    </h5>
                   
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">


                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        <i class="icon-user"></i>
                                        项目
                                    </th>

                                    <th>
                                        <i>@</i>
                                        内容
                                    </th>
                                    <th class="hidden-480">操作</th>
                                    <th>
                                        <i class="icon-user"></i>
                                        项目
                                    </th>

                                    <th>
                                        <i>@</i>
                                        内容
                                    </th>
                                    <th class="hidden-480">操作</th>
                                    <th>
                                        <i class="icon-user"></i>
                                        项目
                                    </th>

                                    <th>
                                        <i>@</i>
                                        内容
                                    </th>
                                    <th class="hidden-480">操作</th>
                                    <th>
                                        <i class="icon-user"></i>
                                        项目
                                    </th>

                                    <th>
                                        <i>@</i>
                                        内容
                                    </th>
                                    <th class="hidden-480">操作</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="">帐号</td>

                                    <td>
                                        ${user_email}<label id="accountquery">【待查】</>
                                    </td>

                                    <td>
                                        <span class="label label-success" id="accountquery1" onclick="javascript:fong(${id},'您真的要封帐号吗？','fongzhanghao', '0是封，1是解封','0');" style="cursor: pointer;">封帐号</span>
                                    </td>
                                    <td class="">昵称</td>

                                    <td>
                                        ${nickname}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'昵称修改','modifyfield', 'nickname','${nickname}');" style="cursor: pointer;">修改</span>
                                    </td>

                                    <td class="">密码</td>

                                    <td>
                                        ${password}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success"  onclick="javascript:modify(${id},'密码修改','modifyfield', 'password','${password}');" style="cursor: pointer;">修改</span>
                                    </td>

                                    <td class="">注册时间</td>

                                    <td>
                                        ${registertime}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>

                                </tr>


                                <tr>
                                    <td class="">用户ID</td>

                                    <td>
                                        ${id}
										<br/><label id="idquery">【待查】</label>
										<br/><label id="idlimitpay">【待查】</label>
                                    </td>

                                    <td class="hidden-480">
                                       <span class="label label-success" id="idquery1" onclick="javascript:fong(${id},'踢掉用户','ticketout', '${id}','只与ID相关，无其他参数');"  style="cursor: pointer;">踢出</span>
									   	<br/><br/>
										<span class="label label-success" id="accountlimitpay" onclick="javascript:fong(${id},'您真的要封充值吗？','limitpay', '0是封，1是解封','0');" style="cursor: pointer;">封充值</span>
                                    </td> 
                                    
                                     <td class="">性别</td>

                                    <td>
                                        ${user_sex}
                                    </td>

                                    <td class="hidden-480">
                                       <span class="label label-warning" >禁止</span> 
                                    </td>
 
                                    <td class="">最后登录ip</td>

                                    <td>
                                        ${lastLoginIp}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
									 
									</td>
                                    <td class="">最后登录时间</td>

                                    <td>
                                        ${last_login_time1}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="">MAC</td>

                                    <td>
                                        ${mac}<label id="macquery">【待查】</>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" id="macquery1" onclick="javascript:fong('${mac}','封掉mac','fongmac', '0是封，1是解封','0');" style="cursor: pointer;">封MAC</span>
                                    </td>

                                    <td class="">赢次数</td>

                                    <td>
                                        ${win_game}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改赢次数','modifyfield', 'win_game',' ${win_game}');" style="cursor: pointer;">修改</span>                                   
                                    </td>

                                    <td class="">输次数</td>

                                    <td>
                                        ${lose_game}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改输次数','modifyfield', 'lose_game',' ${lose_game}');" style="cursor: pointer;">修改</span>                                   
                                    </td>
                                    <td class="">平次数</td>

                                    <td>
                                        ${draw_game}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改平次数','modifyfield', 'draw_game',' ${draw_game}');" style="cursor: pointer;">修改</span>                                   
                                    </td>

                                </tr>


                                <tr>
                                    <td class="">设备ID</td>

                                    <td>
                                        ${user_device_id}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                    <td class="">支付宝账号</td>

                                    <td>
                                        ${alipay_account}<label id="alipay_accountquery">【待查】</>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改支付宝账号','modifyfield', 'alipay_account',' ${alipay_account}');" style="cursor: pointer;">修改DB</span>
                                    </td>

                                    <td class="">支付宝实名</td>

                                    <td>
                                        ${alipay_real_name}<label id="alipay_real_namequery">【待查】</>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改支付宝实名','modifyfield', 'alipay_real_name',' ${alipay_real_name}');" style="cursor: pointer;">修改DB</span>
										<br/><br/>
										<span class="label label-success" onclick="javascript:addBlackAlipay(${id},'加入支付宝黑名单','addBlackAlipay', '加入黑名单后，该支付宝将被禁止提现！',' ${alipay_account}',' ${alipay_real_name}');" style="cursor: pointer;">封提现</span>
                                    </td>
                                    <td class="">绑定手机</td>

                                    <td>
                                        ${boundmobilenumber}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改绑定手机号','modifyfield', 'boundmobilenumber',' ${boundmobilenumber}');" style="cursor: pointer;">修改DB</span>                                   
                                    </td>

                                </tr>


                                <tr>
                                    <td class="">IP</td>

                                    <td>
                                        ${ip}<label id="ipquery">【待查】</>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:fong('${ip}','封IP','fongip', '0是封，1是解封','0');" style="cursor: pointer;">封IP</span>
                                    </td>

                                    <!--<td class="">总兑换券</td>

                                    <td>
                                        ${coupon_total_given}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>-->

                                    <td class="">总付费</td>

                                    <td>
                                        ${totalBuy}
                                    </td>

                                    <td class="hidden-480">
<!--
                                        <span class="label label-success" onclick="javascript:showChargeWithdrawal(${id});" style="cursor: pointer;">充值提现曲线</span>
-->
                                        <!-- <span class="label label-warning" >禁止</span> -->
                                    </td>

									<td class="">总提现</td>

                                    <td>
                                        ${total_total_money}
                                    </td>

                                    <td class="hidden-480">
                                        <!-- <span class="label label-warning" >禁止</span> -->
                                    </td>

                                    <td class="">渠道号</td>

                                    <td>
                                        ${channel_id}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="">激活设备</td>

                                    <td>
                                        ${activate_device}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>

                                    <td class="">钻石数量</td>

                                    <td>
                                        ${secondmoney}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改钻石数量','modifyfish', 'secondmoney',' ${secondmoney}');" style="cursor: pointer;">修改DB</span>
                                    </td>
                                    <td class="">是否被举报</td>

                                    <td>
                                        ${is_reported}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="">金币数</td>

                                    <td>
                                        ${user_chips}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success"  onclick="javascript:modify(${id},'修改金豆数,填增加数','modifyfield', 'user_chips',' ${user_chips}');" style="cursor: pointer;">修改</span>
                                    </td>
                                </tr>
                                
                              
                             <tr>
                                    <td class="">记牌器</td>

                                    <td>
                                        ${notecarddeviceeffectivetime}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="">保险箱</td>

                                    <td>
                                        ${cofferchips} 
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span><!-- <span class="label label-success" onclick="javascript:modify(${id},'修改鱼武器等级','modifyfield', 'huaFeiQuan',' ${huaFeiQuan}');" style="cursor: pointer;">修改</span>-->
                                    </td>
                                    <td class="">保险箱密码</td>

                                    <td>
                                        ${cofferpassword} 
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改保险箱密码','modifyfish', 'cofferpassword',' ${cofferpassword}');" style="cursor: pointer;">修改DB</span>
                                    </td>
                                </tr>      
                                
                                             
                                
                                <tr>
                                    

                                    <td class="">炮台等级</td>

                                    <td>
                                        ${gunindex}
                                    </td>

                                    <td class="hidden-480">
                                         <span class="label label-warning" >禁止</span>
                                    </td>
                                    <td class="">冰冻卡数量</td>

                                    <td>
                                        ${skill1num}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="">锁定卡数量</td>

                                    <td>
                                        ${skill2num} 
                                    </td>
                                    
                                    <td class="hidden-480">
                                        <span class="label label-success"  onclick="javascript:modify(${id},'修改VIP等级','modifyfield', 'newlevel',' ${newlevel}');" style="cursor: pointer;">修改</span>
                                    </td>

                                    <td class="">充值贡献度</td>

                                    <td>
                                        ${payContribution} 
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                </tr>            
                                
                                
                                 <tr>
 
                                    <td class="">周期净分(捕鱼)</td>

                                    <td >
                                        ${periodwinscore}
                                    </td>

                                    <td class="hidden-480" >
                                         <span class="label label-warning" >禁止</span>
                                    </td>
                                    <td class="">周期游戏次数(捕鱼)</td>

                                    <td >
                                        ${periodgamecount}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="">日净分(捕鱼)</td>

                                    <td>
                                        ${dailywinscore} 
                                    </td>
                                    
                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>

                                    <td class="">总玩分(捕鱼)</td>

                                    <td >
                                        ${totalplayscore} 
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                </tr>   
                                
                                                        
                                 <tr >
                                    

                                    <td class="">总赢分(捕鱼)</td>

                                    <td >
                                        ${totalwinscore}
                                    </td>

                                    <td class="hidden-480">
                                         <span class="label label-warning" >禁止</span>
                                    </td>
                                    <td class="">总发射次数(捕鱼)</td>

                                    <td >
                                        ${totalshotcount}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="">日发射次数(捕鱼)</td>

                                    <td >
                                        ${dailyshotcount} 
                                    </td>
                                    
                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>

                                    <td class="">强发库(捕鱼)</td>

                                    <td >
                                        ${forcepool} 
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                </tr>  
                                
                                
                                <tr >
                                    

                                    <td class="">奖励库(捕鱼)</td>

                                    <td >
                                        ${rewardpool}
                                    </td>

                                    <td class="hidden-480">
                                         <span class="label label-warning" >禁止</span>
                                    </td>
                                    <td class="">待增加</td>

                                    <td >
                                       
                                    </td>

                                    <td class="hidden-480" >
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                     
                                    <td class="" >待增加</td>

                                    <td>
                                        
                                    </td>
                                    
                                    <td class="hidden-480">
                                         <span class="label label-warning" >禁止</span>
                                    </td>

                                    <td class="">待增加</td>

                                    <td >
                                        
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                </tr>  
                               
                                
                                 <tr>
                                     
                                     <td class="">电话号码</td>

                                    <td>
                                        ${mobile_number}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                    
                                     <td class="">连续登录</td>

                                    <td>
                                        ${consecutive_login}
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning" >禁止</span>
                                    </td>
                                    

                                    <td class="">用户图片</td>

                                    <td colspan="4" style="color: gray;">
                                       <a href="http://face.pokerjoin.com${user_avatar_url}" style="color: gray;" >http://face.pokerjoin.com${user_avatar_url}</a>
                                    </td>
                                    <td class="hidden-480">
                                        <span class="label label-success" onclick="javascript:modify(${id},'修改图片','modifyfield', 'user_avatar_url',' ${user_avatar_url}');" style="cursor: pointer;">修改</span>
                                    </td>
                                   
                                </tr>
                                
                                <tr>
                                    <td class="">数据库索引</td>
                                    <td>
                                        ${dbIndex}
                                    </td>
                                   
                                    <td class="">表索引</td>
                                    <td>
                                        ${tableIndex}
                                    </td>
                                </tr>

                                <tr>
                                     
                                     <td class="">被封原因</td>

                                    <td colspan="12">
                                        ${black_des}
                                    </td>

                         
                                   
                                </tr>
                                
                                <tr>
                                     
                                     <td class="">版本查询</td>

                                    <td colspan="12">
                                        ${versionstatus}
                                    </td>

                         
                                   
                                </tr> 
                                
                                <tr>
                                    <td class="13">比赛相关信息</td>
                         
                                 </tr> 
                                
                                 <tr>
                                     
                                     <td class="">姓名</td>

                                    <td colspan="3">
                                        ${userIDCardName} 
                                    </td>
                                    <td class="">身份证</td>

                                    <td colspan="3">
                                        ${userIDCard}
                                    </td>
                                    
                                     <td class="">电话</td>

                                    <td colspan="3">
                                         ${mobile_number}
                                    </td>

                         
                                   
                                </tr> 
                                
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
											<h5>
												<i class="icon-arrow-left"></i>玩家详细信息
											</h5>

											<div class="widget-toolbar">
												<a href="#" data-action="collapse"> <i
													class="1 icon-chevron-up bigger-125"></i>
												</a>
											</div>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											<input type="text" id="accountid1" placeholder="帐号ID"
												class="col-xs-10 col-sm-2"
												style="margin-left: 5px; height: 30px; width: 120px;" /> <input
												type="text" id="userid1" placeholder="用户ID"
												value="<?php if($query['user_id']){echo $query['user_id'];}?>"
												class="col-xs-10 col-sm-2"
												style="margin-left: 0px; height: 30px; width: 120px;" /> <input
												type="text" id="alipay_account" placeholder="支付宝帐号"
												value="<?php echo $query['alipay_account'];?>"
												class="col-xs-10 col-sm-2"
												style="margin-left: 0px; height: 30px; width: 120px;" /> <input
												type="text" id="alipay_name" placeholder="支付宝姓名"
												class="col-xs-10 col-sm-2"
												style="margin-left: 0px; height: 30px; width: 100px;" /> <input
												type="text" id="mac1" placeholder="MAC"
												class="col-xs-10 col-sm-2"
												style="height: 30px; width: 120px;" /> <input type="text"
												id="ip1" placeholder="IP" class="col-xs-10 col-sm-2"
												style="height: 30px; width: 120px;" /> <input type="text"
												id="mobile" placeholder="绑定手机" class="col-xs-10 col-sm-2"
												style="height: 30px; width: 120px;" /> 是否充值： <select
												name="is_recharge" id="is_recharge">
												<option value="all">全部</option>
												<option value="1">是</option>
												<option value="2">否</option>
											</select>

											<button onclick="javascript:reset()"
												class="btn btn-xs btn-success "
												style="margin-top: 1px; margin-left: 10px;">
												<i class="icon-star-half icon-on-left"></i> <span
													class="bigger-110">重置</span>
											</button>

											<button onclick="javascript:reflesh()"
												class="btn btn-xs btn-success " style="margin-top: 1px;">
												<span class="bigger-110">查询</span> <i
													class="icon-search icon-on-right"></i>
											</button>
											<button onclick="javascript:allreflesh()"
												class="btn btn-xs btn-success " style="margin-top: 1px;">
												<span class="bigger-110">金豆+保险箱最大的</span> <i
													class="icon-search icon-on-right"></i>
											</button>
										</div>
										<div class="widget-body">

											<div class="row">
												<div id="tablecontent" class="col-xs-12"
													style="margin-top: -3px;"></div>
											</div>
											<div class="row">
												<div class="col-xs-12" style="margin-top: -3px;">
													<!-- PAGE CONTENT BEGINS -->
												</div>
												<!-- /.col -->
											</div>
											<!-- /.row -->
											<div class="widget-main"
												style="padding: 0; border: thin solid #307ecc; margin-top: -10px;">
												<table id="sample-table-2"
													class="table table-striped table-bordered table-hover">
													<thead id="targethead">
														<tr>
															<th class="center">游戏名称</th>
															<th>在线时间</th>
															<th>总玩次数</th>
															<th>累积赢分</th>
															<th>累积输分</th>
															<th>累积净分</th>
															<th>累积服务费</th>
															<th>真实净分</th>
															<th>最近一天净分</th>
															<th>首玩时间查询</th>
															<th>版本查询</th>
															<th><i class="icon-time bigger-110 hidden-480"></i>最近游戏时间</th>
														</tr>
													</thead>

													<tbody id="targetbody">
														<tr>
															<td class="center">德州扑克</td>
															<td class="hidden-480" id="dzpk_1_onlinetime"></td>
															<td id="dzpk_1_gamenum"></td>
															<td id="dzpk_1_winscore"></td>
															<td id="dzpk_1_losescore"></td>
															<td id="dzpk_1_jinfen"></td>
															<td id="dzpk_1_servicefee"></td>
															<td id="dzpk_1_realjinfen"></td>
															<td class="hidden-480" id="dzpk_1_lastjinfen"></td>
															<td class="hidden-480" id="dzpk_1_newestversion"></td>
															<td class="hidden-480" id="dzpk_1_firstgametime"></td>
															<td id="dzpk_1_lastgametime"></td>
														</tr>
														<tr>
															<td class="center">斗地主经典场</td>
															<td class="hidden-480" id="ddz_97_onlinetime"></td>
															<td id="ddz_97_gamenum"></td>
															<td id="ddz_97_winscore"></td>
															<td id="ddz_97_losescore"></td>
															<td id="ddz_97_jinfen"></td>
															<td id="ddz_97_servicefee"></td>
															<td id="ddz_97_realjinfen"></td>
															<td class="hidden-480" id="ddz_97_lastjinfen"></td>
															<td class="hidden-480" id="ddz_97_newestversion"></td>
															<td class="hidden-480" id="ddz_97_firstgametime"></td>
															<td id="ddz_97_lastgametime"></td>
														</tr>
														<tr>
															<td class="center">斗地主欢乐场</td>
															<td class="hidden-480" id="ddz_98_onlinetime"></td>
															<td id="ddz_98_gamenum"></td>
															<td id="ddz_98_winscore"></td>
															<td id="ddz_98_losescore"></td>
															<td id="ddz_98_jinfen"></td>
															<td id="ddz_98_servicefee"></td>
															<td id="ddz_98_realjinfen"></td>
															<td class="hidden-480" id="ddz_98_lastjinfen"></td>
															<td class="hidden-480" id="ddz_98_newestversion"></td>
															<td class="hidden-480" id="ddz_98_firstgametime"></td>
															<td id="ddz_98_lastgametime"></td>
														</tr>
														<tr>
															<td class="center">斗地主PK赛普通场</td>
															<td class="hidden-480" id="ddz_100_onlinetime"></td>
															<td id="ddz_100_gamenum"></td>
															<td id="ddz_100_winscore"></td>
															<td id="ddz_100_losescore"></td>
															<td id="ddz_100_jinfen"></td>
															<td id="ddz_100_servicefee"></td>
															<td id="ddz_100_realjinfen"></td>
															<td class="hidden-480" id="ddz_100_lastjinfen"></td>
															<td class="hidden-480" id="ddz_100_newestversion"></td>
															<td class="hidden-480" id="ddz_100_firstgametime"></td>
															<td id="ddz_100_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">MJ2P(二人麻将)</td>
															<td class="hidden-480" id="ddz_177_onlinetime"></td>
															<td id="ddz_177_gamenum"></td>
															<td id="ddz_177_winscore"></td>
															<td id="ddz_177_losescore"></td>
															<td id="ddz_177_jinfen"></td>
															<td id="ddz_177_servicefee"></td>
															<td id="ddz_177_realjinfen"></td>
															<td class="hidden-480" id="ddz_177_lastjinfen"></td>
															<td class="hidden-480" id="ddz_177_newestversion"></td>
															<td class="hidden-480" id="ddz_177_firstgametime"></td>
															<td id="ddz_177_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">癞子斗地主</td>
															<td class="hidden-480" id="ddz_177_onlinetime"></td>
															<td id="ddz_101_gamenum"></td>
															<td id="ddz_101_winscore"></td>
															<td id="ddz_101_losescore"></td>
															<td id="ddz_101_jinfen"></td>
															<td id="ddz_101_servicefee"></td>
															<td id="ddz_101_realjinfen"></td>
															<td class="hidden-480" id="ddz_101_lastjinfen"></td>
															<td class="hidden-480" id="ddz_101_newestversion"></td>
															<td class="hidden-480" id="ddz_101_firstgametime"></td>
															<td id="ddz_101_lastgametime"></td>
														</tr>


														<tr>
															<td class="center">三张牌</td>
															<td class="hidden-480" id="ddz_49_onlinetime"></td>
															<td id="ddz_49_gamenum"></td>
															<td id="ddz_49_winscore"></td>
															<td id="ddz_49_losescore"></td>
															<td id="ddz_49_jinfen"></td>
															<td id="ddz_49_servicefee"></td>
															<td id="ddz_49_realjinfen"></td>
															<td class="hidden-480" id="ddz_49_lastjinfen"></td>
															<td class="hidden-480" id="ddz_49_newestversion"></td>
															<td class="hidden-480" id="ddz_49_firstgametime"></td>
															<td id="ddz_49_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">拼十</td>
															<td class="hidden-480" id="ddz_18_onlinetime"></td>
															<td id="ddz_18_gamenum"></td>
															<td id="ddz_18_winscore"></td>
															<td id="ddz_18_losescore"></td>
															<td id="ddz_18_jinfen"></td>
															<td id="ddz_18_servicefee"></td>
															<td id="ddz_18_realjinfen"></td>
															<td class="hidden-480" id="ddz_18_lastjinfen"></td>
															<td class="hidden-480" id="ddz_18_newestversion"></td>
															<td class="hidden-480" id="ddz_18_firstgametime"></td>
															<td id="ddz_18_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">看牌拼十</td>
															<td class="hidden-480" id="ddz_20_onlinetime"></td>
															<td id="ddz_20_gamenum"></td>
															<td id="ddz_20_winscore"></td>
															<td id="ddz_20_losescore"></td>
															<td id="ddz_20_jinfen"></td>
															<td id="ddz_20_servicefee"></td>
															<td id="ddz_20_realjinfen"></td>
															<td class="hidden-480" id="ddz_20_lastjinfen"></td>
															<td class="hidden-480" id="ddz_20_newestversion"></td>
															<td class="hidden-480" id="ddz_20_firstgametime"></td>
															<td id="ddz_20_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">掼蛋</td>
															<td class="hidden-480" id="ddz_145_onlinetime"></td>
															<td id="ddz_145_gamenum"></td>
															<td id="ddz_145_winscore"></td>
															<td id="ddz_145_losescore"></td>
															<td id="ddz_145_jinfen"></td>
															<td id="ddz_145_servicefee"></td>
															<td id="ddz_145_realjinfen"></td>
															<td class="hidden-480" id="ddz_145_lastjinfen"></td>
															<td class="hidden-480" id="ddz_145_newestversion"></td>
															<td class="hidden-480" id="ddz_145_firstgametime"></td>
															<td id="ddz_145_lastgametime"></td>
														</tr>


														<tr>
															<td class="center">捕鱼</td>
															<td class="hidden-480" id="ddz_145_onlinetime"></td>
															<td id="ddz_193_gamenum"></td>
															<td id="ddz_193_winscore"></td>
															<td id="ddz_193_losescore"></td>
															<td id="ddz_193_jinfen"></td>
															<td id="ddz_193_servicefee"></td>
															<td id="ddz_193_realjinfen"></td>
															<td class="hidden-480" id="ddz_193_lastjinfen"></td>
															<td class="hidden-480" id="ddz_193_newestversion"></td>
															<td class="hidden-480" id="ddz_193_firstgametime"></td>
															<td id="ddz_193_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">百人牛牛</td>
															<td class="hidden-480" id="ddz_21_onlinetime"></td>
															<td id="ddz_21_gamenum"></td>
															<td id="ddz_21_winscore"></td>
															<td id="ddz_21_losescore"></td>
															<td id="ddz_21_jinfen"></td>
															<td id="ddz_21_servicefee"></td>
															<td id="ddz_21_realjinfen"></td>
															<td class="hidden-480" id="ddz_21_lastjinfen"></td>
															<td class="hidden-480" id="ddz_21_newestversion"></td>
															<td class="hidden-480" id="ddz_21_firstgametime"></td>
															<td id="ddz_21_lastgametime"></td>
														</tr>

														<tr>
															<td class="center">百人三张牌</td>
															<td class="hidden-480" id="ddz_52_onlinetime"></td>
															<td id="ddz_52_gamenum"></td>
															<td id="ddz_52_winscore"></td>
															<td id="ddz_52_losescore"></td>
															<td id="ddz_52_jinfen"></td>
															<td id="ddz_52_servicefee"></td>
															<td id="ddz_52_realjinfen"></td>
															<td class="hidden-480" id="ddz_52_lastjinfen"></td>
															<td class="hidden-480" id="ddz_52_newestversion"></td>
															<td class="hidden-480" id="ddz_52_firstgametime"></td>
															<td id="ddz_52_lastgametime"></td>
														</tr>

														<tr>
															<td class="center" style="background-color: #969696;"></td>
															<td style="background-color: #969696;">总在线时间</td>

															<td class="hidden-480" style="background-color: #969696;">总玩次数</td>
															<td style="background-color: #969696;">总赢分</td>
															<td class="hidden-480" style="background-color: #969696;">总输分</td>
															<td style="background-color: #969696;">总净分</td>
															<td style="background-color: #969696;">总服务费</td>
															<td style="background-color: #969696;">总真实净分</td>
															<td style="background-color: #969696;">游戏首玩时间查询</td>
															<td style="background-color: #969696;">玩家游戏版本查询</td>
															<td style="background-color: #969696;">最近一天总净分</td>

															<td style="background-color: #969696;"></td>
														</tr>

														<tr>
															<td class="center">合计</td>
															<td class="hidden-480" id="ddz_all_onlinetime"></td>
															<td id="ddz_all_gamenum"></td>
															<td id="ddz_all_winscore"></td>
															<td id="ddz_all_losescore"></td>
															<td id="ddz_all_jinfen"></td>
															<td id="ddz_all_servicefee"></td>
															<td id="ddz_all_realjinfen"></td>
															<td class="hidden-480" id="ddz_all_lastjinfen"></td>
															<td class="hidden-480" id="ddz_all_newestversion"></td>
															<td class="hidden-480" id="ddz_all_firstgametime"></td>
															<td id="ddz_all_lastgametime"></td>
														</tr>

													</tbody>
												</table>
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
							id="ace-settings-rtl" /> <label class="lbl"
							for="ace-settings-rtl"> Right To Left (rtl)</label>
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
            
            function fong(id,param1,param2,param3,param4){
                 $("#myidx").html(id);
                 $("#mytitlex").html(param1);
                 $("#myaction").html(param2);
                 $("#myhanyi").html(param3);
                 $("#form-field-mxx").val(param4);
                 $('#modal-tree-items').modal('show');
            }
            
           function modify(id,param1,param2,param3,param4){
                 $("#myidx").html(id);
                 $("#mytitlex").html(param1);
                 $("#myaction").html(param2);
                 $("#myhanyi").html(param3);
                 $("#form-field-mxx").val(param4);
                 $('#modal-tree-items').modal('show');
            }

           /**
            * 删除左右两端的空格
            */
            String.prototype.trim=function()
            {
                 return this.replace(/(^\s*)|(\s*$)/g, '');
            }
           function addBlackAlipay(id,param1,param2,param3,param4,param5){
        	   if(param5.trim()=="")
               {
                   alert("支付宝实名为空，无法操作！");
                   return;
               }
               $("#myidx1").html(id);
               $("#mytitlex1").html(param1);
               $("#myaction1").html(param2);
               $("#myhanyi1").html(param3);
               $("#form-field-mxx1").html(param4);
               $("#form-field-mxx2").html(param5);
               $('#modal-tree-items1').modal('show');
          	}

           function doAddBlackAlipay(){
               var idx=  $("#myidx1").html();
               var actionx=  $("#myaction1").html();
               var helpx=  $("#myhanyi1").html();
               var valuex1=  $("#form-field-mxx1").html();
               var valuex2=  $("#form-field-mxx2").html();
               var discriblex=  $("#form-field-mxy1").val();
                
               var packet = {
                   action:  actionx,
                   userid: idx,
                   help: helpx,
                   alipay_account: valuex1,
                   alipay_real_name: valuex2,
                   discrible: discriblex
               };
               
               function onsuccess(data) {
                   if(data === "noprivate"){
                       alert("权限不够");
                   }
                   $('#modal-tree-items1').modal('hide');
                   if(data+"" == "true")
                   {
                	   $("#alipay_accountquery").html("【已封提现】");
                	   $("#alipay_real_namequery").html("【已封提现】");
                   }
                   return false;
               }
               function onerrors(data) {
               	   return false;
                   // alert(objtostr(data))
               }
               //alert(window.location.protocol + "//" + window.location.host + "/no3/infodetail/save_detail_data");
               jQuery.comm.sendmessage("http://" + window.location.host + "/no3/infodetail/addBlackAlipay?t=1", packet, onsuccess, onerrors);
               return false;
           }
           
            function dosave(){
                var idx=  $("#myidx").html();
                var actionx=  $("#myaction").html();
                var helpx=  $("#myhanyi").html();
                var valuex=  $("#form-field-mxx").val();
                var discriblex=  $("#form-field-mxy").val();
                 
                var packet = {
                    action:  actionx,
                    userid: idx,
                    help: helpx,
                    value: valuex,
                    discrible: discriblex,
                };
                
                function onsuccess(data) {
                    if(data === "noprivate"){
                        alert("权限不够");
                    }
                    $('#modal-tree-items').modal('hide');  
                    return false;  
                }
                function onerrors(data) {
                	$('#modal-tree-items').modal('hide');
                	return false;
                    // alert(objtostr(data))
                }
                //alert(window.location.protocol + "//" + window.location.host + "/no3/infodetail/save_detail_data");
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/infodetail/save_detail_data?t=1", packet, onsuccess, onerrors);
                return false;
            }
            
            
            function get_block_status(ip,id,mac,alipay_account,alipay_real_name){
                 var packet = {
                    ip: ip,
                    id: id,
                    mac: mac,
                    alipay_account: alipay_account,
                    alipay_real_name: alipay_real_name
                 };
                function onsuccess(data) {
                      var datax = eval("(" + data + ")");
                      if(datax["m5"]>0) {$("#idlimitpay").html("【已封充值】");} else{$("#idlimitpay").html("【未封充值】");}
                      if(datax["m4"]>0) {$("#alipay_accountquery").html("【已封提现】");} else{$("#alipay_accountquery").html("【未封提现】");}
                      if(datax["m4"]>0) {$("#alipay_real_namequery").html("【已封提现】");} else{$("#alipay_real_namequery").html("【未封提现】");}
                      if(datax["m3"]>0) {$("#idquery").html("【已封】");$("#accountquery").html("【已封】");$("#accountquery1").html("解封帐号");} else{$("#idquery").html("【未封】");$("#accountquery").html("【未封】");}
                      if(datax["m2"]>0) {$("#macquery").html("【已封】");$("#macquery1").html("解封MAC");} else{$("#macquery").html("【未封】");}
                      if(datax["m1"]>0) {$("#ipquery").html("【已封】");$("#ipquery1").html("解封IP");} else{$("#ipquery").html("【未封】");}
                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/infodetail/get_block_status", packet, onsuccess, onerrors);
            }
            
            function cleartable(){
                
                
                 $("#dzpk_1_onlinetime").html("");
                 $("#dzpk_1_gamenum").html("");
                 $("#dzpk_1_winscore").html("");
                 $("#dzpk_1_losescore").html("");
                 $("#dzpk_1_jinfen").html("");
                 $("#dzpk_1_servicefee").html("");
                 $("#dzpk_1_realjinfen").html("");
                 $("#dzpk_1_lastjinfen").html("");
                 $("#dzpk_1_lastgametime").html("");
                 $("#dzpk_1_newestversion").html("");
                 $("#dzpk_1_firstgametime").html("");
                 
                 $("#ddz_97_onlinetime").html("");
                 $("#ddz_97_gamenum").html("");
                 $("#ddz_97_winscore").html("");
                 $("#ddz_97_losescore").html("");
                 $("#ddz_97_jinfen").html("");
                 $("#ddz_97_servicefee").html("");
                 $("#ddz_97_realjinfen").html("");
                 $("#ddz_97_lastjinfen").html("");
                 $("#ddz_97_lastgametime").html("");
                 $("#ddz_97_newestversion").html("");
                 $("#ddz_97_firstgametime").html("");
                 
                 $("#ddz_98_onlinetime").html("");
                 $("#ddz_98_gamenum").html("");
                 $("#ddz_98_winscore").html("");
                 $("#ddz_98_losescore").html("");
                 $("#ddz_98_jinfen").html("");
                 $("#ddz_98_servicefee").html("");
                 $("#ddz_98_realjinfen").html("");
                 $("#ddz_98_lastjinfen").html("");
                 $("#ddz_98_lastgametime").html("");
                 $("#ddz_98_newestversion").html("");
                 $("#ddz_98_firstgametime").html("");
                 
                 $("#ddz_100_onlinetime").html("");
                 $("#ddz_100_gamenum").html("");
                 $("#ddz_100_winscore").html("");
                 $("#ddz_100_losescore").html("");
                 $("#ddz_100_jinfen").html("");
                 $("#ddz_100_servicefee").html("");
                 $("#ddz_100_realjinfen").html("");
                 $("#ddz_100_lastjinfen").html("");
                 $("#ddz_100_lastgametime").html("");
                 $("#ddz_100_newestversion").html("");
                 $("#ddz_100_firstgametime").html("");
                 
                 $("#ddz_177_onlinetime").html("");
                 $("#ddz_177_gamenum").html("");
                 $("#ddz_177_winscore").html("");
                 $("#ddz_177_losescore").html("");
                 $("#ddz_177_jinfen").html("");
                 $("#ddz_177_servicefee").html("");
                 $("#ddz_177_realjinfen").html("");
                 $("#ddz_177_lastjinfen").html("");
                 $("#ddz_177_lastgametime").html("");
                 $("#ddz_177_newestversion").html("");
                 $("#ddz_177_firstgametime").html("");
                 
                 
                 $("#ddz_101_onlinetime").html("");
                 $("#ddz_101_gamenum").html("");
                 $("#ddz_101_winscore").html("");
                 $("#ddz_101_losescore").html("");
                 $("#ddz_101_jinfen").html("");
                 $("#ddz_101_servicefee").html("");
                 $("#ddz_101_realjinfen").html("");
                 $("#ddz_101_lastjinfen").html("");
                 $("#ddz_101_lastgametime").html("");
                 $("#ddz_101_newestversion").html("");
                 $("#ddz_101_firstgametime").html("");
                 
                 $("#ddz_49_onlinetime").html("");
                 $("#ddz_49_gamenum").html("");
                 $("#ddz_49_winscore").html("");
                 $("#ddz_49_losescore").html("");
                 $("#ddz_49_jinfen").html("");
                 $("#ddz_49_servicefee").html("");
                 $("#ddz_49_realjinfen").html("");
                 $("#ddz_49_lastjinfen").html("");
                 $("#ddz_49_lastgametime").html("");
                 $("#ddz_49_newestversion").html("");
                 $("#ddz_49_firstgametime").html("");
                 
                 
                 $("#ddz_18_onlinetime").html("");
                 $("#ddz_18_gamenum").html("");
                 $("#ddz_18_winscore").html("");
                 $("#ddz_18_losescore").html("");
                 $("#ddz_18_jinfen").html("");
                 $("#ddz_18_servicefee").html("");
                 $("#ddz_18_realjinfen").html("");
                 $("#ddz_18_lastjinfen").html("");
                 $("#ddz_18_lastgametime").html("");
                  $("#ddz_18_newestversion").html("");
                 $("#ddz_18_firstgametime").html("");
                 
                  $("#ddz_20_onlinetime").html("");
                 $("#ddz_20_gamenum").html("");
                 $("#ddz_20_winscore").html("");
                 $("#ddz_20_losescore").html("");
                 $("#ddz_20_jinfen").html("");
                 $("#ddz_20_servicefee").html("");
                 $("#ddz_20_realjinfen").html("");
                 $("#ddz_20_lastjinfen").html("");
                 $("#ddz_20_lastgametime").html("");
                 $("#ddz_20_newestversion").html("");
                 $("#ddz_20_firstgametime").html("");
                 
                 $("#ddz_145_onlinetime").html("");
                 $("#ddz_145_gamenum").html("");
                 $("#ddz_145_winscore").html("");
                 $("#ddz_145_losescore").html("");
                 $("#ddz_145_jinfen").html("");
                 $("#ddz_145_servicefee").html("");
                 $("#ddz_145_realjinfen").html("");
                 $("#ddz_145_lastjinfen").html("");
                 $("#ddz_145_lastgametime").html("");
                 $("#ddz_145_newestversion").html("");
                 $("#ddz_145_firstgametime").html("");
                 
                 
                 $("#ddz_193_onlinetime").html("");
                 $("#ddz_193_gamenum").html("");
                 $("#ddz_193_winscore").html("");
                 $("#ddz_193_losescore").html("");
                 $("#ddz_193_jinfen").html("");
                 $("#ddz_193_servicefee").html("");
                 $("#ddz_193_realjinfen").html("");
                 $("#ddz_193_lastjinfen").html("");
                 $("#ddz_193_lastgametime").html("");
                 $("#ddz_193_newestversion").html("");
                 $("#ddz_193_firstgametime").html("");
                 
                 
                 $("#ddz_21_onlinetime").html("");
                 $("#ddz_21_gamenum").html("");
                 $("#ddz_21_winscore").html("");
                 $("#ddz_21_losescore").html("");
                 $("#ddz_21_jinfen").html("");
                 $("#ddz_21_servicefee").html("");
                 $("#ddz_21_realjinfen").html("");
                 $("#ddz_21_lastjinfen").html("");
                 $("#ddz_21_lastgametime").html("");
                 $("#ddz_21_newestversion").html("");
                 $("#ddz_21_firstgametime").html("");
                 
                 
                 $("#ddz_52_onlinetime").html("");
                 $("#ddz_52_gamenum").html("");
                 $("#ddz_52_winscore").html("");
                 $("#ddz_52_losescore").html("");
                 $("#ddz_52_jinfen").html("");
                 $("#ddz_52_servicefee").html("");
                 $("#ddz_52_realjinfen").html("");
                 $("#ddz_52_lastjinfen").html("");
                 $("#ddz_52_lastgametime").html("");
                 $("#ddz_52_newestversion").html("");
                 $("#ddz_52_firstgametime").html("");
                 
                 $("#ddz_all_onlinetime").html("");
                 $("#ddz_all_gamenum").html("");
                 $("#ddz_all_winscore").html("");
                 $("#ddz_all_losescore").html("");
                 $("#ddz_all_jinfen").html("");
                 $("#ddz_all_servicefee").html("");
                 $("#ddz_all_realjinfen").html("");
                 $("#ddz_all_lastjinfen").html("");
                 $("#ddz_all_lastgametime").html("");
                 $("#ddz_all_newestversion").html("");
                 $("#ddz_all_firstgametime").html("");
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
                       case "1":
                            {
                              $("#dzpk_1_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#dzpk_1_gamenum").html(datax[itemx]["gamenum"]);
                              $("#dzpk_1_winscore").html(datax[itemx]["winscore"]);
                              $("#dzpk_1_losescore").html(datax[itemx]["losescore"]);
                              $("#dzpk_1_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#dzpk_1_servicefee").html(datax[itemx]["servicefee"]);
                              $("#dzpk_1_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#dzpk_1_lastjinfen").html("");
                              $("#dzpk_1_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#dzpk_1_newestversion").html(datax[itemx]["newestversion"]);
                              $("#dzpk_1_firstgametime").html(datax[itemx]["firstgametime"]);
          
                                
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
                              $("#ddz_97_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_97_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                              $("#ddz_98_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_98_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                              $("#ddz_100_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_100_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                              
                               $("#ddz_177_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_177_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                           case "101":
                              $("#ddz_101_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_101_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_101_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_101_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_101_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_101_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_101_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_101_lastjinfen").html("");
                              $("#ddz_101_lastgametime").html(datax[itemx]["lastgametime"]);
                              
                              $("#ddz_101_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_101_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                            
                            
                            case "49":
                              $("#ddz_49_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_49_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_49_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_49_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_49_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_49_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_49_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_49_lastjinfen").html("");
                              $("#ddz_49_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_49_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_49_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                            
                         case "18":
                              $("#ddz_18_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_18_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_18_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_18_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_18_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_18_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_18_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_18_lastjinfen").html("");
                              $("#ddz_18_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_18_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_18_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                         case "20":
                              $("#ddz_20_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_20_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_20_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_20_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_20_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_20_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_20_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_20_lastjinfen").html("");
                              $("#ddz_20_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_20_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_20_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                        case "145":
                              $("#ddz_145_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_145_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_145_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_145_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_145_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_145_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_145_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_145_lastjinfen").html("");
                              $("#ddz_145_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_145_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_145_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                            
                            case "193":
                              $("#ddz_193_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_193_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_193_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_193_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_193_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_193_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_193_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_193_lastjinfen").html("");
                              $("#ddz_193_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_193_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_193_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                           case "21":
                              $("#ddz_21_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_21_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_21_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_21_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_21_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_21_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_21_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_21_lastjinfen").html("");
                              $("#ddz_21_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_21_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_21_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                            
                            case "52":
                              $("#ddz_52_onlinetime").html(datax[itemx]["onlinetime"]);
                              $("#ddz_52_gamenum").html(datax[itemx]["gamenum"]);
                              $("#ddz_52_winscore").html(datax[itemx]["winscore"]);
                              $("#ddz_52_losescore").html(datax[itemx]["losescore"]);
                              $("#ddz_52_jinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]));
                              $("#ddz_52_servicefee").html(datax[itemx]["servicefee"]);
                              $("#ddz_52_realjinfen").html(parseInt(datax[itemx]["winscore"]) - parseInt(datax[itemx]["losescore"]) - parseInt(datax[itemx]["servicefee"]) );
                              $("#ddz_52_lastjinfen").html("");
                              $("#ddz_52_lastgametime").html(datax[itemx]["lastgametime"]);
                              $("#ddz_52_newestversion").html(datax[itemx]["newestversion"]);
                              $("#ddz_52_firstgametime").html(datax[itemx]["firstgametime"]);
                              
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
                
               //  $("#ddz_145_newestversion").html(datax[itemx]["newestversion"]);
                 //             $("#ddz_145_firstgametime").html(datax[itemx]["firstgametime"]);
                
                      
                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/infodetail/get_game_status", packet, onsuccess, onerrors);
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
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"],allitem[currentcount]["alipay_account"],allitem[currentcount]["alipay_real_name"]);
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
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"],allitem[currentcount]["alipay_account"],allitem[currentcount]["alipay_real_name"]);
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
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"],allitem[currentcount]["alipay_account"],allitem[currentcount]["alipay_real_name"],allitem[currentcount]["alipay_account"],allitem[currentcount]["alipay_real_name"]);
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
            
            
            function sortNumber(a,b){
              return   b.value - a.value
             }
            
            function allreflesh(){
                var packet = {
                    action: 'get_online_data',
                };
                function onsuccess(data) {
                    var datax = eval("(" + data + ")");
                    var jin = datax["jindu"];
                    var cofee = datax["cofee"];
                    var all = [];
                    for (var itemx in jin){
                      var id = parseInt(jin[itemx]["id"]);
                      var coin = parseInt(jin[itemx]["user_chips"]);
                       all[id]=parseInt(coin);
                    }
                    
                    for (var itemx in cofee){
                      var id = parseInt(cofee[itemx]["userid"]);
                      var coin = parseInt(cofee[itemx]["cofferchips"]);
                      if(all[id] === undefined){
                          all[id]=parseInt(coin); 
                       }else{
                          all[id]=parseInt(all[id])+parseInt(coin); 
                       }
                   }
                   
                    var bbb =[];
                   for (var itemx in all){
                      bbb.push({userid:itemx,value:all[itemx] });
                    }
                    
                   bbb.sort(sortNumber);
                   var sum = 0;
                   
                   for(var i=0;i<50;i++){
                      sum = sum+ bbb[i]["value"];
                   }
                   alert("前50名金豆总和："+sum);
                   alert(objtostr(bbb));
                 }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/infodetail/get_all_data", packet, onsuccess, onerrors);
                
            }

            function get_online_data() {
                userid_back = $("#userid1").val();
                mac_back = $("#mac1").val();
                var packet = {
                    action: 'get_online_data',
                    mystarttime: $("#id_date_picker_1").val() + " " + $("#id_time_picker_1").val(),
                    myendtime: $("#id_date_picker_2").val() + " " + $("#id_time_picker_2").val(),
                    userid: $("#userid1").val(),
                    accountid: $("#accountid1").val(),
                    mac: $("#mac1").val(),
                    ip: $("#ip1").val(),
                    alipay_account: $('#alipay_account').val(),
                    alipay_name: $('#alipay_name').val(),
                    mobile:$('#mobile').val(),
                    is_recharge:$('#is_recharge').val()
                };
                function onsuccess(data) {
                    var datax = eval("(" + data + ")");
                    if (datax["status"] == "1") {
                        alert("userid或帐号至少填一个！");
                        return;
                    }
                    
                    allcount = datax.length;
                    currentcount =0;
                    allitem = datax;
                    allitem[currentcount]["allcount"] = allcount;
                    allitem[currentcount]["currentcount"] = currentcount +1;
                    allitem[currentcount]["last_login_time1"] = allitem[currentcount]["last_login_time"];
    
                    var rr = allitem[currentcount]["officalgiftinfo"];
                    if(rr.length>0){
                      var rx = rr.split(":");
                      rr = getdatetime1( rx[1])+"前，"+rx[0]+"次";
                    }
                    
                    allitem[currentcount]["officalgiftinfo1"]= rr;
                    // update_usemsg(datax["usemsg"]);
                     cleartable();
                    get_game_status(allitem[currentcount]["id"]);
                    get_block_status(allitem[currentcount]["ip"],allitem[currentcount]["id"],allitem[currentcount]["mac"],allitem[currentcount]["alipay_account"],allitem[currentcount]["alipay_real_name"]);
                    $("#tablecontent").html($("#tablemodel").tmpl( allitem[currentcount]));

                }
                function onerrors(data) {
                    // alert(objtostr(data))
                }
                // jQuery.comm.sendmessage(window.location.protocol + "//" + window.location.host + "/no3/infodetail/get_detail_data", packet, onsuccess, onerrors);
                jQuery.comm.sendmessage("<?php echo base_url()?>no3/infodetail/get_detail_data", packet, onsuccess, onerrors);
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

			if($("#userid1").val() != 0){
            	reflesh();
			}
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

                /*
                $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function() {
                    $(this).next().focus();
                });
                */

                /*
                $('#id_date_picker_1').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_1").focus();
                });
                $('#id_date_picker_2').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_2").focus();
                });
                $('#id_date_picker_3').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_3").focus();
                });
                $('#id_date_picker_4').datepicker({autoclose: true}).on(ace.click_event, function() {
                    $("#id_date_picker_4").focus();
                });

				$('#id_date_picker_3').datepicker({
					autoclose: true,
					beforeShow: function(a, b) {
				        setTimeout(function(){
				            $('.datepicker').css('z-index', 1051);
				        }, 0);
				    }
					});
				$('#id_date_picker_4').datepicker({autoclose: true});
                */

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
