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

});

