const audio = document.getElementsByTagName("audio")[0]
const playButton = document.getElementById("play")
const stopButton = document.getElementById("stop")
const settingButton = document.getElementById("setting")
const forwardButton = document.getElementById("forward")
const backwardButton = document.getElementById("backward")


// 再生ボタンがclickされたら停止ボタンに変更してその停止ボタンからmouseoutしてmouseoverしたらまたそのボタンの.balloonが表示される。↓↓↓
playButton.addEventListener('click', () => {
    if (audio.paused) {
        audio.play()
        play.innerHTML = play.innerHTML === 'Play' ? 'Pause' : '<i class="fa-solid fa-group fa-pause"><span class="balloon fa-pause-balloon">停止</span></i>' //停止ボタンに変更
        if (window.matchMedia("(min-width: 768px)").matches) { //もし画面サイズが768pxなら
                $('.fa-pause').mouseover(function() {
                    timeBomb = setTimeout(function() {
                        $('.fa-pause-balloon').show();
                    },350)
                    $('.fa-pause').mouseout(function() {
                        $('.fa-pause-balloon').hide();
                        clearTimeout(timeBomb)
                    })
                })
        }
    } else {
        audio.pause()
        play.innerHTML = '<i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i>' // 「再生ボタン」に変更
        if (window.matchMedia("(min-width: 768px)").matches) {
                $('.fa-play').mouseover(function() {
                    timeBomb = setTimeout(function() {
                        $('.fa-play-balloon').show();
                    },350)
                    $('.fa-play').mouseout(function() {
                        $('.fa-play-balloon').hide();
                        clearTimeout(timeBomb)
                    })
                })
        }
    }
})


var index = 0; //初期化

// 曲終わりに次の曲を自動再生,無ければ曲頭に戻り停止ボタンが再生ボタンに変化
audio.addEventListener("ended", ()=>{           //曲終わりに
    index++;
if (index < playlist.length) {
audio.src = playlist[index];
audio.play();
    $('.contents-active:first-of-type,.audio-active:first-of-type').css('display','none');
    $('.contents-active,.audio-active').removeClass('is-active');
    $('.contents-active,.audio-active').eq(index).addClass('is-active');
    $('.now-play').removeClass('is-active');
    $('.now-play').eq(index).addClass('is-active');
    $('.now-volume').css('opacity','0'); //現在再生中の曲に付くボリュームマーク
    $('.now-volume').eq(index).css('opacity','1');
    $('.play-title').removeClass('play-title-back-color'); //現在再生中の曲の背景
    $('.play-title').eq(index).addClass('play-title-back-color');
    if(index == 0){
        $('.contents-active:first-of-type,.audio-active:first-of-type').css('display','block');
    }
    $('.audio-active').removeClass('is-active');
    $('.audio-active').eq(index).addClass('is-active');
    $('.now-play').removeClass('is-active');
    $('.now-play').eq(index).addClass('is-active');
}else {
    audio.currentTime = 0;  // 再生位置を先頭に移動(こいつはなくても大丈夫)
    play.innerHTML = '<i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i>';  // 「再生ボタン」に変更
    if (window.matchMedia("(min-width: 768px)").matches) {
        // clickされたら再生ボタンのfadeIn()メソッドが無くなるのでもう一度コードを組み込む↓↓↓
        $('.fa-play').mouseover(function() {
            timeBomb = setTimeout(function() {
                $('.fa-play-balloon').show();
            },350)
            $('.fa-play').mouseout(function() {
                $('.fa-play-balloon').hide();
                clearTimeout(timeBomb)
            })
        })
    }
}
});
// 次の曲を押したとき。最後の曲になった時はループする
var last = playlist.length-1;

forwardButton.addEventListener('click',() => {
    if (index < last) {
    index++;
    audio.src = playlist[index];
    audio.play();
    }else if(index = last){
        index = 0;
        audio.src = playlist[index];
        audio.play();
    }
})

// 曲頭へ戻る
stopButton.addEventListener('click', () => {
    audio.pause()
    play.innerHTML = '<i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i>';  // 「再生ボタン」に変更
    audio.currentTime = 0
    if (window.matchMedia("(min-width: 768px)").matches) {
        // clickされたら再生ボタンのfadeIn()メソッドが無くなるのでもう一度コードを組み込む↓↓↓
        $('.fa-play').mouseover(function() {
            timeBomb = setTimeout(function() {
                $('.fa-play-balloon').show();
            },350)
            $('.fa-play').mouseout(function() {
                $('.fa-play-balloon').hide();
                clearTimeout(timeBomb)
            })
        })
    }
})

