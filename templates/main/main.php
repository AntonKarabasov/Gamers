<?php include __DIR__ . '/../header.php'; ?>

<h2>Новые игры</h2>
<hr>
<div class="row">
    <?php foreach ($newGames as $game) {?>
    <div class="games_block col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="/games/<?= $game->getId() ?>"><img src="<?= $game->getLinkPoster() ?>" alt="<?= $game->getName() ?>"></a>
        <div class="game_label"><?= $game->getName() ?></div>
    </div>
    <?php }?>
</div>
<div class="margin-8"></div>

<h2>Высокий рейтинг</h2>
<hr>
<div class="row">
    <?php for($i = 0; $i<4; $i++) {?>
    <div class="games_block col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <a href="/games/<?= $topGames[$i]->getId() ?>"><img src="<?= $topGames[$i]->getLinkPoster() ?>" alt="<?= $topGames[$i]->getName() ?>"></a>
        <div class="game_label"><?= $topGames[$i]->getName() ?></div>
    </div>
   <?php }?>
</div>
<div class="margin-8"></div>

<?php foreach ($news as $oneNews) {?>
<a href="/news/<?= $oneNews->getId() ?>"><h3><?= $oneNews->getName()?></h3></a>
<hr>
<p><?= mb_substr($oneNews->getText(), 0, 300) . '...' ?></p>
<a href="/news/<?= $oneNews->getId() ?>" class="btn btn-success pull-right">читать</a>
<div class="margin-8"></div>
<?php }?>

<?php include __DIR__ . '/../footer.php'; ?>
				

