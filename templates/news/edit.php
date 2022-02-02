<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование статьи</h1>
    <hr>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>
    <div class="embed-responsive embed-responsive-16by9" >
        <img src="<?= $news->getLinkImg() ?>" alt="news<?= $news->getId() ?>" class="img-fluid">
    </div>
    <form action="/news/<?= $news->getId() ?>/edit" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture">Картинка</label>
            <input type="file" class="form-control-file" id="picture" name="attachment" value="<?= $_FILES['attachment'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label>Название статьи <input class="form-control" type="text" name="name" value="<?= $_POST['name'] ?? $news->getName() ?>"></label>
        </div>
        <div class="form-group">
            <label for="textarea">Текст статьи <textarea class="form-control" id="textarea" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $news->getText() ?></textarea></label>
        </div>
        <input type="submit" class="btn btn-lg btn-success pull" value="Обновить">
    </form>
    <div class="margin-8"></div>
<?php include __DIR__ . '/../footer.php'; ?>