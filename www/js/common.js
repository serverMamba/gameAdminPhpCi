function check_login_submit() {
	var username = $.trim($('#username').val());
	var password = $('#password').val();
	var gourl = $('#gourl').val();
	var action = $('#login_form').attr('action') + '?callback=?';
	
	if(username == '') {
		$('#login_msg').html('需要输入帐号才能进行登录');
		$('#username').focus();
		return false;
	}
	
	if(password == '') {
		$('#login_msg').html('需要输入密码才能进行登录');
		$('#password').focus();
		return false;
	}

	$.getJSON(action,{username:username,password:password,gourl:gourl},function(json){
		if(json.result == 1) {
			$('#login_msg').addClass('login_green').html('身份验证通过，正在接入系统...');
			self.location.href = json.msg;
		} else {
			$('#login_msg').html(json.msg);
		}

	}).error(function(){
		$('#login_msg').html('网络或服务错误，请检查你的网络连接或稍候再试');
	});
	
	return false;
}

function check_edit_password_submit() {
	var password 		= $('#password').val();
	var new_password 	= $('#new_password').val();
	var new_password2 	= $('#new_password2').val();
	var action 			= $('#edit_password_form').attr('action') + '?callback=?';

	if(password == '') {
		$('#password_error').html('必须填写原密码');
		$('#password').focus();
		return false;
	}

	if(new_password == '') {
		$('#new_password_error').html('新的密码不能为空');
		$('#new_password').focus();
		return false;
	}

	if(new_password != new_password2) {
		$('#new_password2_error').html('新的密码和重复密码不一致');
		$('#new_password2').focus();
		return false;
	}

	$.getJSON(action,{password:password,new_password:new_password,new_password2:new_password2},function(json){
		switch(json.result) {
			case 1:
				art.dialog.get('edit_password_artdialog').close();
				art.dialog({title:'修改密码',content:' 修改密码成功 ',icon:'succeed',yesFn:true});
				break;
			case 2:
				$('#password_error').html('必须填写原密码');
				$('#password').focus();
				break;
			case 3:
				$('#new_password_error').html('新的密码不能为空');
				$('#new_password').focus();
				break;
			case 4:
				$('#new_password2_error').html('新的密码和重复密码不一致');
				$('#new_password2').focus();
				break;
			case 5:
				$('#password_error').html('原密码输入错误');
				$('#password').focus();
				break;
			case -1:
				top.location.reload();
				break;
			default:
				art.dialog.get('edit_password_artdialog').close();
				art.dialog({title:'修改密码',content:'系统繁忙，请稍候再试',icon:'error',yesFn:true});
		}
	}).error(function(){
		art.dialog.get('edit_password_artdialog').close();
		art.dialog({title:'修改密码',content:'网络或服务错误，请检查你的网络连接或稍候再试',icon:'error',yesFn:true});
	});

	return false;
}

function edit_user(uid, username, gid, realname) {
	$('#add_user').hide();
	$('#add_user_btn').show();
	$('#edit_user').slideUp('normal',function(){
		$('#edit_uid_label').html(uid);
		$('#edit_username').val(username);
		$('#edit_gid').val(gid);
		$('#edit_realname').val(realname);
		$('#edit_uid').val(uid);
		$('#edit_curr_username').html(username);
		
		$(this).slideDown('normal',function(){
			art.dialog.get('user_manage_artdialog').position();
			$('#edit_password').focus();
		});
	});
}

function hidden_edit_user() {
	$('#edit_user').slideUp('normal',function(){
		art.dialog.get('user_manage_artdialog').position();
		$('.edit_user_msg').html('');
	});
}

function add_user() {
	$('#edit_user').hide();
	$('#add_user_btn').hide();
	$('#add_user').slideDown('normal',function(){
		art.dialog.get('user_manage_artdialog').position();
		$('#add_username').focus();
	});
}

function hidden_add_user() {
	$('#add_user').slideUp('normal',function(){
		$('#add_user_btn').show();
		art.dialog.get('user_manage_artdialog').position();
		$('.add_user_msg').html('');
	});
}

