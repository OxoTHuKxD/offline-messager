<?php

namespace app\modules\user\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\user\models\User]].
 *
 * @see \app\modules\user\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /**
     * @param string $email
     * @return \app\modules\user\models\User|array|null
     */
    public function findByEmail($email)
    {
        return $this->andWhere(['email' => $email])->one();
    }

    /**
     * @inheritdoc
     * @return \app\modules\user\models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\user\models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
