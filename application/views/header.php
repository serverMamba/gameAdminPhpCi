<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'js/art_dialog.js?v=' . JS_VERSION?>"></script>
</head>
<body>
<div id="header">
	<div class="logo"><a href="<?php echo site_url(DEFAULT_PAGE_URI)?>" target="_top" title="回到系统默认页"><?php echo SITE_NAME?></a></div>
	<div class="sys_btn">
		<?php if($this->gid == 1):?>
		<a href="javascript:;" onclick="art.dialog.load('<?php echo site_url('backuser/user_manage')?>', {title: '用户管理',noFn:true,noText:'关闭',id:'user_manage_artdialog'}, false);"><span class="btn_side left"></span><span class="btn_side middle">用户管理</span><span class="btn_side right"></span></a>
		<?php endif;?>
		<a href="javascript:;" onclick="art.dialog.load('<?php echo site_url('backuser/edit_password')?>', {title: '修改密码',noFn:true,noText:'关闭',id:'edit_password_artdialog'}, false);"><span class="btn_side left"></span><span class="btn_side middle">修改密码</span><span class="btn_side right"></span></a>
		<a href="<?php echo site_url('welcome/logout')?>" target="_top"><span class="btn_side left"></span><span class="btn_side middle">退出系统</span><span class="btn_side right"></span></a>
	</div>
</div>
</body>
</html>