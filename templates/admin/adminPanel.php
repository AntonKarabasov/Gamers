<?php include __DIR__ . '/../header.php'; ?>
    <h1>Админка</h1>
    <hr>
    <div class="form-group">
        <div class="row">
            <a href="/games/add" class="btn btn-success">Добавить игру</a>
            <a href="/news/add" class="btn btn-success">Добавить новость</a>
            <a href="/shortNews/add" class="btn btn-success">Добавить быструю новость</a>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <a href="/admin/games" class="btn btn-success">Все игры</a>
            <a href="/admin/news" class="btn btn-success">Все новости</a>
            <a href="/admin/shortNews" class="btn btn-success">Все быстрые новости</a>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <a href="/users/profile" class="btn btn-success">Профиль</a>
        </div>
    </div>
    <div class="margin-8 clear"></div>

<?php include __DIR__ . '/../footer.php'; ?>