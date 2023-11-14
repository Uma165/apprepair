<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clothe $model */

$this->title = 'Create Clothe';
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clothe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
