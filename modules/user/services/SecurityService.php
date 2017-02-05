<?php

namespace app\modules\user\services;

use app\modules\user\adapters\IdentityInterfaceAdapter;
use app\modules\user\models\User;
use app\modules\user\Module;
use yii\base\Component;
use yii\base\ErrorException;

class SecurityService extends Component
{
    /** @var UserOnlineService */
    private $userOnlineService;

    /**
     * @inheritDoc
     */
    public function __construct(UserOnlineService $userOnlineService, array $config = [])
    {
        $this->userOnlineService = $userOnlineService;
        parent::__construct($config);
    }


    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function registerUser($name, $email, $password)
    {
        $newUser = new User();
        $newUser->username = $name;
        $newUser->email = $email;
        $newUser->password_hash = \Yii::$app->security->generatePasswordHash($password);
        $newUser->save();
        $this->loginUser($email, $password);
    }

    /**
     * @param $email
     * @param $password
     * @param int $duration
     * @throws ErrorException
     */
    public function loginUser($email, $password, $duration = 0)
    {
        $user = User::find()->findByEmail($email);
        if (!($user && \Yii::$app->security->validatePassword($password, $user->password_hash))) {
            throw new ErrorException(Module::t("module", "EMAIL_OR_PASSWORD_INCORRECT"));
        }
        $adapter = IdentityInterfaceAdapter::findIdentity($user->id);
        \Yii::$app->user->login($adapter, $duration);
        $this->userOnlineService->setWebUserOnline($user->id);
    }
}