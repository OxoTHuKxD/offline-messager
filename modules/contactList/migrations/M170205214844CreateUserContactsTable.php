<?php

namespace app\modules\contactList\migrations;

use app\modules\contactList\Module;
use yii\db\Migration;

class M170205214844CreateUserContactsTable extends Migration
{
    /** @var \app\modules\contactList\Module */
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
        $this->createTable($this->module->userContactListTableName, [
            'user_id' => $this->integer(),
            'contact_user_id' => $this->integer(),
            'PRIMARY KEY(user_id, contact_user_id)',
        ]);

        $this->createIndex(
            'idx-user_contact_list-user_id',
            $this->module->userContactListTableName,
            'user_id'
        );

        $this->createIndex(
            'idx-user_contact_list-contact_user_id',
            $this->module->userContactListTableName,
            'contact_user_id'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-user_contact_list-contact_user_id',
            $this->module->userContactListTableName
        );

        $this->dropIndex(
            'idx-user_contact_list-user_id',
            $this->module->userContactListTableName
        );

        $this->dropTable($this->module->userContactListTableName);
    }
}
