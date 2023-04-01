<div class="audio-controls">
    <?php foreach($nextDisplay as $next): ?>
    <div class="audio-information audio-active">
        <span class="audio-information-title">#<?= h($next['title']) ?></span>
        <p><?= h($next['curriculum']) ?> > <?= h($next['subject']) ?></p>
    </div>
    <?php endforeach ?>
    <div class="audio-area">
        <div id="control" data-barba="wrapper">
            <div id="control-wrapper">
                <audio src="<?= h($randoms["audio_pass"]) ?>"></audio>
                <button id="stop"><i class="fa-solid fa-group fa-rotate-left"><span class="balloon fa-rotate-left-balloon">曲頭へ</span></i></button>
                <button id="backward"><i class="fa-solid fa-group fa-backward-step"><span class="balloon fa-backward-step-balloon">前へ</span></i></button>
                <button id="play"><i class="fa-solid fa-group fa-play"><span class="balloon fa-play-balloon">再生</span></i></button>
                <button id="forward"><i class="fa-solid fa-group fa-forward-step"><span class="balloon fa-forward-step-balloon">次へ</span></i></button>
                <button id="mute" onclick="muted()"><i class="fa-solid fa-group fa-volume-xmark"><span class="balloon fa-volume-xmark-balloon">消音</span></i></button>
            </div>
        </div>
        <div id="time">
            <span id="current">00:00</span>
            <button id="seekbar"></button>
            <?php $time = $randoms['length'] ?>
            <span id="duration"><?= substr($time,3,5) ?></span>
        </div>
    </div>
    <div class="audio-volume">
        <button class="audio-list"><i class="fa-solid fa-group-list fa-gear"><span id="fa-gear-setting" class="balloon fa-gear-balloon">設定</span></i></button>
        <div class="setting-speed-display"><span>変更しました</span></div>
        <span class="setting">
            <div class="playback-speed-wrapper">
                <div class="playback-left">再生速度</div><div class="playback-center" id='selected'>標準</div><div class="playback-right">></div>
            </div>
        </span>
        <div class="speed-choice">
            <div class="speed-choice-wrapper">
                <div class="choice-back">く<div style ="padding-left:15px;">戻る</div></div>
                <div id="speed-normal" class="choice" data-id='標準'>標準</div>
                <div id="speed-fast" class="choice" data-id='×1.25'>×1.25</div>
                <div id="speed-second" class="choice" data-id='×1.5'>×1.5</div>
                <div id="speed-third" class="choice" data-id='×1.75'>×1.75</div>
                <div id="speed-max" class="choice" data-id='×2'>×2</div>
            </div>
        </div>
        <button class="audio-list"><i class="fa-solid fa-group-list fa-list"><span id="next-play-tip" class="balloon fa-list-balloon">次に再生</span></i></button>
        <div class="volume">
            <div class="volume-fast"><i class="fa-solid fa-volume-low"></i></div>
            <button class="volume-second" onclick="volume_up()"><i class="fa-solid fa-plus"></i></button>
            <button class="volume-three" onclick="volume_down()"><i class="fa-solid fa-minus"></i></button>
        </div>
    </div>
</div>
<div class="next-play-area">
    <div class="next-play-main">
        <?php foreach($nextDisplay as $next): ?>
        <div class="now-play audio-active">
                <h3 class="now-play-title-left">#<?= h($next['title']) ?></h3>
            <div class="next-play-article scroll">
                <div class="article-area space">
                    <p><?= nl2br(h($next['article'])) ?></p>
                </div>
                <div class="quotation space">
                    <?php if($next['quotation'] == !null): ?>
                        引用元<q><?= h($next['quotation']) ?></q><br>
                    <?php endif ?>
                    <?php if($next['quotation_url'] == !null): ?>
                        <q><a href="<?= h($next['quotation_url']) ?>" target="_blank"><?= h($next['quotation_url']) ?></a></q><br>
                    <?php endif ?>
                    <?php if($next['quotation2'] == !null): ?>
                        引用元<q><?= h($next['quotation2']) ?></q><br>
                    <?php endif ?>
                    <?php if($next['quotation_url2'] == !null): ?>
                        <q><a href="<?= h($next['quotation_url2']) ?>" target="_blank"><?= h($next['quotation_url2']) ?></a></q>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <div class="next-play">
            <h3 class="now-play-title">次に再生</h3>
            <div class="next-play-list scroll space">
                <?php $array = array() ?>
                <?php foreach($nextDisplay as $next): ?>
                    <div class="play-title"><div class="now-volume"><i class="fa-solid fa-volume-high"></i></div><div class="play-title-center"><?= $next['title'] ?></div><div class="play-title-right"><?php $singleTime = $next['length']; echo substr($singleTime,3,5) ?></div></div>
                    <?php $array[] = $next['audio_pass'] ?>
                <?php endforeach ?>
                    <?php $json_array = json_encode($array); ?>
                    <script>
                        let playlist = <?php echo $json_array ?>
                    </script>
            </div>
        </div>
    </div>
</div>