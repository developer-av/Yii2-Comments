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

$this->registerJs('
        if(typeof(previewImage.setOptions) == "function"){
            previewImage.setOptions({hide: true});
            console.log("off");
        }
        $("#createForm").off("afterValidateAttribute");
        $("#updateForm").off("afterValidateAttribute");
        ');
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'file', ['options' => ['style' => 'display: none;'], 'selectors' => ['input' => '#uploadimage']])->fileInput(['id' => 'uploadimage'])->label(false) ?>

    <?= $form->field($model, 'x1', ['options' => ['style' => 'display: none;']])->hiddenInput(['id' => 'x1Cord'])->label(false); ?>

    <?= $form->field($model, 'y1', ['options' => ['style' => 'display: none;']])->hiddenInput(['id' => 'y1Cord'])->label(false); ?>

    <?= $form->field($model, 'x2', ['options' => ['style' => 'display: none;']])->hiddenInput(['id' => 'x2Cord'])->label(false); ?>

    <?= $form->field($model, 'y2', ['options' => ['style' => 'display: none;']])->hiddenInput(['id' => 'y2Cord'])->label(false); ?>

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

<?php
ImgAreaSelect::widget([
    'id' => '#previewImage',
    'clientOptions' => [
        'minWidth' => 300,
        'minHeight' => 300,
        'aspectRatio' => '1:1',
//        'parent' => ($model->isNewRecord ? '#createModal' : '#updateModal').' .modal-content',
        'persistent' => true,
        'show' => true,
        'instance' => true,
        'x1' => 0,
        'y1' => 0,
        'x2' => 0,
        'y2' => 0,
    ],
    'var' => 'previewImage',
]);
$this->registerJs("
    input = $('#uploadimage')[0];
    $('#" . ($model->isNewRecord ? 'createForm' : 'updateForm') . "').on('afterValidateAttribute', function (buff, buff, msg) {
        console.log('тут');
    if (msg.length === 0)
    {
        if (buff.id == 'uploadimage')
        {
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#dropzone').css('display', 'inline-block');
                $('#preview-image').css('display', 'none');
                $('#preview-image img').attr('src', '');
            }
        }
    } else {
        $('#upload-error').html(msg[0]);
        dropzone.removeClass('noDrop');
        $('#uploadIcon').css('display', 'inline-block');
        $('#loadingIcon').css('display', 'none');
    }
});

$('#" . ($model->isNewRecord ? 'createForm' : 'updateForm') . "').on('beforeSubmit', function () {
    console.log('test');
    $('#x1Cord').val(previewImage.getSelection().x1);
    $('#y1Cord').val(previewImage.getSelection().y1);
    $('#x2Cord').val(previewImage.getSelection().x2);
    $('#y2Cord').val(previewImage.getSelection().y2);
});
        ");
ImgareaselectAsset::registerWithStyle($this, ImgareaselectAsset::STYLE_DEFAULT);
?>