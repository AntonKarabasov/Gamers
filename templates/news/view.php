<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $news->getName() ?></h1>
    <hr>
    <div class="embed-responsive embed-responsive-16by9" >
        <img src="<?= $news->getLinkImg() ?>" alt="news<?= $news->getId() ?>" class="img-fluid">
    </div>
    <br>
    <p><?= $news->getText() ?></p>
    <p>Автор: <i><?= $news->getAuthor()->getNickname() ?></i></p>

    <div class="margin-8"></div>

    <h3>Комментарии:</h3>
    <hr>
    <div class="well comment">
        <div class="comment-header">
            <img src="/../assets/img/avatar/avatar.jpg" alt="Кэмерон" class="avatar">
            <span class="uname">Кэмерон</span>
            <span class="comment-data pull-right">23.11.21</span>
            <br>
        </div>
        <div class="comment-body">It's a great game!</div>
    </div>

    <form>
        <div class="form-group">
            <input type="text" placeholder="ваше имя" class="form-control input-lg">
        </div>
        <div class="form-group">
            <textarea class="form-control"></textarea>
        </div>
        <button class="btn btn-lg btn-success pull-right">отправить</button>
    </form>

    <div class="margin-8 clear"></div>

<?php include __DIR__ . '/../footer.php'; ?>