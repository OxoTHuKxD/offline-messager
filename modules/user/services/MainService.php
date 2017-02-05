<?php

namespace app\modules\user\services;

use app\modules\user\Module;
use app\modules\user\models\User;
use app\modules\user\models\UserStatus;
use yii\base\Component;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;

class MainService extends Component
{
    /**
     * @return ActiveDataProvider
     */
    public function getUserListProvider()
    {
        return new ActiveDataProvider([
            'query' => User::find(),
        ]);
    }

    /**
     * @param int $id
     * @return User|array|null
     */
    public function getUser($id)
    {
        return User::findOne($id);
    }

    /**
     * @param $userId
     * @param $likedUserId
     * @throws ErrorException
     * @throws \Exception
     * @throws \Throwable
     */
    public function changeLikeStatus($userId, $likedUserId)
    {
        $userStatus = UserStatus::find()->where(['user_id' => $userId, 'liked_user_id' => $likedUserId])->one();
        \Yii::trace($userStatus);
        if (!$userStatus) {
            $userStatus = new UserStatus();
            $userStatus->user_id = $userId;
            $userStatus->liked_user_id = $likedUserId;
            try {
                $userStatus->save(false);
            } catch (\Exception $e) {
                throw new ErrorException(Module::t("module", "STATUS_NOT_CHANGED"));
            }
        } else {
            $userStatus->delete();
        }
    }
}