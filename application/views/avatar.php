<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SITE_NAME?></title>
<link rel="stylesheet" href="<?php echo base_url() . 'css/common.css?v=' . CSS_VERSION?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() . 'css/bootstrap.min.css?v=' . CSS_VERSION?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js?v=' . JS_VERSION?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'js/bootstrap.min.js?v=' . JS_VERSION?>"></script>
<style type="text/css">
    .info{display: none;}
    .pagination ul > li > a{padding: 0 5px;}
    .pagination ul > li.cur > a{color:green;font-weight:bold;}
    .gray {
        -moz-filter: grayscale(100%);
    }
/*
    .imgbox img {border:2px solid #fff;}
    .imgbox img.remove {border:2px solid red;}
*/
</style>
</head>
<body>

<div class="pagination" style="height:280px;">
    <ul>
<?php
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$current_dir = $_GET['d'];
if (empty($current_dir)) {
    $current_dir = '00';
}
$range = split(' ', '0 1 2 3 4 5 6 7 8 9 a b c d e f');

for ($i=0; $i<count($range); $i++) {
    for ($j=0; $j<count($range); $j++) {
        $dir = $range[$i] . $range[$j];
        if ($dir == $current_dir) {
            echo '<li class="cur"><a href="' . $url . '?d=' .  $dir . '">'. $dir .'</a></li>';
        } else {
            echo '<li><a href="' . $url . '?d=' .  $dir . '">'. $dir .'</a></li>';
        }
    }
}

?>
    </ul>
</div>

<div id="imgbox" class="imgbox">
<?php 

$idx = substr($current_dir, 0, 1);
$ips = array(
    '223.4.7.62',
    '223.4.174.186',
    '223.4.30.237',
    '223.4.178.26'
);

$area = array(
    array('0', '1', '2', '3'),
    array('4', '5', '6', '7'),
    array('8', '9', 'a', 'b'),
    array('c', 'd', 'e', 'f')
);

for ($i = 0; $i<count($area); $i++) {
    if (in_array($idx, $area[$i])) {
       $ip = $ips[$i];
       break;
    }
}

echo '<br />';
echo "Server IP is : $ip <br />";
//$pics = file_get_contents('http://'. $ip .'/list.php?d=' . $current_dir);
$pics = file_get_contents('http://'. $ip .'/pic.php?d=' . $current_dir);
//var_dump($pics);
$arr = split('.png', $pics);
//var_dump($arr);
foreach ($arr as $val) {
    $param = split('/', $val);
    $uid   = $param[2];
    echo '<img src="http://face.pokerjoin.com/' . trim($val) . '.png" title="' . $uid .'" />';
    //echo 'src="http://face.pokerjoin.com/' . trim($val) . '.png<br />"';
} 
?>
</div>
<script>
$(function(){
    $('#imgbox').delegate('img', 'click', function(){
        var uid = $(this).attr('title').split('_')[0];
        if (confirm('确定要清空' + uid + '的头像字段么？')) {
            deleteUserAvatar(uid, $(this));
        }
        //var uid = 137944; 
        //$(this).addClass('remove');
    });
})

function deleteUserAvatar(uid, jimg) {
    var account = $('#j_account').attr('value');
    var key = 'user_faceurl';
    var val = '';

    $.ajax({
        type: 'get',
            url: 'user/update_user_info',
            data: {account: uid, key: key, val : val, comment: '清空不健康头像图片字段'},
            dataType: 'json',
            success: function(ret) {
                if (ret.result == 1) {
                    alert('用户' + uid + '的头像字段已清空');
                    jimg.hide(); 
                } else {
                    alert(ret.msg);
                }
            }
    });
}
</script>
</body>
</html>
