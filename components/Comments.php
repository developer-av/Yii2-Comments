<?php

namespace developerav\comments\components;

use yii\base\Widget;
use developerav\comments\models\Feedback;

class Comments extends Widget {

    public $viewPath;

    public function init() {
        parent::init();
    }

    public function run() {
        $models = Feedback::find()->all();
        return $this->render(($this->viewPath != null? $this->viewPath : 'comments'), ['models' => $models]);
    }

}