function check_add_user_submit() {
	var username = $('#add_username').val();
	var password = $('#add_password').val();
	var gid = $('#add_gid').val();
	var realname = $('#add_realname').val();
	var action = $('#add_user_form').attr('action') + '?callback=?';
	
	if(username == '') {
		$('#add_username_error').html('必须输入一个帐号名，该帐号名将作为登录帐号');
		$('#add_username').focus();
		return false;
	}
	
	if(password == '') {
		$('#add_password_error').html('必须输入一个密码，该密码将作为登录密码');
		$('#add_password').focus();
		return false;
	}
	
	if(realname == '') {
		$('#add_realname_error').html('必须输入真实姓名以便更有效的标识用户');
		$('#add_realname').focus();
		return false;
	}
	
	var title = '添加用户';
	$.getJSON(action,{username:username,password:password,gid:gid,realname:realname},function(json){
		switch(json.result) {
			case 1:
				art.dialog({title:title,content:' 添加新用户成功 ',icon:'succeed',yesFn:true,closeFn:function(){
					art.dialog.get('user_manage_artdialog').close();
					art.dialog.load('/backuser/user_manage', {title: '用户管理',noFn:true,noText:'关闭',id:'user_manage_artdialog'}, false);
				}});
				break;
			case 2:
				$('#add_username_error').html('必须输入一个帐号名，该帐号名将作为登录帐号');
				$('#add_username').focus();
				break;
			case 3:
				$('#add_password_error').html('必须输入一个密码，该密码将作为登录密码');
				$('#add_password').focus();
				break;
			case 4:
				$('#add_gid_error').html('不存在的用户组别');
				$('#add_gid').focus();
				break;
			case 5:
				$('#add_realname_error').html('必须输入真实姓名以便更有效的标识用户');
				$('#add_realname').focus();
				break;
			case 6:
				$('#add_username_error').html('该帐号已经存在，请换个帐号名');
				$('#add_username').focus();
				break;
			case -1:
				top.location.reload();
				break;
			case -3:
				art.dialog.get('user_manage_artdialog').close();
				art.dialog({title:title,content:'你没有权限进行此操作',icon:'error',yesFn:true});
				break;
			default:
				art.dialog({title:title,content:'系统繁忙，请稍候再试',icon:'error',yesFn:true});
		}
	}).error(function(){
		art.dialog({title:title,content:'网络或服务错误，请检查你的网络连接或稍候再试',icon:'error',yesFn:true});
	});
	
	return false;
}

function delete_user(uid, username) {
	var title = '删除用户';
	art.dialog.confirm(title, '确认要删除 ' + username + ' 这个帐号吗？', function(){
		$.getJSON('backuser/delete_user_submit?callback=?',{uid:uid},function(json){
			switch(json.result) {
				case 1:
					art.dialog.get('user_manage_artdialog').close();
					art.dialog.load('/backuser/user_manage', {title: title,noFn:true,noText:'关闭',id:'user_manage_artdialog'}, false);
					break;
				case 2:
					art.dialog({title:title,content:'系统必须要保证至少有一个管理员权限的用户存在',icon:'alert',yesFn:true});
					break;
				case -1:
					top.location.reload();
					break;
				case -3:
					art.dialog.get('user_manage_artdialog').close();
					art.dialog({title:title,content:'你没有权限进行此操作',icon:'error',yesFn:true});
					break;
				default:
					art.dialog({title:title,content:'系统繁忙，请稍候再试',icon:'error',yesFn:true});
			}
		}).error(function(){
			art.dialog({title:title,content:'网络或服务错误，请检查你的网络连接或稍候再试',icon:'error',yesFn:true});
		});
	});
}

function check_edit_user_submit() {
	var uid = $('#edit_uid').val();
	var username = $('#edit_username').val();
	var password = $('#edit_password').val();
	var gid = $('#edit_gid').val();
	var realname = $('#edit_realname').val();
	var action = $('#edit_user_form').attr('action') + '?callback=?';
	
	var title = '修改用户';
	$.getJSON(action,{uid:uid,username:username,password:password,gid:gid,realname:realname},function(json){
		switch(json.result) {
			case 1:
				art.dialog({title:title,content:' 修改用户成功 ',icon:'succeed',yesFn:true,closeFn:function(){
					art.dialog.get('user_manage_artdialog').close();
					art.dialog.load('/backuser/user_manage', {title: '用户管理',noFn:true,noText:'关闭',id:'user_manage_artdialog'}, false);
				}});
				break;
			case 2:
				$('#edit_gid_error').html('不存在的用户组别');
				$('#edit_gid').focus();
				break;
			case 3:
				art.dialog({title:title,content:'系统必须要保证至少有一个管理员权限的用户存在',icon:'alert',yesFn:true});
				$('#edit_gid').focus();
				break;
			case 4:
				$('#edit_username_error').html('该帐号已经存在，请换个帐号名');
				$('#edit_username').focus();
				break;
			case -1:
				top.location.reload();
				break;
			case -3:
				art.dialog.get('user_manage_artdialog').close();
				art.dialog({title:title,content:'你没有权限进行此操作',icon:'error',yesFn:true});
				break;
			default:
				art.dialog({title:title,content:'系统繁忙，请稍候再试',icon:'error',yesFn:true});
		}
	}).error(function(){
		art.dialog({title:title,content:'网络或服务错误，请检查你的网络连接或稍候再试',icon:'error',yesFn:true});
	});
	
	return false;
}
