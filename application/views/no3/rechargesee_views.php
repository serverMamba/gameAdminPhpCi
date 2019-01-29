<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>
	<style type="text/css"> 
		.float_header
		{
		 position: relative;
		 top: expression(eval(this.parentElement.parentElement.parentElement.scrollTop-2));
		 background-color: #5D7B9D;
		 color: White;
		 font-weight: bold;
		 height: 20px;
		 z-index: 2;
		}
	</style>
  <body>
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
                	<?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                	<?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>
					<div class="row">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 widget-container-span">
									<div class="widget-box">	
										<div class="widget-toolbox padding-8 clearfix">
											<table id="sample-table-2"
															class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
													<tr>
														<td>
															<label>玩家帐号</label>
														</td>
														<td>
															<select id="operation_id">
																<option value="4" <?php if("4" == $query['operation_id']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_id']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_id']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_id']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_id']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_id']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['id']){echo $query['id']; }?>"  type="text" id="id" style="left:5px;height:34px;width:100px;"/>
															<span id="span_id" style="display:<?php if($query['extra_id']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_id">
																	<option value="5" <?php if("5" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_id']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input type="text" value="<?php if($query['extra_id']){echo $query['extra_id']; }?>" id="extra_id" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_id" style="display:<?php if($query['extra_id']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('id');">+</button>
															</span>
															<span id="span_hide_id" style="display:<?php if($query['extra_id']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('id');">-</button>
															</span>											
														</td>
														
														<td>
															<label>玩家昵称</label>
														</td>
														<td>
															<select id="operation_nickname">
																<option value="4" <?php if("4" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_nickname']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['nickname']){echo $query['nickname']; }?>"  type="text" id="nickname" style="left:5px;height:34px;width:100px;"/>
															<span id="span_nickname" style="display:<?php if($query['extra_nickname']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_nickname">
																	<option value="5" <?php if("5" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_nickname']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_nickname']){echo $query['extra_nickname']; }?>" id="extra_nickname" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_nickname" style="display:<?php if($query['extra_nickname']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('nickname');">+</button>
															</span>
															<span id="span_hide_nickname" style="display:<?php if($query['extra_nickname']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('nickname');">-</button>
															</span>											
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>MAC地址</label>
														</td>
														<td>
															<select id="operation_mac">
																<option value="4" <?php if("4" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_mac']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['mac']){echo $query['mac']; }?>"  type="text" id="mac" style="left:5px;height:34px;width:100px;"/>
															<span id="span_mac" style="display:<?php if($query['extra_mac']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_mac">
																	<option value="5" <?php if("5" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_mac']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_mac']){echo $query['extra_mac']; }?>" id="extra_mac" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_mac" style="display:<?php if($query['extra_mac']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('mac');">+</button>
															</span>
															<span id="span_hide_mac" style="display:<?php if($query['extra_mac']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('mac');">-</button>
															</span>											
														</td>
														<td>
															<label>支付宝帐号</label>
														</td>
														<td>
															<select id="operation_alipay_account">
																<option value="4" <?php if("4" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_alipay_account']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['alipay_account']){echo $query['alipay_account']; }?>"  type="text" id="alipay_account" style="left:5px;height:34px;width:100px;"/>
															<span id="span_alipay_account" style="display:<?php if($query['extra_alipay_account']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_alipay_account">
																	<option value="5" <?php if("5" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_alipay_account']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_alipay_account']){echo $query['extra_alipay_account']; }?>" id="extra_alipay_account" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_alipay_account" style="display:<?php if($query['extra_alipay_account']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('alipay_account');">+</button>
															</span>
															<span id="span_hide_alipay_account" style="display:<?php if($query['extra_alipay_account']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('alipay_account');">-</button>
															</span>											
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>金币数</label>
														</td>
														<td>
															<select id="operation_user_chips">
																<option value="4" <?php if("4" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_user_chips']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['user_chips']){echo $query['user_chips']; }?>"  type="text" id="user_chips" style="left:5px;height:34px;width:100px;"/>
															<span id="span_user_chips" style="display:<?php if($query['extra_user_chips']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_user_chips">
																	<option value="5" <?php if("5" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_user_chips']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input type="text" value="<?php if($query['extra_user_chips']){echo $query['extra_user_chips']; }?>" id="extra_user_chips" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_user_chips" style="display:<?php if($query['extra_user_chips']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('user_chips');">+</button>
															</span>
															<span id="span_hide_user_chips" style="display:<?php if($query['extra_user_chips']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('user_chips');">-</button>
															</span>											
														</td>
														
														<td>
															<label>手机号</label>
														</td>
														<td>
															<select id="operation_boundmobilenumber">
																<option value="4" <?php if("4" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_boundmobilenumber']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['boundmobilenumber']){echo $query['boundmobilenumber']; }?>"  type="text" id="boundmobilenumber" style="left:5px;height:34px;width:100px;"/>
															<span id="span_boundmobilenumber" style="display:<?php if($query['extra_boundmobilenumber']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_boundmobilenumber">
																	<option value="5" <?php if("5" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_boundmobilenumber']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_boundmobilenumber']){echo $query['extra_boundmobilenumber']; }?>" id="extra_boundmobilenumber" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_boundmobilenumber" style="display:<?php if($query['extra_boundmobilenumber']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('boundmobilenumber');">+</button>
															</span>
															<span id="span_hide_boundmobilenumber" style="display:<?php if($query['extra_boundmobilenumber']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('boundmobilenumber');">-</button>
															</span>											
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>注册IP地址</label>
														</td>
														<td>
															<select id="operation_ip">
																<option value="4" <?php if("4" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_ip']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['ip']){echo $query['ip']; }?>"  type="text" id="ip" style="left:5px;height:34px;width:100px;"/>
															<span id="span_ip" style="display:<?php if($query['extra_ip']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_ip">
																	<option value="5" <?php if("5" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_ip']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_ip']){echo $query['extra_ip']; }?>" id="extra_ip" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_ip" style="display:<?php if($query['extra_ip']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('ip');">+</button>
															</span>
															<span id="span_hide_ip" style="display:<?php if($query['extra_ip']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('ip');">-</button>
															</span>											
														</td>
														
														<td>
															<label>最后登录IP地址</label>
														</td>
														<td>
															<select id="operation_lastLoginIp">
																<option value="4" <?php if("4" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>不等于</option>
																<option value="6" <?php if("6" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																<option value="7" <?php if("7" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																<option value="8" <?php if("8" == $query['operation_lastLoginIp']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
															</select>
															<input value="<?php if($query['lastLoginIp']){echo $query['lastLoginIp']; }?>"  type="text" id="lastLoginIp" style="left:5px;height:34px;width:100px;"/>
															<span id="span_lastLoginIp" style="display:<?php if($query['extra_lastLoginIp']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_lastLoginIp">
																	<option value="5" <?php if("5" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>不等于</option>
																	<option value="6" <?php if("6" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>部分匹配</option>
																	<option value="7" <?php if("7" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>前缀匹配</option>
																	<option value="8" <?php if("8" == $query['operation_extra_lastLoginIp']){ ?> selected="selected" <?php } ?>>后缀匹配</option>
																</select>
																<input type="text" value="<?php if($query['extra_lastLoginIp']){echo $query['extra_lastLoginIp']; }?>" id="extra_lastLoginIp" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_lastLoginIp" style="display:<?php if($query['extra_lastLoginIp']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('lastLoginIp');">+</button>
															</span>
															<span id="span_hide_lastLoginIp" style="display:<?php if($query['extra_lastLoginIp']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('lastLoginIp');">-</button>
															</span>											
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>累计充值总额</label>
														</td>
														<td>
															<select id="operation_totalBuy">
																<option value="4" <?php if("4" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_totalBuy']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['totalBuy']){echo $query['totalBuy']; }?>"  type="text" id="totalBuy" style="left:5px;height:34px;width:100px;"/>
															<span id="span_totalBuy" style="display:<?php if($query['extra_totalBuy']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_totalBuy">
																	<option value="5" <?php if("5" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_totalBuy']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input type="text" value="<?php if($query['extra_totalBuy']){echo $query['extra_totalBuy']; }?>" id="extra_totalBuy" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_totalBuy" style="display:<?php if($query['extra_totalBuy']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('totalBuy');">+</button>
															</span>
															<span id="span_hide_totalBuy" style="display:<?php if($query['extra_totalBuy']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('totalBuy');">-</button>
															</span>											
														</td>
														
														<td>
															<label>提现总额</label>
														</td>
														<td>
															<select id="operation_total_total_money">
																<option value="4" <?php if("4" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_total_total_money']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['total_total_money']){echo $query['total_total_money']; }?>"  type="text" id="total_total_money" style="left:5px;height:34px;width:100px;"/>
															<span id="span_total_total_money" style="display:<?php if($query['extra_total_total_money']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_total_total_money">
																	<option value="5" <?php if("5" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_total_total_money']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input type="text" value="<?php if($query['extra_total_total_money']){echo $query['extra_total_total_money']; }?>" id="extra_total_total_money" style="left:5px;height:34px;width:100px;"/>
															</span>
														</td>
														<td>
															<span id="span_show_total_total_money" style="display:<?php if($query['extra_total_total_money']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('total_total_money');">+</button>
															</span>
															<span id="span_hide_total_total_money" style="display:<?php if($query['extra_total_total_money']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('total_total_money');">-</button>
															</span>											
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>注册时间</label>
														</td>
														<td>
															<select id="operation_registertime">
																<option value="4" <?php if("4" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_registertime']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['registertime']){echo $query['registertime']; }?>" id="registertime" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_registertime" style="display:<?php if($query['extra_registertime']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_registertime">
																	<option value="5" <?php if("5" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_registertime']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input value="<?php if($query['extra_registertime']){echo $query['extra_registertime']; }?>" id="extra_registertime" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_registertime" style="display:<?php if($query['extra_registertime']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('registertime');">+</button>
															</span>
															<span id="span_hide_registertime" style="display:<?php if($query['extra_registertime']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('registertime');">-</button>
															</span>											
														</td>
														
														<td>
															<label>最后登录时间</label>
														</td>
														<td>
															<select id="operation_last_login_time">
																<option value="4" <?php if("4" == $query['operation_last_login_time']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="2" <?php if("2" == $query['operation_last_login_time']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="0" <?php if("0" == $query['operation_last_login_time']){ ?> selected="selected" <?php } ?>>等于</option>
															</select>
															<input value="<?php if($query['last_login_time']){echo $query['last_login_time']; }?>" id="last_login_time" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_last_login_time" style="display:<?php if($query['extra_last_login_time']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_last_login_time">
																	<option value="5" <?php if("5" == $query['operation_extra_last_login_time']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_last_login_time']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_last_login_time']){ ?> selected="selected" <?php } ?>>等于</option>
																</select>
																<input value="<?php if($query['extra_last_login_time']){echo $query['extra_last_login_time']; }?>" id="extra_last_login_time" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_last_login_time" style="display:<?php if($query['extra_last_login_time']){echo 'none';}else{echo 'block';}?>;">
																<button onclick="showExtraOpr('last_login_time');">+</button>
															</span>
															<span id="span_hide_last_login_time" style="display:<?php if($query['extra_last_login_time']){echo 'block';}else{echo 'none';}?>;">
																<button onclick="hideExtraOpr('last_login_time');">-</button>
															</span>
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>胜利局数</label>
														</td>
														<td>
															<select id="operation_win_game">
																<option value="4" <?php if("4" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_win_game']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['win_game']){echo $query['win_game']; }?>" id="win_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_win_game" style="display:<?php if($query['extra_win_game']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_win_game">
																	<option value="5" <?php if("5" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_win_game']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input value="<?php if($query['extra_win_game']){echo $query['extra_win_game']; }?>" id="extra_win_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_win_game" style="display:<?php if($query['extra_win_game']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('win_game');">+</button>
															</span>
															<span id="span_hide_win_game" style="display:<?php if($query['extra_win_game']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('win_game');">-</button>
															</span>											
														</td>
														
														<td>
															<label>失败局数</label>
														</td>
														<td>
															<select id="operation_lose_game">
																<option value="4" <?php if("4" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_lose_game']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['lose_game']){echo $query['lose_game']; }?>" id="lose_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_lose_game" style="display:<?php if($query['extra_lose_game']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_lose_game">
																	<option value="5" <?php if("5" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_lose_game']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input value="<?php if($query['extra_lose_game']){echo $query['extra_lose_game']; }?>" id="extra_lose_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_lose_game" style="display:<?php if($query['extra_lose_game']){echo 'none';}else{echo 'block';}?>;">
																<button onclick="showExtraOpr('lose_game');">+</button>
															</span>
															<span id="span_hide_lose_game" style="display:<?php if($query['extra_lose_game']){echo 'block';}else{echo 'none';}?>;">
																<button onclick="hideExtraOpr('lose_game');">-</button>
															</span>
														</td>
													</tr>
													<tr name="tr_condition_other">
														<td>
															<label>放弃局数</label>
														</td>
														<td>
															<select id="operation_draw_game">
																<option value="4" <?php if("4" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_draw_game']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['draw_game']){echo $query['draw_game']; }?>" id="draw_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_draw_game" style="display:<?php if($query['extra_draw_game']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_draw_game">
																	<option value="5" <?php if("5" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_draw_game']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input value="<?php if($query['extra_draw_game']){echo $query['extra_draw_game']; }?>" id="extra_draw_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_draw_game" style="display:<?php if($query['extra_draw_game']){echo 'none';}else{echo 'block';}?>">
																<button onclick="showExtraOpr('draw_game');">+</button>
															</span>
															<span id="span_hide_draw_game" style="display:<?php if($query['extra_draw_game']){echo 'block';}else{echo 'none';}?>">
																<button onclick="hideExtraOpr('draw_game');">-</button>
															</span>											
														</td>
														
														<td>
															<label>总局数</label>
														</td>
														<td>
															<select id="operation_sum_game">
																<option value="4" <?php if("4" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																<option value="5" <?php if("5" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																<option value="2" <?php if("2" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>大于</option>
																<option value="3" <?php if("3" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>小于</option>
																<option value="0" <?php if("0" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>等于</option>
																<option value="1" <?php if("1" == $query['operation_sum_game']){ ?> selected="selected" <?php } ?>>不等于</option>
															</select>
															<input value="<?php if($query['sum_game']){echo $query['sum_game']; }?>" id="sum_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															<span id="span_sum_game" style="display:<?php if($query['extra_sum_game']){echo 'block';}else{echo 'none';}?>">
																<label>并且</label>
																<select id="operation_extra_sum_game">
																	<option value="5" <?php if("5" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>小于等于</option>
																	<option value="4" <?php if("4" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>大于等于</option>
																	<option value="2" <?php if("2" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>大于</option>
																	<option value="3" <?php if("3" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>小于</option>
																	<option value="0" <?php if("0" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>等于</option>
																	<option value="1" <?php if("1" == $query['operation_extra_sum_game']){ ?> selected="selected" <?php } ?>>不等于</option>
																</select>
																<input value="<?php if($query['extra_sum_game']){echo $query['extra_sum_game']; }?>" id="extra_sum_game" type="text" data-date-format="yyyy-mm-dd" style = "margin-left:5px;height:30px;width:100px;"  />
															</span>
														</td>
														<td>
															<span id="span_show_sum_game" style="display:<?php if($query['extra_sum_game']){echo 'none';}else{echo 'block';}?>;">
																<button onclick="showExtraOpr('sum_game');">+</button>
															</span>
															<span id="span_hide_sum_game" style="display:<?php if($query['extra_sum_game']){echo 'block';}else{echo 'none';}?>;">
																<button onclick="hideExtraOpr('sum_game');">-</button>
															</span>
														</td>
													</tr>
												</table>
												<div class="widget-main"  style="padding: 0;">
													<button onclick="queryInfoUsers();"  class="btn btn-danger" style="border: none;margin-bottom: 10px;">查询玩家</button>
													<button id="showOrHideConBtn" onclick="showOrHideCondition();" class="btn btn-danger" style="border: none;margin-bottom: 10px;">-</button>
													<span><font color="red">数据量巨大，默认只查询1周内数据</font></span>											
												</div>	
												<div id="paramFromDiv" style="padding: 0;"></div>
                                        </div>  
                                        <hr style="height:1px;border:none;border-top:1px solid #555555;" /> 
                                        <div class="widget-body">
											<div class="widget-main" style="padding: 0;">
												<div>
													<table id="sample-table-2"
														class="table table-striped table-bordered table-hover" style="margin-bottom: 10px;">
														<thead id="targethead">
															<tr>
																<th>玩家帐号</th>
																<th>玩家昵称</th>
																<th>支付宝帐号</th>
																<th>支付宝名称</th>
																<th>手机号</th>
																<th>金币数</th>
																<th>充值总额</th>
																<th>提现总额</th>
																<th>注册MAC地址</th>
																<th>注册IP地址</th>
																<th>注册时间</th>
																<th>最后登录时间</th>
																<th>胜利游戏数</th>
																<!--  -->
																<th>失败游戏数</th>
																<th>放弃游戏数</th>
																<th>总游戏数</th>
															</tr>
														</thead>
														<tbody id="tbody">
														<?php if(!empty($user_info_list)){ foreach ($user_info_list as $v){ ?>
															<tr >
																<td><?php if($v['id']){ echo $v['id'];}else{echo '';}?></td>
																<td><?php if($v['nickname']){ echo $v['nickname'];}else{echo '';}?></td>
																<td><?php if($v['alipay_account']){ echo $v['alipay_account'];}else{echo '';}?></td>
																<td><?php if($v['alipay_real_name']){ echo $v['alipay_real_name'];}else{echo '';}?></td>
																<td><?php if($v['boundmobilenumber']){ echo $v['boundmobilenumber'];}else{echo '';}?></td>
																<td><?php if($v['user_chips']){ echo $v['user_chips'];}else{echo '0';}?></td>
																<td><?php if($v['totalBuy']){ echo $v['totalBuy'];}else{echo '0';}?></td>
																<td><?php if($v['total_total_money']){ echo $v['total_total_money'];}else{echo '0';}?></td>
																<td><?php if($v['mac']){ echo $v['mac'];}else{echo '';}?></td>
																<td><?php if($v['ip']){ echo $v['ip'];}else{echo '';}?></td>
																<td style="width:100px;"><?php if($v['registertime']){ echo $v['registertime'];}else{echo '-';}?></td>
																<td style="width:100px;"><?php if($v['last_login_time']){ echo date("Y-m-d h:i:s", $v['last_login_time']);}else{echo '-';}?></td>
																<td><?php if($v['win_game']){ echo $v['win_game'];}else{echo '0';}?></td><!--  -->
																<td><?php if($v['lose_game']){ echo $v['lose_game'];}else{echo '0';}?></td>
																<td><?php if($v['draw_game']){ echo $v['draw_game'];}else{echo '0';}?></td>
																<td><?php if($v['sum_game']){ echo $v['draw_game'];}else{echo '0';}?></td>
																 <?php } ?>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div id="pagechangediv" class="modal-footer no-margin-top">
						<?php echo $pageContent;?>
					</div>
				</div>
				<!-- /.page-content -->
			</div>
			<!-- /.main-content -->
			<!-- /#ace-settings-container -->
		</div>
		<!-- /.main-container-inner -->
	</div>
	<!-- /.main-container -->
	
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/date-time/bootstrap-datepicker.min.js'; ?>"></script>
    <script src="<?php echo base_url().'res/js/date-time/bootstrap-timepicker.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	
	<script src="../res/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="../res/js/date-time/bootstrap-timepicker.min.js"></script>
    <script src="../res/js/date-time/moment.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>
    <script src="../res/js/date-time/daterangepicker.min.js"></script>	
	<script type="text/javascript">
	$(function(){
		if($('#registertime'))
		{
			$('#registertime').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#registertime").focus();
			});
		}
		if($('#registertime'))
		{
			$('#extra_registertime').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#extra_registertime").focus();
			});
		}
		if($('#registertime'))
		{
			$('#last_login_time').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#last_login_time").focus();
			});
		}
		if($('#registertime'))
		{
			$('#extra_last_login_time').datepicker({autoclose:true}).on(ace.click_event, function(){
				$("#extra_last_login_time").focus();
			});
		}
	});
	function showExtraOpr(eleid)
	{
		if($("#span_"+eleid))
		{
			$("#span_"+eleid).attr("style", "display:block;");
		}
		if($("#span_hide_"+eleid))
		{
			$("#span_hide_"+eleid).attr("style", "display:block;");
		}
		if($("#span_show_"+eleid))
		{
			$("#span_show_"+eleid).attr("style", "display:none;");
		}
		//document.getElementById("span_"+eleid).setAttribute("style", "display:block;");
		//document.getElementById("span_hide_"+eleid).setAttribute("style", "display:block;");
		//document.getElementById("span_show_"+eleid).setAttribute("style", "display:none;");
	}

	function hideExtraOpr(eleid)
	{
		if($("#extra_"+eleid))
		{
			$("#extra_"+eleid).val("");
		}
		if($("#span_"+eleid))
		{
			$("#span_"+eleid).attr("style", "display:none;");
		}
		if($("#span_hide_"+eleid))
		{
			$("#span_hide_"+eleid).attr("style", "display:none;");
		}
		if($("#span_show_"+eleid))
		{
			$("#span_show_"+eleid).attr("style", "display:block;");
		}
		//document.getElementById("span_"+eleid).setAttribute("style", "display:none;");
		//document.getElementById("span_hide_"+eleid).setAttribute("style", "display:none;");
		//document.getElementById("span_show_"+eleid).setAttribute("style", "display:block;");
	}
	function showOrHideCondition()
	{
		//document.getElementById("showOrHideConBtn");
		var labelOld = $("#showOrHideConBtn").text();
		if("+"==labelOld)
		{
			$("tr[name='tr_condition_other']").show();
		}
		else
		{
			$("tr[name='tr_condition_other']").hide();
		}
		var labelNew = "+"==labelOld?"-":"+";
		$("#showOrHideConBtn").text(labelNew);
	}
	function queryInfoUsers()
	{
		var url_users = "<?php echo site_url('no3/rechargesee/index'); ?>";
		url_users += "?page=<?php echo $currPage; ?>";
		doQueryInfoUsers(url_users);
	}
	function doQueryInfoUsers(url_users)
	{
		var keyArr = new Array("id", "nickname", "registertime", "ip", "mac", "alipay_account", "totalBuy", "lastLoginIp", "user_chips", "total_total_money", "boundmobilenumber", "last_login_time", "win_game", "lose_game", "draw_game", "sum_game");
		var params = {};
		for(var i=0; i<keyArr.length; i++)
		{
			var keystr = keyArr[i];
			params[""+keystr] = $("#"+keystr).val();
			params["operation_"+keystr] = $("#operation_"+keystr).val();
			params["extra_"+keystr] = $("#extra_"+keystr).val();
			params["operation_extra_"+keystr] = $("#operation_extra_"+keystr).val();
			/**
			if("last_login_time"==keystr)
			{
				if(""!=params[""+keystr].trim())
				{
					params[""+keystr] = new Date($("#"+keystr).val()).getTime()/1000+"";
				}
				if(""!=params["extra_"+keystr].trim())
				{
					params[""+keystr] = new Date($("#extra_"+keystr).val()).getTime()/1000+"";
				}
			}**/
		}
		
		//var url_users = "<?php echo site_url('no3/rechargesee/index'); ?>";
		
		post(url_users, params);
	}

	function post(URL, PARAMS) {        
	    var temp = document.createElement("form");        
	    temp.action = URL;        
	    temp.method = "post";        
	    temp.style.display = "none";   
	    var res = "";     
	    for (var x in PARAMS) {        
	        var opt = document.createElement("textarea");        
	        opt.name = x;        
	        opt.value = PARAMS[x];//"\'"+PARAMS[x]+"\'"; 
	        if(typeof(opt.value) == "undefined" || null==opt.value || "undefined"==opt.value)
		    {
	        	opt.value = "";
			}       
	        temp.appendChild(opt);

	        res += opt.name+"->"+opt.value+",";        
	    }  
	    document.getElementById("paramFromDiv").innerHTML = "";
	    document.getElementById("paramFromDiv").appendChild(temp);         
	    //document.body.appendChild(temp);        
	    temp.submit(); 
	    return temp;        
	}
	
	String.prototype.trim= function(){  
	    // 用正则表达式将前后空格  
	    // 用空字符串替代。  
	    return this.replace(/(^\s*)|(\s*$)/g, "");  
	}
	
	</script> 
</body>
</html>