<?php

namespace developerav\comments\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['author', 'text'], 'required'],
            [['created_at'], 'integer'],
            [['author', 'text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'author' => Yii::t('app', 'Author'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'created_at'),
        ];
    }

}
