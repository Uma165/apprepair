<?php

/** @var app\models\Post $model */
/** @var app\models\Category $model */
use yii\helpers\Url;

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\widgets\MaskedInput;?>


<div class="row row-cols-1 row-cols-md-3 g-4">
    <?  foreach ($posts as $post):?>
    <div class="col">
        <div class="card">
            <img src="../web/img/<?php echo $post['img']; ?>" class="card-img-top " style="height: 400px">
            <div class="card-body mb-3">
                <h5 class="card-title"><?php echo $post['name']; ?></h5>
                <h4 class="card-text "><?php echo $post['content']; ?></h4>
                <h5 class="card-title">Стоимость: <?php echo $post['price']; ?> руб.</h5>
                <h6 class="card-text"><small class="text-body-secondary">Сделаем за <?php echo $post['term']; ?></small></h6>
            </div>
        </div>
    </div>
      <?php endforeach;?>
</div>

<?php foreach ($status as $comment):?>
    <p><?php echo $comment->body?></p>
<?php endforeach;?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
        'inputOptions' => ['class' => 'col-lg-3 form-control'],
        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
    ],
]); ?>

<?= $form->field($model, 'body')->textInput(['autofocus' => true]) ?>


<div class="form-group">
    <div>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-outline-secondary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

