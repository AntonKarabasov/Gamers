<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $game->getName() ?></h1>
    <hr>
    <div class="embed-responsive embed-responsive-16by9" >
        <iframe class="embed-responsive-item" src="<?= $game->getLinkVideo() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="well info-block">
        <div class="info-block-main">
            Дата выхода: <span class="bold"><?= $game->getDate() . '.' . $game->getYear() ?></span>
            Рейтинг: <span class="bold"><?= $game->getRating() ?></span>
            Жанр: <?php
                    $genres = $game->getGenres();
                    for ($i = 0; $i < count($genres); $i++) {
                        if ($i === count($genres) - 1) {?>
                        <a href="/genres/<?= $genres[$i]->getId() ?>"><?= $genres[$i]->getName() ?></a>
                  <?php } else {?>
                        <a href="/genres/<?= $genres[$i]->getId() ?>"><?= $genres[$i]->getName() . ', '?></a>
                  <?php } }?>
        </div>
        <span>Платформы:
        <?php
        $platforms = $game->getPlatforms();
        for ($i = 0; $i < count($platforms); $i++) {
            if ($i === count($platforms) - 1) {?>
                <a href="/platforms/<?= $platforms[$i]->getName() ?>" class="<?= $platforms[$i]->getCompanyByPlatform($platforms[$i]->getName())?>"><?= $platforms[$i]->getName()?></a>
            <?php } else {?>
                <a href="/platforms/<?= $platforms[$i]->getName() ?>" class="<?= $platforms[$i]->getCompanyByPlatform($platforms[$i]->getName())?>"><?= $platforms[$i]->getName() . ', '?></a>
            <?php } }?>
        </span>
    </div>

    <h3>Описание:</h3>
    <div class="well">
        <?= $game->getDescriptions() ?>
    </div>

    <div class="margin-8"></div>

    <h3>Отзывы:</h3>
    <hr>
    <div class="well comment">
        <div class="comment-header">
            <img src="/../assets/img/avatar/avatar.jpg" alt="Кэмерон" class="avatar">
            <span class="uname">Кэмерон</span>
            <span class="comment-data pull-right">23.11.21</span>
            <br>
        </div>
        <div class="comment-body">It's a great game!</div>
    </div>

    <form>
        <div class="form-group">
            <input type="text" placeholder="ваше имя" class="form-control input-lg">
        </div>
        <div class="form-group">
            <textarea class="form-control"></textarea>
        </div>
        <button class="btn btn-lg btn-success pull-right">отправить</button>
    </form>

    <div class="margin-8 clear"></div>

<?php
//echo '<pre>';
//
//var_dump($game);
//echo '</pre>';
//?>

<?php include __DIR__ . '/../footer.php'; ?>