// ”前へ”　前へのボタンclick時　内容は曲頭へ戻ると一緒
backwardButton.addEventListener('click', () => {
        audio.pause()
        play.innerHTML = '<i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i>';  // 「再生ボタン」に変更
        audio.currentTime = 0
    })

audio.addEventListener("timeupdate", (e) => {
    const current = Math.floor(audio.currentTime)
    const duration = Math.round(audio.duration)
    if(!isNaN(duration)){
    document.getElementById('current').innerHTML = playTime(current)
    document.getElementById('duration').innerHTML = playTime(duration)
    const percent = Math.round((audio.currentTime/audio.duration)*1000)/10
    document.getElementById('seekbar').style.backgroundSize = percent + '%'
    }
})

document.getElementById('seekbar').addEventListener("click", (e) => {
    const duration = Math.round(audio.duration)
    if(!isNaN(duration)){
    const mouse = e.pageX
    const element = document.getElementById('seekbar')
    const rect = element.getBoundingClientRect()
    const position = rect.left + window.pageXOffset
    const offset = mouse - position
    const width = rect.right - rect.left
    audio.currentTime = Math.round(duration * (offset / width))
    }
})
function playTime (t) {
    let hms = ''
    const h = t / 3600 | 0
    const m = t % 3600 / 60 | 0
    const s = t % 60
    const z2 = (v) => {
    const s = '00' + v
    return s.substr(s.length - 2, 2)
    }
    if(h != 0){
    hms = h + ':' + z2(m) + ':' + z2(s)
    }else if(m != 0){
    hms = z2(m) + ':' + z2(s)
    }else{
    hms = '00:' + z2(s)
    }
    return hms
}

function volume_up() {
audio.volume = audio.volume + 0.1; //音量の値を0.1(10%)ずつアップ
}

function volume_down() {
audio.volume = audio.volume - 0.1; //音量の値を0.1(10%)ずつダウン
}

function muted() {
if(audio.muted == true){
    audio.muted = false;
} else {
    audio.muted = true;
}
}


