<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>parakeet-リスト内容</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="https://parakeet.website/list">
    <meta property="og:site_name" content="parakeet-音声学習">
    <meta property="og:title" content="parakeet-リスト内容">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ja_JP">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="parakeet-リスト内容">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <script src="https://kit.fontawesome.com/5b21f2aac2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="../home&list-common.css">
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

        // $subjectName = $_GET['name'];
        // $subject = Subject::findByName($subjects,$subjectName);

        if(isset($_GET['name']) == true){
            $name = $_GET['name'];
            $count = $curriculum->getNameCountDb($_GET['name']); /* 全ての曲数のみを取得 */
            $length = $curriculum->getNameLength($_GET['name']); /* 再生時間の合計 */
            $single = $curriculum->getNameSingleDb($_GET['name']); /* タイトルを取得 */
        }
        elseif(isset($_GET['title']) == true){
            $name = $_GET['title'];
            $category = $curriculum->getCategory($_GET['title']); /* カテゴリナンバーとカテゴリネームを取得 */
            $count = $curriculum->getTitleCountDb($_GET['title']);
            $length = $curriculum->getTitleLength($_GET['title']);
            $categoryGroupTotal = $curriculum->getCategoryGroupTotal($_GET['title']); /* カテゴリ別の曲数と合計再生時間とカテゴリナンバー */
            $categoryGroupSingle = $curriculum->getCategoryGroupSingle($_GET['title']); /* カテゴリ別のタイトル名とタイトル数と合計再生時間 */
        }

    ?>
    <header>
        <?php require_once('../header.php') ?>
    </header>
    <main>
        <?php require_once('../define/security.php');?>
        <div class="main-wrapper">
            <section class="main-information-area">
                <div>
                    <span><?= $name ?></span>
                    /
                    <span class="total-songs"><?= h($count[0]["count(`title`)"]) ?>曲</span>
                    <span class="title-time">
                        <?php foreach($length as $key => $value){
                            $arr2 = substr($value['total_time'],3,5);
                        } echo $arr2 ?>
                    </span>
                </div>
            </section>
            <div class="main-contents-wrapper">
                <aside class="contents-side-area">
                    <div class="contents-side">
                        <div class="contents-side-wrapper">
                            <div class="contents-title">
                                <div class="contents-title-wrapper active-button-list back-color">
                                    すべて表示
                                </div>
                            </div>
                            <div class="contents-section">
                                <?php if(isset($_GET['title'])): ?>
                                    <?php foreach($category as $categoryName): ?>
                                        <div class="contents-section-wrapper back-color">
                                            <div class="category-name"><p><span><?= $categoryName['category_number'] ?></span></p></div>
                                            <div class="category-number"><p><span><?= $categoryName['category_name'] ?></span></p></div>
                                        </div>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="contents-main-area">
                    <div class="play-information">
                        <div class="play-information-wrapper">
                            <div class="play-information-flem category-group is-active">
                                <div class="play-information-flem-wrapper">
                                    <div class="play-information-flem-wrapper-head"><?= h($count[0]["count(`title`)"]) ?>曲
                                    ・
                                        <?php foreach($length as $key => $value){
                                            $arr2 = substr($value['total_time'],3,5);
                                        } echo $arr2 ?>
                                    </div>
                                    <div class="play-information-flem-control">
                                        <div class="flem-control-button"><a href="../play/?mixName=<?= h($name) ?>"><span><i class="fa-solid fa-shuffle"></i></span><span class="shuffle-button">シャッフル</span></a></div>
                                        <div class="flem-control-button"><a href="../play/?orderName=<?= h($name) ?>"><span><i class="fa-solid fa-circle-play"></span></i><span class="order-button">順番に再生</span></a></div>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($_GET['title']) == true): ?>
                                <?php foreach($categoryGroupTotal as $key): ?>
                                <div class="play-information-flem play-information-flem-is category-group">
                                    <div class="play-information-flem-wrapper">
                                        <div><?= h($key["COUNT(title)"]) ?>曲
                                        ・
                                            <?php echo substr($key['total_time'],3,5) ?>
                                        </div>
                                        <div class="play-information-flem-control">
                                            <div class="flem-control-button"><a href="../play/?mixName=<?= h($name) ?>&category=<?= $key['category_number'] ?>"><span><i class="fa-solid fa-shuffle"></i></span><span class="shuffle-button">シャッフル</span></a></div>
                                            <div class="flem-control-button"><a href="../play/?orderName=<?= h($name) ?>&category=<?= $key['category_number'] ?>"><span><i class="fa-solid fa-circle-play"></span></i><span class="order-button">順番に再生</span></a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php if(isset($_GET['name']) == true): ?>
                    <div class="paly-list">
                        <div class="play-list-wrapper">
                            <div class="play-list-title">
                                <?php if(isset($_GET['name']) == true): ?>
                                    <?php foreach($single as $color): ?>
                                        <a href="../play/?title=<?= h($color['title']) ?>">
                                            <div class="play-single">
                                                <div class="play-action"><i class="fa-solid fa-circle-play"></i></div>
                                                <div class="article-title"><span>#<?= h($color['title']) ?></span></div>
                                                <div class="article-title-time"><span><?php $singleTime = $color['length']; echo substr($singleTime,3,5); ?></span></div>
                                            </div>
                                        </a>
                                    <?php endforeach ?>
                                    <div class="next-all-page"><a href="all?name=<?= h($name) ?>">すべてを表示</a></div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php if(isset($_GET['title']) == true): ?>
                    <div class="paly-list">
                        <div class="play-list-wrapper">
                            <div class="play-list-title">
                                <?php foreach($categoryGroupTotal as $totalKey): ?>
                                    <?php $letTotalKey = $totalKey['category_number'] ?>
                                    <div class="play-category-number category-group is-active">
                                        <div><?= $totalKey['category_number'] ?></div>
                                        <div class="play-category-list">
                                                <?php foreach($categoryGroupSingle as $singleKey): ?>
                                                    <?php $letSingleKey = $singleKey['category_number'] ?>
                                                    <?php if($letTotalKey == $letSingleKey): ?>
                                            <a href="../play/?title=<?= h($singleKey['title']) ?>">
                                                <div class="play-single">
                                                    <div class="play-action"><i class="fa-solid fa-circle-play"></i></div>
                                                    <div class="article-title"><span>#<?= h($singleKey['title']) ?></span></div>
                                                    <div><span><?= substr($singleKey['total_time'],3,5); ?></span></div>
                                                </div>
                                            </a>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="play-category-number-is category-group">
                                        <div><?= $totalKey['category_number'] ?></div>
                                        <div class="play-category-list">
                                                <?php foreach($categoryGroupSingle as $singleKey): ?>
                                                    <?php $letSingleKey = $singleKey['category_number'] ?>
                                                    <?php if($letTotalKey == $letSingleKey): ?>
                                            <a href="../play/?title=<?= h($singleKey['title']) ?>">
                                                <div class="play-single">
                                                    <div class="play-action"><i class="fa-solid fa-circle-play"></i></div>
                                                    <div class="article-title"><span>#<?= h($singleKey['title']) ?></span></div>
                                                    <div><span><?= substr($singleKey['total_time'],3,5); ?></span></div>
                                                </div>
                                            </a>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </section>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../headerFixed-home&list.js"></script>
<script src="../common.js"></script>
<script src="list-group.js"></script>
</body>
</html>