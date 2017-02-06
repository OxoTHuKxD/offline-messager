<?php

namespace app\modules\user\migrations;

use app\modules\user\Module;
use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170204_162526_create_user_table extends Migration
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

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->module->userTableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(60)->notNull(),
            'status_count' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->module->userTableName);
    }
}
