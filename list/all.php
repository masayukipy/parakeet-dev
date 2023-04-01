<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>parakeet-全曲</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="https://parakeet.website/list/all">
    <meta property="og:site_name" content="parakeet-音声学習">
    <meta property="og:title" content="parakeet-全曲">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ja_JP">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="parakeet-全曲">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="../home&list-common.css">
    <script src="https://kit.fontawesome.com/5b21f2aac2.js" crossorigin="anonymous"></script>
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

        $allPageCount = $curriculum->allPageCountTitle($_GET['name']);
        $allPageTitle = $curriculum->allPageTitle($_GET['name']);
        $allPageTitleLength = $curriculum->allPageTitleLength($_GET['name']);

    ?>
    <header>
            <?php require_once('../header.php') ?>
    </header>
    <main>
        <!-- 5教科部分 -->
        <section id="menu">
            <div class="title">
            <h2><span><?= $_GET['name'] ?>（<?= h($allPageCount[0]["count(`title`)"]) ?>）</span></h2>
            </div>
            <div class="list-fleam">
                <div class="grid">
                    <?php foreach($allPageTitle as $single): ?>
                        <?php foreach($allPageTitleLength as $titleLength): ?>
                            <?php if($single['title'] == $titleLength['title']): ?>
                                <div><a href="../play/?title=<?= h($single['title']) ?>">#<?= h($single['title']) ?></a><span class="allPage-time">(<?= substr($titleLength['total_time'],3,5) ?>)</span></div>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../headerFixed-home&list.js"></script>
    <script src="../common.js"></script>
</body>
</html>