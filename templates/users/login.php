<?php include __DIR__ . '/../header.php'; ?>
    <h1>Вход</h1>
    <hr>
    <form action="/users/login" method="post">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label>Email <input class="form-control" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        </div>
        <div class="form-group">
            <label>Пароль <input class="form-control" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        </div>
        <input type="submit" class="btn btn-lg btn-success pull" value="Войти">
    </form>

    <div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>