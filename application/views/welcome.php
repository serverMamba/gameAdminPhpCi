
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>六六游戏</title>
<meta name="Keywords" content="六六游戏" />
<meta name="Description" content="六六游戏" />

</head>
<style>
@charset "utf-8";
body {
	padding-bottom:35%;
	background:#000 url(<?php echo base_url().'/images/web/bg.jpg';?>) no-repeat center top;
	background-size:100%;
}
* {
	padding:0;
	margin:0;
}
#header {
	width:100%;
	margin:0 auto;
	margin-bottom:20em;
}
#header img {
	width:100%;
}
#down {
	padding:15% 0 2% 9%;
	width:90%;
}
#down img {
	width:45%;
}
#footer {
	padding:10% 0 2% 4%;
	margin:5% 0 0 4%;
	width:90%;
	background:url(<?php echo base_url().'/images/web/foot.png';?>) no-repeat center top;
	background-size:100%;
}
#footer ul {
}
#footer ul li {
	float:left;
	width:28%;
}
#footer ul li#b,#footer ul li#c {
	margin-left:5%;
}
#footer img {
	width:100%;
}
/*当页面大于1200px 时，大屏幕，主要是PC 端*/
@media (min-width: 1200px) {
#header {
	margin-bottom:35em;
}
}
/*在992 和1199 像素之间的屏幕里，中等屏幕，分辨率低的PC*/
@media (min-width: 992px) and (max-width: 1199px) {
#header {
	margin-bottom:25em;
}
}
/*在768 和991 像素之间的屏幕里，小屏幕，主要是PAD*/
@media (min-width: 768px) and (max-width: 991px) {
}
/*在480 和767 像素之间的屏幕里，超小屏幕，主要是手机*/
@media (min-width: 480px) and (max-width: 767px) {
#header {
	margin-bottom:15em;
}
}
/*在小于480 像素的屏幕，微小屏幕，更低分辨率的手机*/
@media (max-width: 479px) {
#header {
	margin-bottom:14em;
}
}
</style>
<body>
<div id="header">
	<a href="javascript:void(0); "class="download" id="all_download_btn"><img src="<?php echo base_url().'/images/web/head.png';?>" atl="六六游戏" /></a>
	<img src="<?php echo base_url().'/images/web/kefu.png';?>" height="20" style="float:right;width: auto;margin-top: -25px;margin-right: 10%;"/>
</div>
<div id="down">
	<a href="javascript:void(0); "class="download" id="android_download_btn"><img src="<?php echo base_url().'/images/web/ad.png';?>" atl="安卓下载" /></a>
	<a href="javascript:void(0); "class="download" id="ios_download_btn"><img src="<?php echo base_url().'/images/web/ap.png';?>" atl="苹果下载" /></a>
</div>
<div id="footer">
	<ul>
	<li id="a"><img src="<?php echo base_url().'/images/web/1.png';?>" atl="六六游戏" /></li>
	<li id="b"><img src="<?php echo base_url().'/images/web/2.png';?>" atl="六六游戏" /></li>
	<li id="c"><img src="<?php echo base_url().'/images/web/3.png';?>" atl="六六游戏" /></li>
	<li id="a"><img src="<?php echo base_url().'/images/web/4.png';?>" atl="六六游戏" /></li>
	<li id="b"><img src="<?php echo base_url().'/images/web/5.png';?>" atl="六六游戏" /></li>
	<li id="c"><img src="<?php echo base_url().'/images/web/6.png';?>" atl="六六游戏" /></li>
	</ul>
</div>
</body>
</html>