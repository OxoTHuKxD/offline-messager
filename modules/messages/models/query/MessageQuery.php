<?php

namespace app\modules\messages\models\query;
use app\modules\messages\models\Message;
use yii\db\ActiveQuery;

/**
 * @see \app\modules\messages\models\Message
 */
class MessageQuery extends ActiveQuery
{
    public function userDialog($firstUserId, $secondUserId)
    {
        return $this->andWhere([
            'or',
            ['user_sent_id' => $firstUserId, 'user_inbox_id' => $secondUserId],
            ['user_inbox_id' => $firstUserId, 'user_sent_id' => $secondUserId]
        ]);
    }
    /**
     * @param int $userId
     * @return $this
     */
    public function userSent($userId)
    {
        return $this->andWhere(['user_sent_id' => $userId]);
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function userInbox($userId)
    {
        return $this->andWhere(['user_inbox_id' => $userId]);
    }

    /**
     * @return $this
     */
    public function unread()
    {
        return $this->andWhere(['status' => Message::STATUS_UNREAD]);
    }

    /**
     * @return $this
     */
    public function read()
    {
        return $this->andWhere(['status' => Message::STATUS_READ]);
    }

    /**
     * @inheritdoc
     * @return \app\modules\messages\models\Message[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\messages\models\Message|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
