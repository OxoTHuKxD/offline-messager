<?php

namespace app\modules\user\migrations;

use app\modules\user\Module;
use yii\db\Migration;

class M170204211321CreateUserStatusTable extends Migration
{
    /** @var \app\modules\user\Module */
    private $module;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        $this->module = Module::getThisModule();
    }

    public function safeUp()
    {
        $this->createTable($this->module->userStatusTableName, [
            'user_id' => $this->integer(),
            'liked_user_id' => $this->integer(),
            'PRIMARY KEY(user_id, liked_user_id)',
        ]);

        $this->createIndex(
            'idx-user_status-user_id',
            $this->module->userStatusTableName,
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_status-user_id',
            $this->module->userStatusTableName,
            'user_id',
            $this->module->userTableName,
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_status-liked_user_id',
            $this->module->userStatusTableName,
            'liked_user_id'
        );

        $this->addForeignKey(
            'fk-user_status-liked_user_id',
            $this->module->userStatusTableName,
            'liked_user_id',
            $this->module->userTableName,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_status-liked_user_id',
            $this->module->userStatusTableName
        );

        $this->dropIndex(
            'idx-user_status-liked_user_id',
            $this->module->userStatusTableName
        );

        $this->dropForeignKey(
            'fk-user_status-user_id',
            $this->module->userStatusTableName
        );

        $this->dropIndex(
            'idx-user_status-user_id',
            $this->module->userStatusTableName
        );

        $this->dropTable($this->module->userStatusTableName);
    }
}
