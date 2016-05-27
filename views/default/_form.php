<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\imgareaselect\ImgAreaSelect;
use xj\imgareaselect\ImgareaselectAsset;
use developerav\comments\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */
/* @var $form yii\widgets\ActiveForm */

ImgareaselectAsset::registerWithStyle($this, ImgareaselectAsset::STYLE_DEFAULT);
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div style="max-width: 600px; margin: 0 auto;" class="text-center">
        <div id="preview-image"><img id="previewImage" src="" alt="preview"/></div>
        <label id="dropzone" for="uploadimage" class="dropzone text-muted">
            <i id="uploadIcon" class="fa fa-cloud-upload fa-5x"></i>
            <i id="loadingIcon" class="fa fa-spinner fa-spin fa-5x"></i>
            <br/>
            Перетащите сюда фотографию, или нажмите чтобы загрузка их.
            <br/>
            <span class="text-danger" id="upload-error"></span>
        </label>
    </div>

</div>
