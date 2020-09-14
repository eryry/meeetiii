$(function(){


	$('#zip').on('keyup',function(){
		//〒から住所取得
		$.ajax({
			url: "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" + $('#zip').val(),
			data: 'get',
			//
			dataType: 'jsonp',
		})
		.done(function(d){
			console.log(d);
			if(d.results) {
				setData(d.results[0]);
			}
		})
		.fail(function(){
			console.log('NG');
		});
	});

	function setData(d) {
		$('#address').val(d.address1 + d.address2 + d.address3);
	}
	
	
	$('.all_day').on('click',function(){
	
	
	});
	
	//顧客情報をボタン押されたときに予約日で振り分けて表示するのをajaxでやろうと思ったけどできなかった痕跡
	/*
	$('.all_day').on('click',function(){
		let group_id = $(this).data('group_id');
		$.ajax({
			url : '../api/get_group_data.php',
			type: 'get',
			data: {'group_id': group_id},
			dataType: 'json',
		})
		.done(function(d){
			console.log(d);
			$('#mailView').css('display','block');
			$('#group_id').text(d.group_id);
			$('#reserve_day').text(d.reserve_day);
			$('#p_name').text(d.p_name);
			$('#g_name').text(d.g_name);
			$('#b_name').text(d.b_name);
		})
		.fail(function(){
			alert('失敗しました');
		});
	});
	*/
	

});

