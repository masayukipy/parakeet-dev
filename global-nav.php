<nav id="global-nav">
    <ul class="menu">
        <li class="single"><a href="../"><i class="fa-solid fa-house fa-group"></i>ホーム</a></li>
        <?php foreach($subjects as $subject): ?>
            <?php if($subject instanceof NationalLanguage): ?>
            <li class="single">
            <a href="../list/?name=<?= h($subject->getName()) ?>"><i class="fa-solid fa-book-open fa-lg fa-group"></i>国語</a>
                <ul id="national" class="menu-second">
                    <li><a href="../list/?title=<?= h($subject->getSub1()) ?>"><?= $subject->getSub1() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub2()) ?>"><?= $subject->getSub2() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub3()) ?>"><?= $subject->getSub3() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub4()) ?>"><?= $subject->getSub4() ?></a></li>
                </ul>
            </li>
            <?php elseif($subject instanceof GeographyHistory): ?>
            <li class="single">
            <a href="../list/?name=<?= h($subject->getName()) ?>"><i class="fa-solid fa-earth-americas fa-lg fa-group"></i>社会</a>
                <ul id="geography" class="menu-second">
                    <li><a href="../list/?title=<?= h($subject->getSub1()) ?>"><?= $subject->getSub1() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub2()) ?>"><?= $subject->getSub2() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub3()) ?>"><?= $subject->getSub3() ?></a></li>
                </ul>
            </li>
            <?php elseif($subject instanceof Science): ?>
            <li class="single">
            <a href="../list/?name=<?= h($subject->getName()) ?>"><i class="fa-solid fa-flask fa-lg fa-group"></i>理科</a>
                <ul id="science" class="menu-second">
                    <li><a href="../list/?title=<?= h($subject->getSub1()) ?>"><?= $subject->getSub1() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub2()) ?>"><?= $subject->getSub2() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub3()) ?>"><?= $subject->getSub3() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub4()) ?>"><?= $subject->getSub4() ?></a></li>
                </ul>
            </li>
            <?php elseif($subject instanceof English): ?>
            <li class="single">
            <a href="../list/?name=<?= h($subject->getName()) ?>"><i class="fa-solid fa-font fa-lg fa-group"></i>英語</a>
                <ul id="english" class="menu-second">
                    <li><a href="../list/?title=<?= h($subject->getSub1()) ?>"><?= $subject->getSub1() ?></a></li>
                    <li><a href="../list/?title=<?= h($subject->getSub2()) ?>"><?= $subject->getSub2() ?></a></li>
                </ul>
            </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</nav>