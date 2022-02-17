<?php include __DIR__ . '/../header.php'; ?>
    <h1>Создание новой быстрой новости</h1>
    <hr>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>
    <form action="/shortNews/add" method="post">
        <div class="form-group">
            <label for="textarea">Текст быстрой новости <textarea class="form-control" id="textarea" name="text" id="text" rows="5" cols="50"><?= $_POST['text'] ?? '' ?></textarea></label>
        </div>
        <input type="submit" class="btn btn-lg btn-success pull" value="Создать">
    </form>
    <div class="margin-8"></div>
<?php include __DIR__ . '/../footer.php'; ?>