$(window).on('load', function () { //ページが読み込まれたらすぐに
    $('.now-volume').eq(0).css('opacity','1'); //現在再生中の一つ目の曲にボリュームマークをつける
    $('.play-title').eq(0).addClass('play-title-back-color');
})

$('#forward').on('click',function(){
    if($('audio').paused){
        play.innerHTML = '<i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i>' // 「再生ボタン」に変更
    }else{
        play.innerHTML = '<i class="fa-solid fa-group fa-pause"><span class="balloon fa-pause-balloon">停止</span></i>' //停止ボタンに変更
    }  
    $('.contents-active:first-of-type,.audio-active:first-of-type').css('display','none'); //最初の画面の記事内容
    $('.contents-active,.audio-active').removeClass('is-active');
    $('.contents-active,.audio-active').eq(index).addClass('is-active'); //indexはaudio.jsで定義済み
    $('.audio-active').removeClass('is-active'); //オーディオプレイヤーの左タイトル
    $('.audio-active').eq(index).addClass('is-active');
    $('.now-play').removeClass('is-active'); //次に再生画面での現在再生中の記事内容
    $('.now-play').eq(index).addClass('is-active');
    $('.now-volume').css('opacity','0'); //現在再生中の曲に付くボリュームマーク
    $('.now-volume').eq(index).css('opacity','1');
    $('.play-title').removeClass('play-title-back-color'); //現在再生中の曲の背景
    $('.play-title').eq(index).addClass('play-title-back-color');
    if(index == 0){ //最初の曲に戻ったら
        $('.contents-active:first-of-type,.audio-active:first-of-type').css('display','block');
    }
    })