<?php

namespace app\modules\messages\services;

use app\modules\messages\models\Message;
use yii\data\ActiveDataProvider;

class MainService
{
    /**
     * @param int $userId
     * @param int $sentUserId
     * @return ActiveDataProvider
     */
    public function getInboxMessagesProvider($userId, $sentUserId = 0)
    {
        $query = Message::find()->userInbox($userId);
        if ($sentUserId !== 0) {
            $query->userSent($sentUserId);
        }
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
        ]);
    }

    /**
     * @param int $userId
     * @param int $inboxUserId
     * @return ActiveDataProvider
     */
    public function getSentMessagesProvider($userId, $inboxUserId = 0)
    {
        $query = Message::find()->userSent($userId);
        if ($inboxUserId !== 0) {
            $query->userInbox($inboxUserId);
        }
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
        ]);
    }

    /**
     * @param int $userId
     * @return ActiveDataProvider
     */
    public function getUnreadMessagesProvider($userId)
    {
        return new ActiveDataProvider([
            'query' => Message::find()->userInbox($userId)->unread(),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
            'pagination' => false
        ]);
    }

    /**
     * @param $firstUserId
     * @param $secondUserId
     * @return ActiveDataProvider
     */
    public function getDialogProvider($firstUserId, $secondUserId)
    {
        return new ActiveDataProvider([
            'query' => Message::find()->userDialog($firstUserId, $secondUserId),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);
    }

    /**
     * @param int $userId
     * @return int|string
     */
    public function getNewMessagesCount($userId)
    {
        return Message::find()->userInbox($userId)->unread()->count();
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