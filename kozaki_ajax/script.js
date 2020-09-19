$(function(){

	$('#l_cat').on('change',function(){
		$.ajax({
			url : 'api.php',
			type: 'get',
			dataType: 'json',
			data: {'cat':$('#l_cat').val()},
		}).done(function(data){
			$('#l_name').empty();
			$('#l_name').css('opacity',0);
			for(i=0;i<data.length;i++) {
				let element = $('<li>').text(data[i].menu);
				$('#l_name').append(element);
			}
			$('#l_name').animate({'opacity':1},1000);
		}).fail(function(data){
			alert("通信しっぱい");
		});
	});
	
});

