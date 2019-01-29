<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'js/sdmenu.js?v=' . JS_VERSION?>"></script>
<script type="text/javascript">
// <![CDATA[
var myMenu;
$(document).ready(function(){
	myMenu = new SDMenu("my_menu");
	myMenu.init();
	$('a').click(function(){
		$('a').removeClass('current');
		$(this).addClass('current');
	});
});
// ]]>
</script>
</head>
<body class="nav_body">
 <div id="my_menu" class="sdmenu">
      <!--
      <div>
        <span>果果软件发布</span>
        <a href="<?php echo site_url('softpub/iphone')?>" target="mainframe">iPhone版</a>
        <a href="<?php echo site_url('softpub/android')?>" target="mainframe">Android版</a>
        <a href="<?php echo site_url('softpub/pc')?>" target="mainframe">PC版</a>
        <a href="<?php echo site_url('softpub/question')?>" target="mainframe">问题反馈</a>
      </div>
      -->
      <div>
        <span>查分</span>
        <?php if ($this->gid == 1 || $this->gid == 2) {?>
        <a href="<?php echo site_url('total')?>" target="mainframe">总分</a>
        <a href="<?php echo site_url('total/profit')?>" target="mainframe">净分统计</a>
        <a href="<?php echo site_url('total/top_user')?>" target="mainframe">筹码增加做多用户</a>
        <a href="<?php echo site_url('total/top_num')?>" target="mainframe">num数目</a>
        <a href="<?php echo site_url('total/reg_num')?>" target="mainframe">注册用户</a>
        <?php }?>
        <a href="<?php echo site_url('total/player_change_score')?>" target="mainframe">查用户加减分</a>
        <a href="<?php echo site_url('total/time_change_score')?>" target="mainframe">查时间点加减分</a>
      </div>
      <div>
        <span>购买</span>
        <a href="<?php echo site_url('purchase/recently')?>" target="mainframe">最近购买记录</a>
        <a href="<?php echo site_url('purchase/type')?>" target="mainframe">查询类型购买记录</a>
        <a href="<?php echo site_url('purchase/user')?>" target="mainframe">查询用户购买记录</a>
        <!--
        <a href="<?php echo site_url('purchase/insert')?>" target="mainframe">插入记录</a>
        -->
      </div>
      <div>
        <span>pokerjoin管理</span>
        <?php if ($this->gid == 1 || $this->gid == 2) {?>
        <a href="<?php echo site_url('user')?>" target="mainframe">帐号</a>
        <a href="<?php echo site_url('iptables')?>" target="mainframe">IP限制</a>
        <a href="http://www.pokerjoin.com/ports/giftmaker?a=100059&t=youguoadmin9527&f=iphone" target="mainframe">财产礼物</a>
        <a href="http://www.pokerjoin.com/ports/giftmaker/gd_props?a=100059&t=youguoadmin9527&f=iphone" target="mainframe">掼蛋道具</a>
        <a href="<?php echo site_url('viewlog')?>" target="mainframe">查看log</a>
        <a href="<?php echo site_url('avatar')?>" target="mainframe">头像</a>
        <?php }?>
      </div>
      <div>
        <span>三张牌new</span>
        <?php if ($this->gid == 1 || $this->gid == 2) {?>
        <a href="<?php echo site_url('user_new')?>" target="mainframe">帐号</a>
        <?php }?>
      </div>
</div>
</body>
</html>
