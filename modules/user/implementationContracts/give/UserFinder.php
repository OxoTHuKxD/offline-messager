<?php

namespace app\modules\user\implementationContracts\give;

use app\modules\user\externalContracts\give\UserFinderInterface;
use app\modules\user\models\User;

class UserFinder implements UserFinderInterface
{
    /**
     * @inheritDoc
     */
    public function getUserById($id)
    {
        $user = User::findOne($id);
        return is_null($user) ? null : new \app\modules\user\implementationContracts\give\User($user);
    }

    /**
     * @inheritDoc
     */
    public function hasUserById($id)
    {
        return User::find()->where(['id' => $id])->exists();
    }

}