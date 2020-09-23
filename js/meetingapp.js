$(function(){

	$('#zip').on('keyup',function(){
		//〒から住所取得
		$.ajax({
			url: "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" + $('#zip').val(),
			data: 'get',
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
	//ログアウト確認
	$('#logout').on('click',function(){
		var res = confirm('本当にログアウトしますか？');
		if(res==true){
			return true;
		}else {
			return false;
		}
	});	
	
	//アイテム削除確認

	//見積書・請求書投稿最終確認
	$('.sub_file').submit(function(){
		var res =confirm('選択したデータをこのまま投稿しますか？？');
		if(res==true){
			return true;
		}else{
			return false;
		}
	});
	//プラン更新最終確認
	$('.update_plan').submit(function(){
		var res =confirm('プランを変更すると登録済みお客様プラン内容も変更・更新されますが、更新して問題ないですか？');
		if(res==true){
			return true;
		}else{
			return false;
		}
	});
	
  //scheduleページの期限が過ぎているものがあるかないかチェックして表示する用
	var limit = $('tr').hasClass('over');
	if(limit){
		$('span.limit_over').text(' *期限過ぎた項目があります');
		//console.log('期限切れあり');
	}
	
	//ランダムメッセージ（指定日以外の表示用/指定日はDBから何日前かによって表示される別メッセージ）
	var MessageRandomList = [
		'公式インスタグラムもあります。ぜひのぞいてみて撮影イメージ膨らませてみください。',
		'衣装お悩みではないですか？悩んだから、HPのギャラリーを見たり、試着したりして、じっくり検討してみましょう！',
		'撮影が近づいてくるとお天気がきになりますよね？どんなお天気でもカメラマンさんに頑張ってもらいますが、大雨＆台風だけはカメラマンさんでもどうにもできません。。。',
		'大吉！今日はきっといいことあるよ！',
		'希望ショットはありますか？もしなくてもカメラマンさんがおふたりと撮影場所、衣装のイメージで素敵にアレンジしてくれるので、お任せでも大丈夫です。',
		'撮影前日は早く眠れるように、早め早めの準備をしましょう。',
		'手元ショット希望の場合は、花嫁ネイルも忘れずに♪',
		'ヘアメイクリハーサルをしない場合でも、希望のヘア＆メイクのイメージ準備を忘れずにね！',
		'衣装選びが結婚式も前撮りもフォトWも、花嫁さんには一番楽しい準備みたいだよ',
		'花嫁和装肌着は襟足しっかり開いているタイプを忘れずに♪',
		'屋外なら愛犬と一緒の撮影もできるかも？希望の方は相談してね。',
		'和装の色掛下＆色小物が最近人気急上昇中！',
		'撮影小物使うのも楽しいけど、たくさんすぎると時間足りなくなっちゃうから優先順位も考えなきゃだよ！',
		'アルバムは手元に＆形に残るアイテム。ぜひ実物みてふたりの思い出のカタチを選びましょう！'
	];
	var randomNum = Math.floor( Math.random()*14 );
	var message = MessageRandomList[randomNum];
	
	//通常メッセージが空ならの指定ができないので、両方表示することにいったんする。
	if($('.msg').text() ==''){
		$('.msg_random').text(message);
	}
	$('.msg_random').text(message);

	
	//続き読むのやつ
	var itemHeights = [];
	var returnHeight;
	$(function(){
	  $('.td_detail_item').each(function(){ //ターゲット(縮めるアイテム)
	    var thisHeight = $(this).height(); //ターゲットの高さを取得
	    itemHeights.push(thisHeight); //それぞれの高さを配列に入れる
	    $(this).addClass('is-hide'); //CSSで指定した高さにする
	    returnHeight = $(this).height(); //is-hideの高さを取得
	  });
	});
	$('.td_detail_trigger').click(function(){ //トリガーをクリックしたら
	  if(!$(this).hasClass('is-show')) {
	    var index = $(this).index('.td_detail_trigger'); //トリガーが何個目か
	    var addHeight = itemHeights[index]; //個数に対応する高さを取得
	    $(this).addClass('is-show').next().animate({height: addHeight},200).removeClass('is-hide'); //高さを元に戻す
	  } else {
	    $(this).removeClass('is-show').next().animate({height: returnHeight},200).addClass('is-hide'); //高さを制限する
	  }
	});
	
	//password表示・非表示
	$('.toggle-password').click(function(){
		// iconの切り替え
		$(this).toggleClass('fa-eye fa-eye-slash');
		// 入力フォームの取得
		let input = $(this).parent().parent().parent().parent().find('input');
		// type切替
		if (input.attr('type') == 'password') {
			input.attr('type', 'text');
		} else {
			input.attr('type', 'password');
		}
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

