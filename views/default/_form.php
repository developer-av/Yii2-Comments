<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\imgareaselect\ImgAreaSelect;
use xj\imgareaselect\ImgareaselectAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */
/* @var $form yii\widgets\ActiveForm */

ImgareaselectAsset::registerWithStyle($this, ImgareaselectAsset::STYLE_DEFAULT);
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
