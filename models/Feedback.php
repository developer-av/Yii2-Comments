<?php

namespace developerav\comments\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Gregwar\Image\Image;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $author
 * @property string $photo
 * @property string $text
 * @property string $created_at
 */
class Feedback extends ActiveRecord {

    public $file;
    public $x1;
    public $y1;
    public $x2;
    public $y2;
    public $oldRecord;

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => function() {
            return date('U');
        },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'feedback';
    }

    public function afterFind() {
        $this->oldRecord = clone $this;
        return parent::afterFind();
    }

    public function beforeDelete() {
        $this->deletePhoto();
        return parent::beforeDelete();
    }

    public function beforeSave($insert) {
        if ($this->file) {
            self::uploadFile($this);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['author', 'text'], 'required', 'on' => ['create', 'update']],
            [['created_at'], 'integer', 'on' => ['create', 'update']],
            [['author', 'text'], 'string', 'max' => 255, 'on' => ['create', 'update']],
            [['x1', 'y1', 'x2', 'y2'], 'safe', 'on' => ['create', 'update']],
            [
                ['file'],
                'image',
                'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024 * 1024 * 10, //10Мб
                'skipOnEmpty' => false,
                'on' => ['create'],
            ],
            [
                ['file'],
                'image',
                'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024 * 1024 * 10, //10Мб
                'on' => ['update'],
            ],
        ];
    }

    public function scenarios() {
        return [
            'create' => ['author', 'text', 'x1', 'y1', 'x2', 'y2', 'file'],
            'update' => ['author', 'text', 'x1', 'y1', 'x2', 'y2', 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'author' => Yii::t('comments', 'Автор'),
            'text' => Yii::t('comments', 'Текст'),
            'created_at' => Yii::t('comments', 'Создан'),
        ];
    }

    public function deletePhoto() {
        unlink(\Yii::getAlias(\Yii::$app->controller->module->path) . $this->photo);
    }

    /**
     *
     * @param Comments $obg
     */
    private static function uploadFile($obg) {
        if (!empty($obg->oldRecord->photo)) {
            unlink(\Yii::getAlias(\Yii::$app->controller->module->path) . $obg->oldRecord->photo);
        }
        $obg->photo = Yii::$app->security->generateRandomString() . '.' . $obg->file->extension;
        Image::open($obg->file->tempName)->useFallback(false)->crop($obg->x1, $obg->y1, $obg->x2 - $obg->x1, $obg->y2 - $obg->y1)->resize(220, 220)->save(\Yii::getAlias(\Yii::$app->controller->module->path) . $obg->photo);
    }

}
