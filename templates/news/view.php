<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $news->getName() ?></h1>
    <hr>
    <div class="embed-responsive embed-responsive-16by9" >
        <img src="<?= $news->getLinkImg() ?>" alt="news<?= $news->getId() ?>" class="img-fluid">
    </div>
    <br>
    <p><?= $news->getText() ?></p>
    <p>Автор: <i><?= $news->getAuthor()->getNickname() ?></i></p>
    <?php if ($user !== null && $user->isAdmin()) {?>
        <a href="/news/<?= $news->getId() ?>/edit" class="btn btn-lg btn-success pull-right">Редактировать</a>
    <?php }?>
    <div class="margin-8"></div>

    <h3>Комментарии:</h3>
    <hr>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ($user === null) {?>
        <p class="font-weight-bold text-center">Нужно <a href="/users/login">авторизоваться</a> для добавления комментария</p>
    <?php } else { ?>
    <?php  if (empty($editedComment)) {?>
        <form action="/comments/<?= $news->getId() ?>/add " method="post">
            <div class="form-group">
                <label for="textarea">Комментарий <textarea class="form-control" id="textarea" name="text" id="text" rows="10" cols="80" required></textarea></label>
            </div>
            <button class="btn btn-lg btn-success pull-left">отправить</button>
        </form>
    <?php } else {?>
        <form action="/comments/<?= $editedComment->getId() ?>/edit " method="post">
            <div class="form-group">
                <label for="textarea">Комментарий <textarea class="form-control" id="textarea" name="text" id="text" rows="10" cols="80" required><?= $editedComment->getText() ?></textarea></label>
            </div>
            <button class="btn btn-lg btn-success pull-left">редактировать</button>
        </form>
        <?php } ?>
    <?php } ?>
    <div class="margin-8 clear"></div>
    <?php if (!empty($comments)) {?>
        <?php foreach ($comments as $comment) {?>
        <div class="well comment" id="comment<?= $comment->getId() ?>">
            <div class="comment-header">
                <div class="col-lg-2 col-md-2 col-xs-3 text-center">
                    <img src="<?= $comment->getAuthor()->getAvatar() ?>" alt="<?= $comment->getAuthor()->getNickname() ?>" class="avatar">
                    <br>
                    <span class="uname"><?= $comment->getAuthor()->getNickname() ?></span>
                </div>
                <span class="pull-right"><?php if ($comment->isAuthor($user)) {?>
                        <a href="/comments/<?= $comment->getId() ?>/delete" class="icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg pull-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </a>
            <?php if ($comment->isAuthor($user) ) {?>
                            <a href="/comments/<?= $comment->getId() ?>/edit" class="icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill pull-right" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
            </a>
                        <?php }
                    } ?></span>
                <br>
            </div>
            <div class="comment-body">
                <?= $comment->getText() ?>
            </div>
            <div class="comment-data pull-right"><?= $comment->getCreatedAt() ?></div>
        </div>

    <?php }
    }?>

<?php include __DIR__ . '/../footer.php'; ?>