// 再生ボタンにマウスが乗った時に表示して離れたら非表示
// 再生ボタン
var timeBomb;
if (window.matchMedia("(min-width: 768px)").matches) {
$('.fa-play').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-play-balloon').show();
    },350)
    $('.fa-play').mouseout(function() {
        $('.fa-play-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 曲頭へボタン
$('.fa-rotate-left').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-rotate-left-balloon').show();
    },350)
    $('.fa-rotate-left').mouseout(function() {
        $('.fa-rotate-left-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 前へボタン
$('.fa-backward-step').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-backward-step-balloon').show();
    },350)
    $('.fa-backward-step').mouseout(function() {
        $('.fa-backward-step-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 次へボタン
$('.fa-forward-step').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-forward-step-balloon').show();
    },350)
    $('.fa-forward-step').mouseout(function() {
        $('.fa-forward-step-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 消音ボタン
$('.fa-volume-xmark').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-volume-xmark-balloon').show();
    },350)
    $('.fa-volume-xmark').mouseout(function() {
        $('.fa-volume-xmark-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 次に再生ボタン
$('.fa-list').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-list-balloon').show();
    },350)
    $('.fa-list').mouseout(function() {
        $('.fa-list-balloon').hide();
        clearTimeout(timeBomb)
    })
})
// 設定ボタン
$('.fa-gear').mouseover(function() {
    timeBomb = setTimeout(function() {
        $('.fa-gear-balloon').show();
    },350)
    $('.fa-gear').mouseout(function() {
        $('.fa-gear-balloon').hide();
        clearTimeout(timeBomb)
    })
})
}
//ここまで------- 再生ボタンにマウスが乗った時に表示して離れたら非表示---------


// ------------- 設定ボタン ----------------------------------------------

// フォントオーサムの設定ボタン
$('.fa-gear').on('click', function(){
    $('.setting').toggle();
    $('.fa-gear-balloon').removeClass();
    const setting = document.getElementById('fa-gear-setting');
    setting.innerHTML = '';
    $(this).toggleClass('rotate');
    if($('.speed-choice').css('display') == 'block'){         //設定ボタンを押したら再生速度選択画面も一緒に消える
        $('.setting').toggle();
        $('.speed-choice').toggle();
    }
})

// 設定ボタン以外をクリックした場合設定内容が非表示になる、設定内容をクリックしてもそのまま
//１．クリックイベントの設定
$(document).on('click', function(e) {
	// ２．クリックされた場所の判定
	if(!$(e.target).closest('.setting').length && !$(e.target).closest('.fa-gear').length && !$(e.target).closest('.choice-back').length){
		$('.setting').hide();
		$('.speed-choice').hide();
        $('.fa-gear').removeClass('rotate')
    }//else if($(e.target).closest('.fa-gear').length){//      //　←　設定内容をクリックしてもそのまま
		// ３．ポップアップの表示状態の判定
	// 	if($('.setting').is(':hidden')){
	// 		$('.setting').fadeIn();
	// 	}else{
	// 		$('.setting').fadeOut();
	// 	}
	// }
});

// 再生速度をclickしたとき
$('.playback-speed-wrapper').on('click', function(){
    $('.speed-choice').toggle();
    $('.setting').toggle();
})

// 戻るをクリックしたとき
$('.choice-back').on('click', function(){
    $('.speed-choice').hide();
    $('.setting').show();
})

// 速度調整
window.addEventListener('DOMContentLoaded', function(){
const audioElement = document.querySelector("audio");
const speed_normal = document.getElementById("speed-normal");
const speed_fast = document.getElementById("speed-fast");
const speed_second = document.getElementById("speed-second");
const speed_third = document.getElementById("speed-third");
const speed_max = document.getElementById("speed-max");

speed_normal.addEventListener("click", (e) => {
    audioElement.playbackRate = 1;
});
speed_fast.addEventListener("click", (e) => {
    audioElement.playbackRate = 1.25;
});
speed_second.addEventListener("click", (e) => {
    audioElement.playbackRate = 1.5;
});
speed_third.addEventListener("click", (e) => {
    audioElement.playbackRate = 1.75;
});
speed_max.addEventListener("click", (e) => {
    audioElement.playbackRate = 2.0;
});
});

// 再生速度の選択肢からボタンを押したときにその内容が表示される
$('.choice').on('click', function(){
    var click =  $(this).data('id');

    $('#selected').text(click);
    $('.setting-speed-display').show()
    setTimeout(function(){
        $('.setting-speed-display').fadeOut()
    },1500)
});

// ここまで ----- 設定ボタン ----------------------------------------------

// -----------------------次に再生----------------------------------------
$('.fa-list').on('click',function(){
    $('.next-play-area').toggle();
    $('.fa-list-balloon').removeClass();
    const next = document.getElementById('next-play-tip');      //次に再生ボタンを押したら”次に再生”のツールチップが消える処理
    next.innerHTML = '';
    if($('.next-play-area').css('display') == 'block'){         //次に再生ボタンを押すたびに色が変わる処理
        $('.fa-list').css('color','#079c04');
        // $('html,body').css('overflow','hidden');                //次に再生の画面でスクロール出来るようにする
        // $('.audio-controls').css('width','calc(100% - 9.6px)'); スクロールが消えてオーディオプレイヤーがスクロールの横幅分伸びるので調整
        $('.audio-controls').css('position','fixed');
        $('.audio-controls').css('bottom','0');
    }else{
        $('.fa-list').css('color','#FDFDFD');
        $('html,body').css('overflow','');                      //もう一度次の再生ボタンをクリック後スクロール禁止を解除する
        // $('.audio-controls').css('width','100%');
        $('.audio-controls').css('position','');
        $('.audio-controls').css('bottom','');
    }
})

// -----------------------ここまで次に再生--------------------------------


// -----------------------プレイヤーの記事タイトル横スライド----------------------------------------
if($('.audio-information-title').eq(0).text().length > 5){  //一つ目のクラスが5文字以上か判定
    $('.audio-information-title').addClass('text-slider');
}
$('#forward').on('click',function(){
    $('.text-slider').removeClass('text-slider');
    if($('.audio-information-title').eq(index).text().length > 5){
        $('.audio-information-title').addClass('text-slider');
    }
})
//  ----- ここまでプレイヤーの記事タイトル横スライド ----------------------------------------------