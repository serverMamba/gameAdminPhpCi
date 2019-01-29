<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('gt')) {
	 function gt($timex)
        {
           $mysplit = explode("-", $timex);
           $myyear = $mysplit[0];
           $mymonth = substr("00" . $mysplit[1], -2);
           $myday = substr("00" . $mysplit[2], -2);
           //return $myyear."-".$mymonth."-".$myday;
           return $myyear.$mymonth.$myday;
        }
}

if (!function_exists('get_ip_info')) {

    function get_ip_info($ip) {
        $url  = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=$ip";
        $port = 80;
        
        $response = file_get_contents($url);
        $response = split(' ', $response);
        $response = substr($response[3], 0, -1);
        $rrr =  json_decode($response);
        return $ip.":".$rrr->country."，".$rrr->city."，".$rrr->district."，".$rrr->isp;
    }
}


if(!function_exists('time_between_to_html')) {
	function time_between_to_html($when_time, $current_time = false) {
		$when_time = intval($when_time);
		$current_time = $current_time !== false ? intval($current_time) : time();
		
		if($when_time < 1 || $current_time < 1) {
			return '';
		}
		
		$second = abs($when_time - $current_time);
		
		if($second >= 86400) return floor($second / 86400) . '天前';
		if($second >= 3600) return floor($second / 3600) . '小时前';
		if($second >= 60) return floor($second / 60) . '分钟前';
		return '刚刚';
	}
}

if(!function_exists('date_between_to_html')) {
	function date_between_to_html($date) {
		return time_between_to_html(@strtotime($date));
	}
}

if(!function_exists('get_user_face')) {
	function get_user_face($user_faceurl, $size) {
		$face_host = 'http://face.91guoguo.com';
		
		if(empty($user_faceurl)) {
			return $face_host . '/default.gif';
		}
		
		$sizes = array(30,50,80,130);
		if(!in_array($size,$sizes)){
			$size = 30;
		}
		$v = '_'.$size.'.';
	
		return $face_host . str_replace('_130.', $v, $user_faceurl);
	}
}

if(!function_exists('simple_page_info')) {
	function simple_page_info($page_url, $page = 1, $pernum = 30, $cur_page_num = 0) {
		$html = '<p>';
		
		if($page != 1) { //如果不是第一页，则一定有上一页
			$html .= '<a href="'. str_replace('{page}', $page - 1, $page_url) .'">上一页</a>';
			$html .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $page;
		}
		
			
		
		if($cur_page_num >= $pernum) { //如果当前页条目数是满页显示的，则认为还有下一页
			if($html == '<p>') $html .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $page;
			
			$html .= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'. str_replace('{page}', $page + 1, $page_url) .'">下一页</a>';
		}
		
		$html .= '</p>';
		
		return $html;
	}
}

if(!function_exists('common_page_info')) {
	function common_page_info($totalpage, $curr_page, $page_url, $side_num = 5) {
		$html = '';
		
		if($curr_page < 1) $curr_page = 1;
		if($curr_page > $totalpage) $totalpage = $curr_page;
		
		if($totalpage < 2) {
			return $html;
		}
		
		$html .= '<div id="pageNav" class="blueFoot" style="text-align: right;">';
		if($curr_page > 1) {
			$html .= '<a class="pageBtn" href="' . str_replace('{page}', $curr_page - 1, $page_url) . '" title="上一页">&lt;&lt; 上一页</a>';
		} else {
			//$html .= '<a href="javascript:;" onclick="alert(this.title);" title="已是首页" class="pageBtn">&lt;&lt;上一页</a>';
		}
		
		$num_start = $curr_page - $side_num;
		$num_end = $curr_page + $side_num;
		
		if($num_start < 1) {
			$num_start = 1;
			$num_end = $num_start + ($side_num * 2);
		}
		
		if($num_end > $totalpage) {
			$num_end = $totalpage;
			$num_start = $num_end - ($side_num * 2);
			if($num_start < 1) $num_start = 1;
		}
		
		for($num = $num_start; $num <= $num_end; $num++) {
			$html .= $num == $curr_page ? '<strong>'. $num .'</strong>' : '<a href="' . str_replace('{page}', $num, $page_url) . '" title="第'. $num .'页">'. $num .'</a>';
		}
		
		if($curr_page != $totalpage) {
			$html .= '<a href="' . str_replace('{page}', $curr_page + 1, $page_url) . '" title="下一页" class="pageBtn">下一页 &gt;&gt;</a>';
		} else {
			//$html .= '<a href="javascript:;" onclick="alert(this.title);" title="已是尾页" class="pageBtn">下一页 &gt;&gt;</a>';
		}
		$html .= '</div>';
		
		return $html;
	}
}