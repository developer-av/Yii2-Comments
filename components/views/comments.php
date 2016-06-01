<?php
/* @var $this yii\web\View */
/* @var $model developerav\comments\models\Feedback */

use yii\helpers\Html;

$first = true;

use developerav\comments\WidgetAsset;

$test = WidgetAsset::register($this);

$this->registerCss('
#myCarousel img {
    border-radius: 50%;
    margin: auto;
}

.carousel-control .arrow img{
    position: absolute;
    z-index: 5;
    bottom: 0;
    right: 0;
    top: 0;
    left: 0;
}

.item > .row
{
    width: 70%;
    left: 15%;
    position: relative;
    padding-top: 50px;
    padding-bottom: 50px;
}

.carousel-control.left, .carousel-control.right {
    background-image: none;
    position: absolute;
}

.carousel {
    position: relative;
}

        ');
?>
    <div class="container">
        <div class="row">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
                    <?php foreach ($models as $model): ?>
            <div class="item <?php if ($first === true) {
                            echo 'active';
                            $first = false;
                        } ?>">
                <div class="row">
                    <div class="col-md-4">
    <?= Html::img(\yii::$app->params['feedbackPath'] . $model->photo, ['alt' => 'Ecso для ' . $model->author]) ?>
                    </div>
                    <div class="col-md-8">
                        <h3><?= $model->author ?></h3>
                        <p><?= $model->text ?></p>
                    </div>
                </div>
            </div>
<?php endforeach; ?>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class='arrow'><img src="<?= $test->baseUrl ?>/img/arrow_left.png"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class='arrow'><img src="<?= $test->baseUrl ?>/img/arrow_right.png"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

                    </div>
    </div>