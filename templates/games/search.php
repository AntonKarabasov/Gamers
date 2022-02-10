<?php include __DIR__ . '/../header.php'; ?>
    <h1>Результаты поиска &quot;<?= $query ?? '' ?>&quot;:</h1>
    <hr>
    <?php if (!empty($error)) {?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php } elseif (empty($foundGames)) {?>
    <p>Ничего не найдено</p>
    <?php } else { ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Игра</th>
            <th class="text-center">Год</th>
            <th class="text-center">Рейтинг</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($foundGames as $game) {?>
            <tr>
                <td class="col-lg-1 col-md-1 col-xs-2">
                    <img class="img-responsive img-thumbnail" src="<?= $game->getLinkPoster() ?>" alt="<?= $game->getName() ?>">
                </td>
                <td class="vert-align"><a href="/games/<?= $game->getId() ?>"><?= $game->getName() ?></a></td>
                <td class="text-center vert-align"><a href="/games/<?= $game->getYear() ?>/year"><?= $game->getYear() ?></a></td>
                <td class="text-center vert-align"><span class="badge"><?= $game->getRating() ?></span></td>
            </tr>
    <?php } ?>
    </tbody>
    </table>
<?php } ?>
    <div class="margin-8 clear"></div>

<?php include __DIR__ . '/../footer.php'; ?>