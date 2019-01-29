<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('no3/common/header'); ?>

    <body>
    <?php $this->load->view('no3/common/message'); ?>

    <div class="main-container" id="main-container">
		<script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
        </script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#"> <span
				class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <?php $this->load->view('no3/common/nav_shortcut'); ?>

                <?php $this->load->view('no3/common/nav_left1'); ?>

                <div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"
						data-icon1="icon-double-angle-left"
						data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
			</div>

			<div class="main-content">
                <?php $this->load->view('no3/common/nav_top'); ?>
				
                <div class="page-content">
                	<?php if($this->session->flashdata('success')){ ?><div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div><?php } ?>
                	<?php if($this->session->flashdata('error')){ ?><div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?></div><?php } ?>
					
					<div class="row">
						<div class="col-xs-12">
							<div style="float: left;width:40%;">
								<div id="lz" style="display:none;"></div>
								<div id="a"></div>
								<div id="b"></div>
								<div id="c"></div>
							</div>
							<div style="float: left;width:60%;">
								<div id="pro"></div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.page-content -->
			</div>
			<!-- /.main-content -->
			<!-- /#ace-settings-container -->
		</div>
		<!-- /.main-container-inner -->
	</div>
	<!-- /.main-container -->
	<script src="<?php echo base_url().'res/js/jquery-2.0.3.min.js'; ?>"></script>
	<script
		src="<?php echo base_url().'res/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
		<script src="<?php echo base_url().'res/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace-elements.min.js'; ?>"></script>
	<script src="<?php echo base_url().'res/js/ace.min.js'; ?>"></script>
	<script>
	var timer1;
	var step = 0;
	var line = '<br/>';
	
	var a_id = 0;
	var a_persion = [];
	var a_color = 'red';
	var a_is_ming = 0;
	
	var b_id = 0;
	var b_persion = [];
	var b_color = 'blue';
	var b_is_ming = 0;
	
	var c_id = 0;
	var c_persion = [];
	var c_color = 'black';
	var c_is_ming = 0;
	
	var process_cards = [];
	var dizhu_id = 0;
	var s = 0;
	var laizi = 0;
	$(function() {
		$('#a').css('color',a_color);
		$('#b').css('color',b_color);
		$('#c').css('color',c_color);
		var log = '<?php echo $play_record['play_record']; ?>';
		var log_array = log.split('|*|');
		var type = '<?php echo $type; ?>';
		if(type == '1'){
			var persion_a_ary = log_array[0].split(':');
			a_id = persion_a_ary[0];
			var persion_b_ary = log_array[1].split(':');
			b_id = persion_b_ary[0];
			var persion_c_ary = log_array[2].split(':');
			c_id = persion_c_ary[0];
			
			process_cards = log_array[3].split('$');
			var tmp = process_cards[0].split(':');
			dizhu_id = tmp[0];
			
			setPersionCard(log_array[0], 'a');
			setPersionCard(log_array[1], 'b');
			setPersionCard(log_array[2], 'c');
		}else if(type == '2'){
			var persion_a_ary = log_array[1].split(':');
			a_id = persion_a_ary[0];
			var persion_b_ary = log_array[2].split(':');
			b_id = persion_b_ary[0];
			var persion_c_ary = log_array[3].split(':');
			c_id = persion_c_ary[0];
			
			if(log_array[0] != ''){
				var ming_ary = log_array[0].split('|');
				$.each(ming_ary, function(kk, vv) {
					if(a_id == vv){
						a_is_ming = 1;
					}else if(b_id == vv){
						b_is_ming = 1;
					}else if(c_id == vv){
						c_is_ming = 1;
					}
				});
			}
			
			process_cards = log_array[4].split('$');
			var tmp = process_cards[0].split(':');
			dizhu_id = tmp[0];
			
			setPersionCard(log_array[1], 'a');
			setPersionCard(log_array[2], 'b');
			setPersionCard(log_array[3], 'c');
		}else if(type == '3'){
			var persion_a_ary = log_array[2].split(':');
			a_id = persion_a_ary[0];
			var persion_b_ary = log_array[3].split(':');
			b_id = persion_b_ary[0];
			var persion_c_ary = log_array[4].split(':');
			c_id = persion_c_ary[0];
			
			laizi = getLaizi(log_array[0]);
			$('#lz').html('癞子牌: ' + laizi);
			$('#lz').show();
			
			if(log_array[1] != ''){
				var ming_ary = log_array[1].split('|');
				$.each(ming_ary, function(kk, vv) {
					if(a_id == vv){
						a_is_ming = 1;
					}else if(b_id == vv){
						b_is_ming = 1;
					}else if(c_id == vv){
						c_is_ming = 1;
					}
				});
			}
			
			
			process_cards = log_array[5].split('$');
			var tmp = process_cards[0].split(':');
			dizhu_id = tmp[0];

			setPersionCard(log_array[2], 'a');
			setPersionCard(log_array[3], 'b');
			setPersionCard(log_array[4], 'c');
		}
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
				var show = '';
				if (a_id == user_id) {
					a_persion.splice($.inArray(value, a_persion), 1);
					if(a_is_ming == 1){
						show += '明 ';
					}

					if(dizhu_id == a_id){
						show += '地主 ';
					}else{
						show += '农民 ';
					}

					$('#a').html(show + a_id + ':' + gerenalCardList(a_persion));
				} else if (b_id == user_id) {
					b_persion.splice($.inArray(value, b_persion), 1);
					if(b_is_ming == 1){
						show += '明 ';
					}

					if(dizhu_id == b_id){
						show += '地主 ';
					}else{
						show += '农民 ';
					}
					
					$('#b').html(show + b_id + ':' + gerenalCardList(b_persion));
				} else {
					c_persion.splice($.inArray(value, c_persion), 1);
					if(c_is_ming == 1){
						show += '明 ';
					}

					if(dizhu_id == c_id){
						show += '地主 ';
					}else{
						show += '农民 ';
					}
					$('#c').html(show + c_id + ':' + gerenalCardList(c_persion));
				}
			});
		}
		out += '</div>';
		$('#pro').append(out);
		step++;
		if(s == 2){
			$('#pro').append('<hr>');
			s = 0;
		}
	}

	function setPersionCard(cards, p) {
		var show = '';
		var card_ary = cards.split(':');
		if (p == 'a') {
			a_persion = card_ary[1].split('|');
			if(a_is_ming == 1){
				show += '明 ';
			}
			
			if(dizhu_id == a_id){
				show += '地主 ';
			}else{
				show += '农民 ';
			}
			$('#' + p).html(show + a_id + ':' + gerenalCardList(a_persion));
		} else if (p == 'b') {
			b_persion = card_ary[1].split('|');
			if(b_is_ming == 1){
				show += '明 ';
			}
			
			if(dizhu_id == b_id){
				show += '地主 ';
			}else{
				show += '农民 ';
			}			
			$('#' + p).html(show + b_id + ':' + gerenalCardList(b_persion));
		} else {
			c_persion = card_ary[1].split('|');
			if(c_is_ming == 1){
				show += '明 ';
			}

			if(dizhu_id == c_id){
				show += '地主 ';
			}else{
				show += '农民 ';
			}
			$('#' + p).html(show + c_id + ':' + gerenalCardList(c_persion));
		}
	}

	function gerenalCardList(cards_ary) {
		var content = '';
		$.each(cards_ary, function(key, value) {
			content += '<span class="card">' + getCard(value) + '</span>';
		});
		return content;
	}


	function getLaizi(card_num){
		var num = '';
		// 先转成16进制，然后第一位表示花色，第二位表示牌
		var card = parseInt(card_num).toString(16);

		return getCard(card);
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
