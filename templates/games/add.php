<?php include __DIR__ . '/../header.php'; ?>
<h1>Добавление новой игры</h1>
<hr>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>
<form action="/games/add" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="picture">Постер</label>
        <input type="file" class="form-control-file" id="picture" name="attachment" value="<?= $_FILES['attachment'] ?? '' ?>">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-xs-5">
                <input class="form-control" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" placeholder="Название игры">
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4">
                <input class="form-control" type="url" name="linkVideo" value="<?= $_POST['linkVideo'] ?? '' ?>" placeholder="Ссылка на видео">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3">
                <label>Дата выхода <input class="form-control" type="date" name="date" value="<?= $_POST['date'] ?? '' ?>"></label>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <label>Рейтинг <input class="form-control" type="number" name="rating" min="0" max="10" step="0.1" value="<?= $_POST['rating'] ?? '' ?>"></label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <h3>Платформы</h3>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label PC" for="PC"><input type="checkbox" class="custom-control-input" id="PC" name="platforms[]" value="1"> PC</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label nintendo" for="Wii U"><input type="checkbox" class="custom-control-input" id="Wii U" name="platforms[]" value="8"> Wii U</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label nintendo" for="Nintendo Switch"><input type="checkbox" class="custom-control-input" id="Nintendo Switch" name="platforms[]" value="9"> Nintendo Switch</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label PS" for="PS3"><input type="checkbox" class="custom-control-input" id="PS3" name="platforms[]" value="2"> PS3</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label PS" for="PS4"><input type="checkbox" class="custom-control-input" id="PS4" name="platforms[]" value="3"> PS4</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label PS" for="PS5"><input type="checkbox" class="custom-control-input" id="PS5" name="platforms[]" value="4"> PS5</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label xbox" for="Xbox 360"><input type="checkbox" class="custom-control-input" id="Xbox 360" name="platforms[]" value="5"> Xbox 360</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label xbox" for="Xbox One"><input type="checkbox" class="custom-control-input" id="Xbox One" name="platforms[]" value="6"> Xbox One</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label xbox" for="Xbox XS"><input type="checkbox" class="custom-control-input" id="Xbox XS" name="platforms[]" value="7"> Xbox XS</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <h3>Жанры</h3>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Action-adventure"><input type="checkbox" class="custom-control-input" id="Action-adventure" name="genres[]" value="1"> Action-adventure</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="TPS"><input type="checkbox" class="custom-control-input" id="TPS" name="genres[]" value="2"> TPS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="FPS"><input type="checkbox" class="custom-control-input" id="FPS" name="genres[]" value="3"> FPS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="RPG"><input type="checkbox" class="custom-control-input" id="RPG" name="genres[]" value="4"> RPG</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="RTS"><input type="checkbox" class="custom-control-input" id="RTS" name="genres[]" value="5"> RTS</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="TBS"><input type="checkbox" class="custom-control-input" id="TBS" name="genres[]" value="6"> TBS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Racing"><input type="checkbox" class="custom-control-input" id="Racing" name="genres[]" value="7"> Racing</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Fighting"><input type="checkbox" class="custom-control-input" id="Fighting" name="genres[]" value="8"> Fighting</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Quest"><input type="checkbox" class="custom-control-input" id="Quest" name="genres[]" value="9"> Quest</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Stealth"><input type="checkbox" class="custom-control-input" id="Stealth" name="genres[]" value="10"> Stealth</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3">
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Horror"><input type="checkbox" class="custom-control-input" id="Horror" name="genres[]" value="11"> Horror</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="MMORPG"><input type="checkbox" class="custom-control-input" id="MMORPG" name="genres[]" value="12"> MMORPG</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <label class="custom-control-label" for="Slasher"><input type="checkbox" class="custom-control-input" id="Slasher" name="genres[]" value="13"> Slasher</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-xs-9">
                <textarea class="form-control" id="Textarea" name="text" id="text" rows="6" cols="50" placeholder="Описание"><?= $_POST['text'] ?? '' ?></textarea>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-lg btn-success pull" value="Создать">
</form>
<div class="margin-8"></div>
<?php include __DIR__ . '/../footer.php'; ?>
