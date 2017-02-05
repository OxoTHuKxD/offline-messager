<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\ChangePasswordForm;
use app\modules\user\services\SettingsService;
use yii\base\ErrorException;
use yii\base\Module;
use yii\web\Controller;

class SettingsController extends Controller
{
    /** @var SettingsService */
    private $settingsService;

    /**
     * @inheritDoc
     */
    public function __construct($id, Module $module, SettingsService $settingsService, array $config = [])
    {
        $this->settingsService = $settingsService;
        parent::__construct($id, $module, $config);
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->settingsService->changePasswordUser(\Yii::$app->user->id, $model->oldPassword, $model->password);
                $model->clearForm();
                \Yii::$app->session->setFlash('statusChangePasswordOk');
            } catch (ErrorException $e) {
                $model->addError('oldPassword', $e->getMessage());
            }
        }
        return $this->render('change-password-form', ['model' => $model]);
    }
}