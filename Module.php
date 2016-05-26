<?php

namespace developerav\comments;

use Yii;

class Module extends \yii\base\Module {

    public function init() {
        if (!isset(Yii::$app->i18n->translations['comments'])) {
            Yii::$app->i18n->translations['comments'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru-RU',
                'basePath' => '@vendor/developer-av/yii2-comments/messages'
            ];
        }
        parent::init();
    }

}
