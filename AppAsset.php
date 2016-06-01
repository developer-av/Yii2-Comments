<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace developerav\comments;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $sourcePath = '@vendor/developer-av/yii2-comments/';
    public $baseUrl = '@web';
    public $css = [
        'assets/style.css',
    ];
    public $js = [
        'assets/main.js',
    ];

}
