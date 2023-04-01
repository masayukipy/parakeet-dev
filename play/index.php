<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>parakeet-play内容</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="https://parakeet.website/play">
    <meta property="og:site_name" content="parakeet-音声学習">
    <meta property="og:title" content="parakeet-play内容">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ja_JP">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="parakeet-play内容">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <script src="https://kit.fontawesome.com/5b21f2aac2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="play.css">
    <link rel="stylesheet" href="audio.css">
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E66TRMPR0P"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-E66TRMPR0P');
</script>
<body>
    <?php 
        require_once('../define/keep.php');
        require_once('../class/nationalLanguage.php');
        require_once('../class/geographyHistory.php');
        require_once('../class/science.php');
        require_once('../class/english.php');
        require_once('../class/data.php');
        require_once('security.php');

        if(isset($_GET['title']) == true){
            $nextDisplay = $curriculum->getPlayTitleDb($_GET['title']);
            $randomLength = 0;
            $randoms = $nextDisplay[$randomLength];

        }elseif(isset($_GET['mixName']) == true & isset($_GET['category']) == false){
            $nextDisplay = $curriculum->getDoubleName($_GET['mixName']);
            shuffle($nextDisplay);
            $random = array_values($nextDisplay);
            $randomLength = 0;
            $randoms = $random[$randomLength];

        }elseif(isset($_GET['orderName']) == true & isset($_GET['category']) == false){
            $nextDisplay = $curriculum->getDoubleOrderName($_GET['orderName']);
            $random = array_values($nextDisplay);
            $randomLength = 0;
            $randoms = $random[$randomLength];

        }elseif(isset($_GET['mixName']) == true & isset($_GET['category']) == true){
            $nextDisplay = $curriculum->getIdentificationCategory($_GET['mixName'],$_GET['category']);
            shuffle($nextDisplay);
            $random = array_values($nextDisplay);
            $randomLength = 0;
            $randoms = $random[$randomLength];

        }elseif(isset($_GET['orderName']) == true & isset($_GET['category']) == true){
            $nextDisplay = $curriculum->getIdentificationCategory($_GET['orderName'],$_GET['category']);
            $random = array_values($nextDisplay);
            $randomLength = 0;
            $randoms = $random[$randomLength];
        }

    ?>
    <div class="container">
        <main>
            <header>
                <?php require_once('../header.php') ?>
            </header>
            <?php foreach($nextDisplay as $nextArticle): ?>
            <div class="play-area contents-active">
                <h1>#<?= h($nextArticle['title']) ?></h1>
                <div class="play-article">
                    <div class="article-area">
                        <p><?= nl2br(h($nextArticle['article'])) ?></p>
                    </div>
                    <div class="quotation">
                        <?php if($nextArticle['quotation'] == !null): ?>
                            引用元<q><?= h($nextArticle['quotation']) ?></q><br>
                        <?php endif ?>
                        <?php if($nextArticle['quotation_url'] == !null): ?>
                            <q><a href="<?= h($nextArticle['quotation_url']) ?>" target="_blank"><?= h($nextArticle['quotation_url']) ?></a></q><br>
                        <?php endif ?>
                        <?php if($nextArticle['quotation2'] == !null): ?>
                            引用元<q><?= h($nextArticle['quotation2']) ?></q><br>
                        <?php endif ?>
                        <?php if($nextArticle['quotation_url2'] == !null): ?>
                            <q><a href="<?= h($nextArticle['quotation_url2']) ?>" target="_blank"><?= h($nextArticle['quotation_url2']) ?></a></q>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </main>
        <section>
            <?php require_once('player.php') ?>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="headerFixed.js"></script>
    <script src="audio.js"></script>
    <script src="../common.js"></script>
    <script src="article.js"></script>
</body>
</html>