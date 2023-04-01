<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>parakeet-音声学習parakeet公式サイト</title>
    <meta name="description" content="『パラキート』は音声学習メディアです。音や声で勉強する音声配信。国語.社会.地理.歴史.理科.英語.学校の勉強。統一的に知識を吸収。耳で学習して成績up。通学、通勤途中に耳や声で効率的に学ぶ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="https://parakeet.website">
    <meta property="og:site_name" content="parakeet-音声学習">
    <meta property="og:title" content="parakeet-音声学習">
    <meta property="og:description" content="『パラキート』は音声学習メディアです。音や声で勉強する音声配信。国語.社会.地理.歴史.理科.英語">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ja_JP">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="parakeet~音声学習~">
    <meta property="twitter:description" content="『パラキート』は音声学習メディアです。音や声で勉強する音声配信。国語.社会.地理.歴史.理科.英語">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <script src="https://kit.fontawesome.com/5b21f2aac2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="home&list-common.css">
    <link rel="stylesheet" href="home.css">
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
        require_once('define/keep.php');
        require_once('class/nationalLanguage.php');
        require_once('class/geographyHistory.php');
        require_once('class/science.php');
        require_once('class/english.php');
        require_once('class/data.php');
    ?>
    <header>
        <div id="brand">
            <div class="brand-top">
                <h1 class="header-logo"><a href="">parakeet</a></h1>
                <p class="header-sub">~音声学習~</p>
            </div>
            <div id="search">
                <form class="search_container" method="post" action="search/">
                    <input class="search-fleam-wrapper" type="text" placeholder="キーワード検索" name="search-name">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="brand-right">
                <div class="brand-right-wrapper">
                    <div class="menu-button">
                        <i class="fa-solid fa-bars"></i>
                        <div class="menu-container">
                            <div class="menu-wrapper">
                                <a href="">ホーム</a>
                                <a href="privacy/">プライバシーポリシー</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="search-second">
                <form class="search-container-second" method="post" action="search/">
                    <input class="search-fleam-wrapper-second" type="text" placeholder="キーワード検索" name="search-name">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <nav id="global-nav" class="top-page-navigation">
            <div class="top-page-navigation-container">
                <div><a class="nav-home" href=""><i class="fa-solid fa-house fa-group"></i>ホーム</a></div>
                <div><button class="nav-button active-button"><i class="fa-solid fa-book-open fa-lg fa-group"></i>国語</button></div>
                <div><button class="nav-button"><i class="fa-solid fa-earth-americas fa-lg fa-group"></i>社会</button></div>
                <div><button class="nav-button"><i class="fa-solid fa-flask fa-lg fa-group"></i>理科</button></div>
                <div><button class="nav-button"><i class="fa-solid fa-font fa-lg fa-group"></i>英語</button></div>
            </div>
        </nav>
    </header>
    <main>
        <section id="main-subject">
            <div class="subject-wrapper">
                <div class="high-school">
                    <div class="high-school-wrapper">
                        <div class="subject-contents is-contents-active">
                            <h2 class="curriculum-submit"><a href="list/?name=<?= h("国語") ?>"><span>国語</span></a></h2>
                            <div><p><a href="list/?title=<?= h("四字熟語") ?>">四字熟語</a></p></div>
                            <div><p><a href="list/?title=<?= h("慣用句") ?>">慣用句</a></p></div>
                            <div><p><a href="list/?title=<?= h("ことわざ") ?>">ことわざ</a></p></div>
                            <div><p><a href="list/?title=<?= h("その他") ?>">その他</a></p></div>
                        </div>
                        <div class="subject-contents">
                            <h2 class="curriculum-submit"><a href="list/?name=<?= h("社会") ?>">社会</a></h2>
                            <div><p><a href="list/?title=<?= h("地理") ?>">地理</a></p></div>
                            <div><p><a href="list/?title=<?= h("日本史") ?>">日本史</a></p></div>
                            <div><p><a href="list/?title=<?= h("世界史") ?>">世界史</a></p></div>
                        </div>
                        <div class="subject-contents">
                            <h2 class="curriculum-submit"><a href="list/?name=<?= h("理科") ?>">理科</a></h2>
                            <div><p><a href="list/?title=<?= h("物理") ?>">物理</a></p></div>
                            <div><p><a href="list/?title=<?= h("生物") ?>">生物</a></p></div>
                            <div><p><a href="list/?title=<?= h("化学") ?>">化学</a></p></div>
                            <div><p><a href="list/?title=<?= h("地学") ?>">地学</a></p></div>
                        </div>
                        <div class="subject-contents">
                            <h2 class="curriculum-submit"><a href="list/?name=<?= h("英語") ?>">英語</a></h2>
                            <div><p><a href="list/?title=<?= h("単語学習") ?>">単語学習</a></p></div>
                            <div><p><a href="list/?title=<?= h("英会話") ?>">英会話</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="news">
            <h2 class="heading">お知らせ</h2>
            <p class="ingredient-list">
            </p>
        </section>
    </main>
    <?php require_once('footer.php') ?>
    <div class="copy">
        <div class="copy-wrapper">
            <p>© 2022 <a href="index.php">parakeet</a></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="headerFixed-home&list.js"></script>
    <script src="common.js"></script>
    <script src="top-nav-button.js"></script>
</body>
</html>