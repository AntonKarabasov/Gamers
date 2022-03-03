<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $title ?></h1><hr>
<?php foreach ($news as $oneNews) {?>
 <div class="row">
      <div class="well clearfix">
           <div class="col-lg-3 col-md-2">
                <a href="/news/<?= $oneNews->getId() ?>"><img class="img-thumbnail" src="<?= $oneNews->getLinkImg() ?>" alt="<?= $oneNews->getName()?>"></a>
           </div>
           <div class="col-lg-9 col-md-10">
                <a href="/news/<?= $oneNews->getId() ?>"><h3><?= $oneNews->getName()?></h3></a>
                <p><?= mb_substr($oneNews->getText(), 0, 300) . '...' ?></p>
           </div>
      </div>
 </div>
<?php }?>

<div class="text-center">
    <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++): ?>
        <?php if ($currentPageNum === $pageNum): ?>
            <b><?= $pageNum ?></b>
        <?php else: ?>
            <a href="/news/page/<?= $pageNum ?>"><?= $pageNum ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>

 <div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>