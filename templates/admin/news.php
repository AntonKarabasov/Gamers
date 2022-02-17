<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $title ?></h1><hr>
<?php foreach ($news as $oneNews) {?>
    <div class="row news">
        <div class="well clearfix">
            <div class="col-lg-3 col-md-2">
                <a href="/news/<?= $oneNews->getId() ?>"><img class="img-thumbnail" src="<?= $oneNews->getLinkImg() ?>" alt="<?= $oneNews->getName()?>"></a>
            </div>
            <div class="col-lg-9 col-md-10 news-body">
                <a href="/news/<?= $oneNews->getId() ?>"><h3><?= $oneNews->getName()?></h3></a>
                <p><?= mb_substr($oneNews->getText(), 0, 300) . '...' ?></p>
            </div>
            <a href="/news/<?= $oneNews->getId() ?>/delete" class="icon-button news-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg pull-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </a>
        </div>
    </div>
<?php }?>

<div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>
