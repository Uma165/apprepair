<?php

use app\models\Schedule;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
</div>
    <div class="card ">
        <img src="../web/img/tr.jpg" class="card-img"
             style="height: 800px" alt="...">
        <div class="card-img-overlay" style="top: 400px">
            <h5 class="card-title text-center">АТЕЛЬЕ РЕМОНТ</h5>
            <p class="card-text text-center">Замки, дырки, грязное бельё? Не страшно со всеми проблемами справимся мы!</p>
            <p class="card-text text-center"><small></small></p>
        </div>
    </div>
    </div>


    <div>

</div>
    </div>
    <div class="bg-lime p-2 text-dark bg-opacity">
</div class="body-content">
<div class="bg-lime  p-2 text-dark bg-opacity">
    <div class="container">
        <p class="text-center fs-4">Услуги</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <? foreach ($categories as $category): ?>
                <div class="col text-center">
                    <div class="card">
                        <img src="../web/img/<?php echo $category['img']; ?>" class="card-img-top"
                            style="height: 290px;" alt="...">
                    <div class="card-body">
                        <h5 class="card-title "><?php echo $category['name']; ?></h5>
                        <a href="<?php echo Url::toRoute(['site/contact', 'id' => $category['id']]); ?>"
                           class="btn btn-success">Подробнее</a>
                    </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
        <div class="h-100 d-flex align-items-center justify-content-center mt-5">
            <?php echo LinkPager::widget([
                'pagination' => $pages,]);?>
        </div>
    </div>
    <div class="container">
        <p class="text-center fs-4">Расписание</p>
        <table class="table">
            <thead class="table-success">
            <tr>
                <th scope="col">Название</th>
                <th scope="col">День недели</th>
                <th scope="col">Время</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($schedules as $schedule): ?>
                <th scope="row"><?php echo $schedule->category->name; ?></th>
                <td><p><?php echo $schedule['day']['day'] ?><br></td>
                <td><?php echo $schedule['time']['time'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
