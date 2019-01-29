<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.js'?>"></script>
<title>test</title>
</head>
<body>
	<div style="float: left;width:40%;">
		<div id="a"></div>
		<div id="b"></div>
		<div id="c"></div>
	</div>
	<div style="float: left;width:60%;">
		<div id="pro"></div>
	</div>
	<script type="text/javascript">
		var timer1;
		var step = 0;
		var line = '<br/>';
		var a_id = 0;
		var a_persion = [];
		var a_color = 'red';
		var b_id = 0;
		var b_persion = [];
		var b_color = 'blue';
		var c_id = 0;
		var c_persion = [];
		var c_color = 'black';
		var process_cards = [];
		var dizhu_id = 0;
		var s = 0;
		$(function() {
			$('#a').css('color',a_color);
			$('#b').css('color',b_color);
			$('#c').css('color',c_color);
			var log = '104094:12|31|11|01|2d|1d|0d|1a|19|09|18|37|27|06|33|13|03|*|104123:32|02|3d|3b|2b|3a|0a|29|08|36|26|16|35|25|15|05|23|*|104127:4f|4e|22|21|3c|2c|1c|0c|1b|0b|2a|39|38|28|17|07|34|24|14|04|*|104127:1b|2a|39|28|17$104123:35|25|15|05$104094:0$104127:3c|2c|1c|0c$104123:0$104094:0$104127:07$104123:08$104094:09$104127:0b$104123:3d$104094:12$104127:0$104123:0$104094:27|33|13|03$104127:34|24|14|04$104123:0$104094:0$104127:38$104123:29$104094:31$104127:22$104123:0$104094:0$104127:4f|4e$104123:0$104094:0$104127:21$';
			var log_array = log.split('|*|');
			process_cards = log_array[3].split('$');
			var tmp = process_cards[0].split(':');
			dizhu_id = tmp[0];
			
			setPersionCard(log_array[0], 'a');
			setPersionCard(log_array[1], 'b');
			setPersionCard(log_array[2], 'c');
			
			timer1 = setInterval("processCard()", 1000);
		});

		function processCard() {
			if (step > process_cards.length || process_cards[step] == '') {
				clearInterval(timer1);
				return false;
			}
			var value = process_cards[step];
			var out = '';
			var every_hand_ary = value.split(':');
			var user_id = every_hand_ary[0];
			var process_car = every_hand_ary[1];
			
			if(user_id == a_id){
				out += '<div style="color:'+a_color+'">';
			}else if(user_id == b_id){
				out += '<div style="color:'+b_color+'">';
			}else{
				out += '<div style="color:'+c_color+'">';
			}
			
			if (process_car == '0') {
				s ++;
				if(dizhu_id == user_id){
					out += '地主 ' + user_id + '不要';	
				}else{
					out += '农民 ' + user_id + '不要';
				}
			} else {
				s = 0;
				if(dizhu_id == user_id){
					out += '地主 ' + user_id + '出牌:';	
				}else{
					out += '农民 ' + user_id + '出牌:';
				}
				var card_ary1 = process_car.split('|');
				out += gerenalCardList(card_ary1);
				$.each(card_ary1, function(key, value) {
					if (a_id == user_id) {
						a_persion.splice($.inArray(value, a_persion), 1);
						if(dizhu_id == a_id){
							$('#a').html('地主 ' + a_id + ':' + gerenalCardList(a_persion));
						}else{
							$('#a').html('农民 ' + a_id + ':' + gerenalCardList(a_persion));
						}
					} else if (b_id == user_id) {
						b_persion.splice($.inArray(value, b_persion), 1);
						if(dizhu_id == b_id){
							$('#b').html('地主 ' + b_id + ':' + gerenalCardList(b_persion));
						}else{
							$('#b').html('农民 ' + b_id + ':' + gerenalCardList(b_persion));
						}
					} else {
						c_persion.splice($.inArray(value, c_persion), 1);
						if(dizhu_id == c_id){
							$('#c').html('地主 ' + c_id + ':' + gerenalCardList(c_persion));
						}else{
							$('#c').html('农民 ' + c_id + ':' + gerenalCardList(c_persion));
						}
					}
				});
			}
			out += '</div>';
			$('#pro').append(out);
			step++;
			if(s == 2){
				$('#pro').append('<hr>');
			}
		}

		function setPersionCard(cards, p) {
			var card_ary = cards.split(':');
			if (p == 'a') {
				a_id = card_ary[0];
				a_persion = card_ary[1].split('|');
				if(dizhu_id == a_id){
					$('#' + p).html('地主 ' + a_id + ':' + gerenalCardList(a_persion));
				}else{
					$('#' + p).html('农民 ' + a_id + ':' + gerenalCardList(a_persion));
				}
			} else if (p == 'b') {
				b_id = card_ary[0];
				b_persion = card_ary[1].split('|');
				if(dizhu_id == b_id){
					$('#' + p).html('地主 ' + b_id + ':' + gerenalCardList(b_persion));
				}else{
					$('#' + p).html('农民 ' + b_id + ':' + gerenalCardList(b_persion));
				}
			} else {
				c_id = card_ary[0];
				c_persion = card_ary[1].split('|');
				if(dizhu_id == c_id){
					$('#' + p).html('地主 ' + c_id + ':' + gerenalCardList(b_persion));
				}else{
					$('#' + p).html('农民 ' + c_id + ':' + gerenalCardList(b_persion));
				}
			}
		}

		function gerenalCardList(cards_ary) {
			var content = '';
			$.each(cards_ary, function(key, value) {
				content += '<span class="card">' + getCard(value) + '</span>';
			});
			return content;
		}

		function getCard(card_num) {
			var card = card_num.toString();
			if (card.length == 1) {
				card = '0' + card;
			}

			var color = '';
			var num = '';

			switch (card[0]) {
			case '0':
				color = '&clubs;';
				break;
			case '1':
				color = '&diams;';
				break;
			case '2':
				color = '&hearts;';
				break;
			case '3':
				color = '&spades;';
				break;
			default:
				color = '';
				break;
			}

			switch (card[1]) {
			case '1':
				num = 'A';
				break;
			case 'a':
				num = '10';
				break;
			case 'b':
				num = 'J';
				break;
			case 'c':
				num = 'Q';
				break;
			case 'd':
				num = 'K';
				break;
			case 'e':
				num = '小王';
				break;
			case 'f':
				num = '大王';
				break;
			default:
				num = card[1];
				break;
			}

			if (card[1] == 'e' || card[1] == 'f') {
				return num;
			}
			return color + num;
		}
	</script>
</body>
</html>