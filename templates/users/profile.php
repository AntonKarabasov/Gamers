<?php include __DIR__ . '/../header.php'; ?>
    <h1>Профиль</h1>
    <hr>
    <form action="/users/profile" method="post" enctype="multipart/form-data">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <div class="form-group pull-right">
            <img src="<?= $user->getAvatar() ?>" alt="<?= $user->getNickname() ?>" class="avatar-profile" id="picture">
            <br>
            <label for="picture" class="avatar-label">Аватар</label>
            <input type="file" class="form-control-file"  name="attachment" value="<?= $_FILES['attachment'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label>Nickname <input class="form-control" type="text" name="nickname" value="<?= $_POST['nickname'] ?? $user->getNickname() ?>"></label>
        </div>
        <div class="form-group">
            <label>Email <input class="form-control" type="text" name="email" value="<?= $_POST['email'] ?? $user->getEmail() ?>"></label>
        </div>
        <div class="form-group">
            <label>Пароль <input class="form-control" type="password" name="password"></label>
        </div>
        <div class="form-group">
            <label>Повторите пароль <input class="form-control" type="password" name="repeatedPassword" ></label>
        </div>
        <div class="form-group">
            <label>Дата рождения <input class="form-control" type="date" name="date" value="<?= $user->getDateOfBirth() ?? "1990-01-01" ?>"></label>
        </div>
        <input type="submit" class="btn btn-lg btn-success pull" value="Сохранить изменения">
    </form>

    <div class="margin-8 clear"></div>
<?php include __DIR__ . '/../footer.php'; ?>