<div id="add_user" style="display:none;">
<form action="<?php echo site_url('backuser/add_user_submit')?>" method="get" id="add_user_form" onsubmit="return check_add_user_submit();">
	<table class="common_table_div">
		<tr>
			<th align="center" colspan="2">添加用户<div style="float:right;padding-right: 7px;"><a href="javascript:;" onclick="hidden_add_user()" title="放弃添加用户"><img src="<?php echo base_url()?>images/close.gif" border="0" /></a></div></th>
		</tr>
		<tr>
			<th scope="row" width="80">帐号：</th>
			<td><input type="text" name="add_username" id="add_username" maxlength="64" onkeypress="$('.add_user_msg').html('');" />&nbsp;&nbsp;<span id="add_username_error" class="add_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">密码：</th>
			<td><input type="password" name="add_password" id="add_password" maxlength="64" onkeypress="$('.add_user_msg').html('');" />&nbsp;&nbsp;<span id="add_password_error" class="add_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">用户组：</th>
			<td>
			<select name="add_gid" id="add_gid" onchange="$('.add_user_msg').html('');">
				<?php foreach($groups as $key => $var):?>
				<option value="<?php echo $key?>"><?php echo $var?></option>
				<?php endforeach;?>
			</select><span id="add_gid_error" class="add_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">真实姓名：</th>
			<td><input type="text" name="add_realname" id="add_realname" maxlength="64" onkeypress="$('.add_user_msg').html('');" />&nbsp;&nbsp;<span id="add_realname_error" class="add_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">&nbsp;</th>
			<td><input type="submit" name="submit" value="确认添加" /></td>
		</tr>
	</table>
</form>
</div>

<div id="edit_user" style="display:none">
<form action="<?php echo site_url('backuser/edit_user_submit')?>" method="get" id="edit_user_form" onsubmit="return check_edit_user_submit();">
	<table class="common_table_div">
		<tr>
			<th align="center" colspan="2">修改用户(<span id="edit_curr_username">&nbsp;</span>)<div style="float:right;padding-right: 7px;"><a href="javascript:;" onclick="hidden_edit_user()" title="放弃修改用户"><img src="<?php echo base_url()?>images/close.gif" border="0" /></a></div></th>
		</tr>
		<tr>
			<td colspan="2" align="center">注意：以下输入项如果留空则视为不修改该项</td>
		</tr>
		<tr>
			<th scope="row" width="110">UID</th>
			<td><label id="edit_uid_label">-1</label></td>
		</tr>
		<tr>
			<th scope="row">帐号(可不填)：</th>
			<td><input type="text" name="edit_username" id="edit_username" maxlength="64" onkeypress="$('.edit_user_msg').html('');" />&nbsp;&nbsp;<span id="edit_username_error" class="edit_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">密码(可不填)：</th>
			<td><input type="password" name="edit_password" id="edit_password" maxlength="64" onkeypress="$('.edit_user_msg').html('');" />&nbsp;&nbsp;<span id="edit_username_error" class="edit_password_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">用户组：</th>
			<td>
			<select name="edit_gid" id="edit_gid" onchange="$('.edit_user_msg').html('');">
				<?php foreach($groups as $key => $var):?>
				<option value="<?php echo $key?>"><?php echo $var?></option>
				<?php endforeach;?>
			</select>&nbsp;&nbsp;<span id="edit_gid_error" class="edit_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">真实姓名(可不填)：</th>
			<td><input type="text" name="edit_realname" id="edit_realname" maxlength="64" onkeypress="$('.edit_user_msg').html('');" />&nbsp;&nbsp;<span id="edit_realname_error" class="edit_user_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">&nbsp;</th>
			<td><input type="hidden" name="edit_uid" id="edit_uid" value="-1" /><input type="submit" name="submit" value="确认修改" /></td>
		</tr>
	</table>
</form>
</div>

<table class="common_table_div" style="width:700px;">
	<tr>
		<th colspan="9" align="center">用户列表</th>
	</tr>
	<tr>
		<th>UID</th>
		<th>帐号</th>
		<th>用户组</th>
		<th>真实姓名</th>
		<th>登录次数</th>
		<th>最后登录时间</th>
		<th>最后登录IP</th>
		<th>创建时间</th>
		<th><div id="add_user_btn"><button onclick="add_user()">添加新用户</button></div></th>
	</tr>
	<?php foreach($all_user as $var):?>
	<tr>
		<td><?php echo $var['uid']?></td>
		<td><?php echo $var['username']?></td>
		<td><?php echo $groups[$var['gid']]?></td>
		<td><?php echo $var['realname']?></td>
		<td><?php echo $var['login_count']?></td>
		<td><?php echo $var['last_login_time']?></td>
		<td><?php echo $var['last_login_ip']?></td>
		<td><?php echo $var['created_time']?></td>
		<td><a href="javascript:;" onclick="edit_user(<?php echo $var['uid'] . ",'" . $var['username'] . "'," . $var['gid'] . ",'" . $var['realname'] . "'"?>)">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="delete_user(<?php echo $var['uid'] . ",'" . $var['username'] . "'"?>)">删除</a></td>
	</tr>
	<?php endforeach?>
</table>
