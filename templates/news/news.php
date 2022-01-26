<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $title ?></h1><hr>
<?php foreach ($news as $oneNews) {?>
 <div class="row">
      <div class="well clearfix">
           <div class="col-lg-3 col-md-2">
                <a href="show.html"><img class="img-thumbnail" src="<?= $oneNews->getLinkImg() ?>" alt="<?= $oneNews->getName()?>"></a>
           </div>
           <div class="col-lg-9 col-md-10">
                <h3><?= $oneNews->getName()?></h3>
                <p><?= mb_substr($oneNews->getText(), 0, 300) . '...' ?></p>
           </div>
           <div class="col-lg-12">
                <a href="/news/<?= $oneNews->getId() ?>" class="btn btn-lg btn-success pull-right">подробнее</a>
           </div>
      </div>
 </div>
<?php }?>

 <div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>