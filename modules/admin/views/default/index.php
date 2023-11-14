<?php
use \yii\helpers\Url;
?>
<div class="admin-default-index">
    <h1>Добро пожаловать в админ панель!</h1>
    <p>Здесь можно редактировать заявки и их категории</p>
    <div class="my-3">
        <button type="button" class="btn btn-success"><a href="<?php echo Url::toRoute(['schedule/index'])?>" class="text-light text-decoration-none">Расписание</a></button>
        <button type="button" class="btn btn-success"><a href="<?php echo Url::toRoute(['category/index'])?>" class="text-light text-decoration-none">Категории услуг</a></button>
        <button type="button" class="btn btn-success"><a href="<?php echo Url::toRoute(['post/index'])?>" class="text-light text-decoration-none">Услаги</a></button>
    </div>
</div>
