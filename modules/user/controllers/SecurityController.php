<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\LoginForm;
use app\modules\user\forms\RegisterForm;
use app\modules\user\services\SecurityService;
use yii\base\ErrorException;
use yii\base\Module;
use yii\web\Controller;

class SecurityController extends Controller
{
    /** @var SecurityService */
    private $securityService;

    /**
     * @inheritDoc
     */
    public function __construct($id, Module $module, SecurityService $securityService, array $config = [])
    {
        $this->securityService = $securityService;
        parent::__construct($id, $module, $config);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->securityService->registerUser($model->name, $model->email, $model->password);
            return $this->goHome();
        }
        return $this->render('register-form', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->securityService->loginUser($model->email, $model->password, $model->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (ErrorException $e) {
                $model->addError('password', $e->getMessage());
            }
        }
        return $this->render('login-form', ['model' => $model]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }
}