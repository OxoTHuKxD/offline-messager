<?php

namespace app\modules\messages\controllers;

use app\modules\messages\forms\MessageForm;
use app\modules\messages\services\SendService;
use yii\base\ErrorException;
use yii\base\Module;
use yii\web\Controller;

class SendController extends Controller
{
    /** @var SendService */
    private $sendService;

    /**
     * @inheritDoc
     */
    public function __construct($id, Module $module, SendService $sendService, array $config = [])
    {
        $this->sendService = $sendService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($userId = 0)
    {
        /** @var MessageForm $model */
        $model = \Yii::createObject('app\modules\messages\forms\MessageForm');
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->sendService->sendMessage(\Yii::$app->user->id, $model->userId, $model->message);
                $this->redirect(\Yii::$app->user->returnUrl ? \Yii::$app->user->returnUrl : ['/messages/default/dialog', 'userId' => $model->userId]);
            }catch (ErrorException $e){
                $model->addError('userId', $e->getMessage());
            }
        }
        if ($userId && !$model->userId) {
            $model->userId = $userId;
        }
        \Yii::$app->user->setReturnUrl('');
        return $this->render('message-form', ['model' => $model]);
    }
}