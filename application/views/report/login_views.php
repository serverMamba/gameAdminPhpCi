<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet"
	href="<?php echo $base_url; ?>report_static/bootstrap.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="<?php echo $base_url; ?>report_static/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="<?php echo $base_url; ?>report_static/bootstrap.min.js"></script>
<title>报表</title>
</head>
<body style="background:url('<?php echo $base_url; ?>images/ppp.jpg') no-repeat;">
	<h4 id="login_status" style="color:white">请登录</h4>
		<div class="form-group">
			<label class="sr-only" for="username_s">用户名</label>
			 <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
		</div>
		<div class="form-group">
			<label class="sr-only" for="pass_s">密码</label>
			 <input type="password" class="form-control" id="pass" name="pass" placeholder="密码">
		</div>
		<button type="submit" id="login_btn" class="btn btn-default" onclick="login();">登录</button>
</body>
<script type="text/javascript">
$(function(){ 
	
}); 

function login(){
	$.ajax({
        type: "POST",
        url: "<?php echo $base_url; ?>report/login",
        data: {username:$("#username").val(), pass:$("#pass").val()},
        dataType: "json",
        beforeSend: function(xhr){
            $('#login_btn').attr('disabled','disabled');
            $('#login_status').html('登录中,请稍后...');
        },
        success: function(data){
        	if(data.status == '1'){
        		$('#login_status').html(data.msg);
        		window.localStorage.setItem('username', data.username);
        		window.localStorage.setItem('password', data.password);
        		window.localStorage.removeItem('passwordxx');
                window.localStorage.removeItem('chooseType');
        		location.href = '<?php echo $base_url; ?>report/xciwhinsdfiofnsdkfn';
        		return true;
        	}else{
				$('#login_status').html(data.msg);
				$('#login_btn').removeAttr('disabled');
				return false;
			}
        }
    });
}

</script>
</html>