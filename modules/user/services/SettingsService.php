<?php

namespace app\modules\user\services;

use app\modules\user\models\User;
use app\modules\user\Module;
use yii\base\Component;
use yii\base\ErrorException;

class SettingsService extends Component
{
    /**
     * @param $userId
     * @param $oldPassword
     * @param $newPassword
     * @throws ErrorException
     * @throws \yii\base\Exception
     */
    public function changePasswordUser($userId, $oldPassword, $newPassword)
    {
        $user = User::findOne($userId);
        if (!$user) {
            throw new ErrorException(Module::t("module", "USER_NOT_FOUND"));
        }
        if (!\Yii::$app->security->validatePassword($oldPassword, $user->password_hash)) {
            throw new ErrorException(Module::t("module", "OLD_PASSWORD_INCORRECT"));
        }
        $user->password_hash = \Yii::$app->security->generatePasswordHash($newPassword);
        $user->save();
    }
}