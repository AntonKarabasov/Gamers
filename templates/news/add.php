<?php include __DIR__ . '/../header.php'; ?>
    <h1>Создание новой статьи</h1>
    <hr>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>
    <form action="/news/add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture">Картинка</label>
            <input type="file" class="form-control-file" id="picture" name="attachment" value="<?= $_FILES['attachment'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label>Название статьи <input class="form-control" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>"></label>
        </div>
        <div class="form-group">
            <label for="Textarea">Текст статьи <textarea class="form-control" id="Textarea" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea></label>
        </div>
        <input type="submit" class="btn btn-lg btn-success pull" value="Создать">
    </form>
<div class="margin-8"></div>
<?php include __DIR__ . '/../footer.php'; ?>
<!--<div class="embed-responsive embed-responsive-16by9" >-->
<!--    <img src="/../assets/img/news/news--><?//= $news->getId() ?><!--.jpg" alt="news--><?//= $news->getId() ?><!--">-->
<!--</div>-->


