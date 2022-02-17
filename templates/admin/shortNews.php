<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $title ?></h1><hr>
<?php foreach ($shortNews as $oneNews) {?>
    <div class="well comment" id="comment<?= $oneNews->getId() ?>">
    <div class="comment-header">
        <span class="uname"><?= $oneNews->getAuthor()->getNickname() ?></span>
        <span class="comment-data pull-right"><?= $oneNews->getDate() ?></span>
        <br>
    </div>
    <div class="comment-body">
        <?= $oneNews->getText() ?>
    </div>
        <a href="/shortNews/<?= $oneNews->getId() ?>/delete" class="icon-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg pull-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </a>
    </div>
<?php }?>

    <div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>