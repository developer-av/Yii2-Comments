<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Feedback',
]) . $model->author;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->author, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="feedback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="text-center"><?= Html::img(\Yii::getAlias('@web/'.\Yii::$app->controller->module->path).$model->photo, ['class' => 'img-circle']) ?></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
