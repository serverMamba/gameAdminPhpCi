<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo SITE_NAME?> - 系统登录</title>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.js?v=<?php echo JS_VERSION?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/common.js?v=<?php echo JS_VERSION?>"></script>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript">
if(top != self) top.location.href = '<?php echo site_url(LOGIN_URI)?>';
</script>
</head>

<body onload="document.getElementById('username').focus();">
<div class="login_warpping png_bg">
	<form id="login_form" action="<?php echo site_url('welcome/login_submit')?>" method="post" onsubmit="return check_login_submit();">
		<div class="login_msg" id="login_msg"><?php echo $msg?></div>
		<div class="login_label">帐号：</div>
		<div class="login_input"><input name="username" id="username" type="text" onkeypress="$('#login_msg').removeClass('login_green').html('');" /></div>
		<div class="login_label">密码：</div>
		<div class="login_input"><input name="password" id="password" type="password" onkeypress="$('#login_msg').removeClass('login_green').html('');" /></div>
		<div class="login_btn"><input type="hidden" name="gourl" id="gourl" value="<?php echo $gourl?>" /><input type="image" src="<?php echo base_url()?>images/login_btn.png" /></div>
	</form>
</div>
</body>
<script type="text/javascript">
if($.browser.msie && $.browser.version < 7) {
	$(document.body).html('<div style="margin:30px auto;padding:10px;text-align:center;border:1px solid #000;width:500px;"><h1 style="color:#ff0000;">IE6禁止入内</h1><h5>请升级你的IE版本，或使用Chrome、Safrai、Firefox、Opera等</h5></div>');
}
</script>
</html>