</div>

<div class="col-lg-3 col-lg-pull-9">
<div class="panel panel-info hidden-xs">
    <div class="panel-heading"><div class="sidebar-header">Поиск</div></div>
    <div class="panel-body">
        <form name="search" role="search" method="post" action="/games/search">
            <div class="form-group">
                <div class="input-group">
                    <input name="query" type="search" class="form-control input-lg" placeholder="Ваш запрос">
                    <div class="input-group-btn">
                        <button class="btn btn-default btn-lg" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="panel panel-info">
    <div class="panel-heading"><div class="sidebar-header">Вход</div></div>
    <div class="panel-body">
        <?php if (empty($user)) {?>
        <form action="/users/login" method="post">
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="Email"  name="email" value="<?= $_POST['email'] ?? '' ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" name="password" placeholder="Пароль">
            </div>
            <a href="/users/register" class="btn btn-success pull-left">регистрация</a>
            <button type="submit" class="btn btn-success pull-right">вход</button>
        </form>
        <?php } else {?>
            <p>Добро пожаловать, <?= $user->getNickname() ?></p>
            <br>
            <a href="/users/logout" class="btn btn-success pull-left">Выйти</a>
            <a href="/users/profile" class="btn btn-success pull-right">Профиль</a>
        <?php }?>
    </div>
</div>


<div class="panel panel-info">
    <div class="panel-heading"><div class="sidebar-header">Новости</div></div>
    <div class="panel-body">
        <p>22.11.21</p>
        <p>День рождения сайта</p>
    </div>
</div>

<?php if (!empty($topGames)) {?>
<div class="panel panel-info ">
    <div class="panel-heading"><div class="sidebar-header">Рейтинг</div></div>
    <div class="panel-body">
        <ul class="list-group">
            <?php foreach ($topGames as $game) {?>
            <li class="list-group-item list-group-success">
                <span class="badge"><?= $game->getRating() ?></span>
                <a href="/games/<?= $game->getId() ?>"><?= $game->getName() ?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
<?php }?>

</div>
</div>
</div>
<div class="clear"></div>
</div>

<footer>
    <div class="container">
        <p class="text-center"><a href="https://kan22.ru/">KAN</a></p>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/../assets/js/bootstrap.min.js"></script>

</body>
</html>
