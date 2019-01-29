<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>报表</title>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="<?php echo $base_url; ?>report_static/jquery.min.js"></script>
    <style type="text/css">
        body {
            text-align: center;
            background-color: #305066;
        }
        .title {
            color: #22C3AA;
        }
		#bg {
		    position: fixed;
		    left: 0;
		    top: 0;
		    height: 100%;
		    width: 100%;
		    background-color: rgba(0, 0, 0, 0.5);
		    opacity: 1;
		    visibility: visible;
		    -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
		    -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
		    transition: opacity 0.3s 0s, visibility 0s 0s;
		    z-index:9999;
        	display:none;
		}
    </style>
</head>
<body>
<script type="text/javascript" src="<?php echo $base_url;?>report_static/H5lock.js"></script>
<script type="text/javascript">
var base_url = '<?php echo $base_url?>';
$(function(){ 
	if(!window.localStorage.getItem('username')){
		location.href = '<?php echo $base_url; ?>report/toLogin';
		return false;
	}else{
		new H5lock({
		    chooseType: 3
		}).init();
	}
}); 
</script>
<div id="bg"></div>
</body>
</html>