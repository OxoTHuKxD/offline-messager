<?php

namespace app\modules\messages\services;

use app\modules\messages\models\Message;
use yii\data\ActiveDataProvider;

class MainService
{
    /**
     * @param $userId
     * @return ActiveDataProvider
     */
    public function getInboxMessagesProvider($userId)
    {
        return new ActiveDataProvider([
            'query' => Message::find()->userInbox($userId),
        ]);
    }

    /**
     * @param $userId
     * @return ActiveDataProvider
     */
    public function getSentMessagesProvider($userId)
    {
        return new ActiveDataProvider([
            'query' => Message::find()->userSent($userId),
        ]);
    }

    /**
     * @param int $id
     * @return Message|null
     */
    public function getMessage($id)
    {
        return Message::findOne($id);
    }
}