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
                        <a href="/games/<?= $genres[$i]->getName() ?>/genres"><?= $genres[$i]->getName() ?></a>
                  <?php } else {?>
                        <a href="/games/<?= $genres[$i]->getName() ?>/genres"><?= $genres[$i]->getName() . ', '?></a>
                  <?php } }?>
        </div>
        <span>Платформы:
        <?php
        $platforms = $game->getPlatforms();
        for ($i = 0; $i < count($platforms); $i++) {
            if ($i === count($platforms) - 1) {?>
                <a href="/games/<?= $platforms[$i]->getName() ?>/platforms" class="<?= $platforms[$i]->getCompanyByPlatform($platforms[$i]->getName())?>"><?= $platforms[$i]->getName()?></a>
            <?php } else {?>
                <a href="/games/<?= $platforms[$i]->getName() ?>/platforms" class="<?= $platforms[$i]->getCompanyByPlatform($platforms[$i]->getName())?>"><?= $platforms[$i]->getName() . ', '?></a>
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
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ($user === null) {?>
        <p class="font-weight-bold text-center">Нужно <a href="/users/login">авторизоваться</a> для добавления отзыва</p>
    <?php } else { ?>
        <?php  if ($user->canUserToReview($reviews)) {?>
            <form action="/reviews/<?= $game->getId() ?>/add " method="post">
                <div class="form-group">
                    <label for="textarea">Ваш отзыв <textarea class="form-control" id="textarea" name="text" id="text" rows="10" cols="80" required></textarea></label>
                </div>
                <div class="form-group">
                    <div class="rating-area">
                        <input type="radio" id="star-10" name="rating" value="10">
                        <label for="star-10" title="Оценка «10»"></label>
                        <input type="radio" id="star-9" name="rating" value="9">
                        <label for="star-9" title="Оценка «9»"></label>
                        <input type="radio" id="star-8" name="rating" value="8">
                        <label for="star-8" title="Оценка «8»"></label>
                        <input type="radio" id="star-7" name="rating" value="7">
                        <label for="star-7" title="Оценка «7»"></label>
                        <input type="radio" id="star-6" name="rating" value="6">
                        <label for="star-6" title="Оценка «6»"></label>
                        <input type="radio" id="star-5" name="rating" value="5">
                        <label for="star-5" title="Оценка «5»"></label>
                        <input type="radio" id="star-4" name="rating" value="4">
                        <label for="star-4" title="Оценка «4»"></label>
                        <input type="radio" id="star-3" name="rating" value="3">
                        <label for="star-3" title="Оценка «3»"></label>
                        <input type="radio" id="star-2" name="rating" value="2">
                        <label for="star-2" title="Оценка «2»"></label>
                        <input type="radio" id="star-1" name="rating" value="1">
                        <label for="star-1" title="Оценка «1»"></label>
                    </div>
                </div>
                <button class="btn btn-lg btn-success pull-left">отправить</button>
            </form>
        <div class="margin-8 clear"></div>
        <?php } elseif (!empty($editedReview)) {?>
            <form action="/reviews/<?= $editedReview->getId() ?>/edit " method="post">
                <div class="form-group">
                    <label for="textarea">Ваш отзыв<textarea class="form-control" id="textarea" name="text" id="text" rows="10" cols="80" required><?= $editedReview->getText() ?></textarea></label>
                </div>
                <div class="form-group">
                    <div class="rating-area">
                        <input type="radio" id="star-10" name="rating" value="10">
                        <label for="star-10" title="Оценка «10»"></label>
                        <input type="radio" id="star-9" name="rating" value="9">
                        <label for="star-9" title="Оценка «9»"></label>
                        <input type="radio" id="star-8" name="rating" value="8">
                        <label for="star-8" title="Оценка «8»"></label>
                        <input type="radio" id="star-7" name="rating" value="7">
                        <label for="star-7" title="Оценка «7»"></label>
                        <input type="radio" id="star-6" name="rating" value="6">
                        <label for="star-6" title="Оценка «6»"></label>
                        <input type="radio" id="star-5" name="rating" value="5">
                        <label for="star-5" title="Оценка «5»"></label>
                        <input type="radio" id="star-4" name="rating" value="4">
                        <label for="star-4" title="Оценка «4»"></label>
                        <input type="radio" id="star-3" name="rating" value="3">
                        <label for="star-3" title="Оценка «3»"></label>
                        <input type="radio" id="star-2" name="rating" value="2">
                        <label for="star-2" title="Оценка «2»"></label>
                        <input type="radio" id="star-1" name="rating" value="1">
                        <label for="star-1" title="Оценка «1»"></label>
                    </div>
                </div>
                <button class="btn btn-lg btn-success pull-left">редактировать</button>
            </form>
        <div class="margin-8 clear"></div>
        <?php } ?>
    <?php } ?>

    <?php if (!empty($reviews)) {?>
        <?php foreach ($reviews as $review) {?>
        <div class="well comment" id="review<?= $review->getId() ?>">
            <div class="comment-header">
                <img src="<?= $review->getAuthor()->getAvatar() ?>" alt="<?= $review->getAuthor()->getNickname() ?>" class="avatar">
                <span class="uname"><?= $review->getAuthor()->getNickname() ?></span>
                <span class="pull-right"><?php if ($user->isAdmin() || $review->isAuthor($user)) {?>
                        <a href="/reviews/<?= $review->getId() ?>/delete" class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg pull-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                        </svg>
                    </a>
                    <?php if ($review->isAuthor($user) ) {?>
                            <a href="/reviews/<?= $review->getId() ?>/edit" class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill pull-right" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </a>
                        <?php }
                    } ?></span>
                <br>
            </div>
            <div class="comment-body">
                <p><?= $review->getText() ?></p>
                <div class="rating">
                    <span class="pull-right"> <?= $review->getRating() ?>/10 </span>
                    <div class="rating-mini pull-right">
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <span class="<?= $review->getActive($i) ?>"></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php }
    }?>

<?php
//echo '<pre>';
//
//var_dump($game);
//echo '</pre>';
//?>

<?php include __DIR__ . '/../footer.php'; ?>