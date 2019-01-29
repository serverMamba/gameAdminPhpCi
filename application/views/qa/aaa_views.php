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
<script src="<?php echo$base_url; ?>report_static/bootstrap.min.js"></script>
<title>报表</title>
</head>
<body>
	<h4 id="login_status" style="color:black">加金币</h4>
		<div class="form-group">
			<label class="sr-only" for="username_s">用户ID</label>
			 <input type="text" class="form-control" id="user_id" name="user_id" placeholder="用户ID">
		</div>
		<div class="form-group">
			<label class="sr-only" for="username_s">确认用户ID</label>
			 <input type="text" class="form-control" id="user_id1" name="user_id1" placeholder="确认用户ID">
		</div>
		<div class="form-group">
			<label class="sr-only" for="username_s">金币</label>
			 <input type="text" class="form-control" id="gold" name="gold" placeholder="金币">
		</div>
		<div class="form-group">
			<label class="sr-only" for="pass_s">支付密码</label>
			 <input type="password" class="form-control" id="pass" name="pass" placeholder="支付密码">
		</div>
		<button type="submit" id="login_btn" class="btn btn-default" onclick="add();">确认</button>
</body>
<script type="text/javascript">
$(function(){ 
	
}); 

function add(){
	var user_id = $("#user_id").val();
	var user_id1 = $("#user_id1").val();
	if(user_id != user_id1){
		$('#login_status').html('用户ID必须一致');
		return false;
	}
	
	$.ajax({
        type: "POST",
        url: "<?php echo $base_url; ?>qpalzm/addGold",
        data: {user_id:$("#user_id").val(), pass:$("#pass").val(),gold:$("#gold").val()},
        dataType: "json",
        beforeSend: function(xhr){
            $('#login_btn').attr('disabled','disabled');
            $('#login_status').html('操作中，请稍后...');
        },
        success: function(data){
        	if(data.status == '1'){
            	alert('成功');
        		location.reload();
        		return true;
        	}else{
            	alert(data.msg);
				$('#login_status').html(data.msg);
				$('#login_btn').removeAttr('disabled');
				return false;
			}
        }
    });
}

</script>
</html>