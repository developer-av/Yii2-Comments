<?php

use yii\db\Schema;
use yii\db\Migration;

class m160526_180905_create_feedback extends Migration {

    public function up() {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('feedback', [
            'id' => "INT(16)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'author' => "VARCHAR(255)  NOT NULL",
            'photo' => "VARCHAR(255)  NOT NULL",
            'text' => "VARCHAR(255)  NOT NULL",
            'created_at' => "BIGINT  DEFAULT NULL",
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('feedback');
        return true;
    }

}
