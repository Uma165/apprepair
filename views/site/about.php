<?php

/** @var yii\web\View $this */

use yii\helpers\Html;


$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<?  foreach ($clothes as $clothe):?>
<div class="card">
    <div class="card-body">
        <?php echo $clothe['name']; ?>
    </div>
<?php endforeach;?>
</div>
