<?php include __DIR__ . '/../header.php'; ?>
<h1>Регистрация</h1>
<hr>
<form action="/users/register" method="post">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label>Nickname <input class="form-control" type="text" name="nickname" value="<?= $_POST['nickname'] ?? '' ?>"></label>
    </div>
    <div class="form-group">
        <label>Email <input class="form-control" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
    </div>
    <div class="form-group">
        <label>Пароль <input class="form-control" type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
    </div>
    <div class="form-group">
        <label>Повторите пароль <input class="form-control" type="password" name="repeatedPassword" ></label>
    </div>
    <div class="form-group">
        <input required type="checkbox">
        <span>Я согласен(а) с <a href="/policy.html" target="_blank">политикой конфиденциальности</a></span>
    </div>
    <input type="submit" class="btn btn-lg btn-success pull" value="Зарегистрироваться">
</form>

<div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>
