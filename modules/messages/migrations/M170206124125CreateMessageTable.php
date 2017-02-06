<?php

namespace app\modules\messages\migrations;

use app\modules\messages\Module;
use yii\db\Migration;

class M170206124125CreateMessageTable extends Migration
{
    /** @var \app\modules\messages\Module */
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
        $this->createTable($this->module->messagesTableName, [
            'id' => $this->primaryKey(),
            'user_sent_id' => $this->integer()->notNull(),
            'user_inbox_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-messages-user_sent_id',
            $this->module->messagesTableName,
            'user_sent_id'
        );

        $this->createIndex(
            'idx-messages-user_inbox_id',
            $this->module->messagesTableName,
            'user_inbox_id'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-messages-user_inbox_id',
            $this->module->messagesTableName
        );

        $this->dropIndex(
            'idx-messages-user_sent_id',
            $this->module->messagesTableName
        );

        $this->dropTable($this->module->messagesTableName);
    }
}
