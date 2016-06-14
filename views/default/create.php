<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title = Yii::t('comments', 'Создать отзыв');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
