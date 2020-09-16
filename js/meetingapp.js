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
	//ログアウト確認
	$('#logout').on('click',function(){
		let res = confirm('本当にログアウトしますか？');
		if(res==true){
			return true;
		}else {
			return false;
		}
	});	
	
	//アイテム削除確認
	$('.del').submit(function(){
		let item = $('.each_item').text();
		let res =confirm(item + 'を本当に削除しますか？');
		if(res==true){
			return true;
		}else{
			return false;
		}
	});	
	//見積書・請求書投稿最終確認
	$('.sub_file').submit(function(){
		let res =confirm('選択したデータをこのまま投稿しますか？？');
		if(res==true){
			return true;
		}else{
			return false;
		}
	});
	//プラン更新最終確認
	$('.update_plan').submit(function(){
		let res =confirm('プランを変更すると登録済みお客様プラン内容も変更・更新されますが、更新して問題ないですか？');
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
	}else{
		//console.log('期限を過ぎているものはありません');
	}
	
	//撮影日と連動して、何日前かで表示させるメッセージを変える。

	var MessageList = [
		'0今日は撮影当日ですね！本日はよろしくお願いします！',
		'1いよいよ明日撮影本番ですね。忘れ物のないよう、お気をつけてお越しください！',
		'2撮影2日前です。ロケ撮影のお客様は撮影判断お願いします！',
		'3撮影3日前ですね。明日2日前はロケ撮影の決行判断日なので今日から天気予報見て準備しておきましょう！',
		'4撮影1週間前ですね。撮影当日のためにそろそろ体調管理して体調万全で当日迎えられるようにしますよう！',
		'5ちょうど1か月後が撮影日ですね！もし変更したいことがあれば、いつでも連絡くださいね！',
		'6',
		'7'
	];
	var messageNo = MessageList[3];
	$('.msg').text(messageNo);

	/*
	class MassageList(hi){
		let msg=$('.msg').text(MessageList[hi]);
		return msg;
	}	
	*/
	//ランダムメッセージ（撮影2か月以上前の場合と、上記の指定日以外の表示用）
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
	if($('.msg').text()==''){
		$('.msg_random').text(message);
	}
  /*
  var limit = $('.has_limit');
  if(limit.is('[over]')){
    var date = limit.attr('date');
    console.log('over = ' + over);
  }
  */
	//掲示板投稿の画像をクリックしたら大きくポップアップ表示 全然なにもしてないコピペメモ
	/*
	$('.gallery img').click(function(e) {
    $('#largeImg').show();
	});
	*/
		
	//期限過ぎて0（未）の項目の色を変えるために、クラスにover追加する ->PHPでにした。
	/*
	if(){
		$(".has_limit").addClass("over");
	}else{
		$(".has_limit").removeClass("over");
	}	
	*/
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

