<div id="brand">
    <div class="brand-top">
        <h1 class="header-logo"><a href="../">parakeet</a></h1>
        <p class="header-sub">~音声学習~</p>
    </div>
    <?php require_once('../search/search-parts.php') ?>
    <div class="brand-right">
        <div class="brand-right-wrapper">
            <div class="menu-button">
                <i class="fa-solid fa-bars"></i>
                <div class="menu-container">
                    <div class="menu-wrapper">
                        <a href="../">ホーム</a>
                        <a href="../privacy/">プライバシーポリシー</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div id="search-second">
        <form class="search-container-second" method="post" action="../search/">
            <input class="search-fleam-wrapper-second" type="text" placeholder="キーワード検索" name="search-name">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<?php require_once('../global-nav.php') ?>