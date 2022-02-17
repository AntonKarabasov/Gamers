<?php include __DIR__ . '/../header.php'; ?>
    <h1>Все игры</h1>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Игра</th>
            <th class="text-center">Год</th>
            <th class="text-center">ID</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($games as $game) {?>
            <tr>
                <td class="col-lg-1 col-md-1 col-xs-2">
                    <img class="img-responsive img-thumbnail" src="<?= $game->getLinkPoster() ?>" alt="<?= $game->getName() ?>">
                </td>
                <td class="vert-align"><a href="/games/<?= $game->getId() ?>"><?= $game->getName() ?></a></td>
                <td class="text-center vert-align"><a href="/games/<?= $game->getYear() ?>/year"><?= $game->getYear() ?></a></td>
                <td class="text-center vert-align"><?= $game->getId() ?></td>
                <td class="text-center vert-align">
                    <a href="/games/<?= $game->getId() ?>/delete" class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg pull-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>

    <div class="margin-8 clear"></div>

<?php include __DIR__ . '/../footer.php'; ?>