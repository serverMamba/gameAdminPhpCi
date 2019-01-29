<form action="<?php echo site_url('backuser/edit_password_submit')?>" method="get" id="edit_password_form" onsubmit="return check_edit_password_submit();">
	<table class="common_table_div">
		<tr>
			<th scope="row" width="80">帐 号</th>
			<td><label><?php echo $this->username?></label></td>
		</tr>
		<tr>
			<th scope="row">原密码：</th>
			<td><input type="password" name="password" id="password" onkeypress="$('.edit_password_msg').html('');" />&nbsp;&nbsp;<span id="password_error" class="edit_password_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">新的密码：</th>
			<td><input type="password" name="new_password" id="new_password" onkeypress="$('.edit_password_msg').html('');" />&nbsp;&nbsp;<span id="new_password_error" class="edit_password_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">重复密码：</th>
			<td><input type="password" name="new_password2" id="new_password2" onkeypress="$('.edit_password_msg').html('');" />&nbsp;&nbsp;<span id="new_password2_error" class="edit_password_msg td_error"></span></td>
		</tr>
		<tr>
			<th scope="row">&nbsp;</th>
			<td><input type="submit" name="submit" value="确认修改" /></td>
		</tr>
	</table>
</form>