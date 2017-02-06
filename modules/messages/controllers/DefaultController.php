<?php

namespace app\modules\messages\controllers;

use app\modules\messages\services\MainService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `messages` module
 */
class DefaultController extends Controller
{
    /** @var MainService */
    private $mainService;

    /**
     * @inheritDoc
     */
    public function __construct($id, Module $module, MainService $mainService, array $config = [])
    {
        $this->mainService = $mainService;
        parent::__construct($id, $module, $config);
    }

    public function actionShowInboxMessages()
    {
        return $this->render('show-inbox', ['dataProvider' => $this->mainService->getInboxMessagesProvider(\Yii::$app->user->id)]);
    }

    public function actionShowSentMessages()
    {
        return $this->render('show-sent', ['dataProvider' => $this->mainService->getSentMessagesProvider(\Yii::$app->user->id)]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewMessage($id)
    {
        $message = $this->mainService->getMessage($id);
        if(!$message){
            throw new NotFoundHttpException(\app\modules\messages\Module::t("module", "MESSAGE_NOT_FOUND"));
        }
        return $this->render('view', ['message' => $message]);
    }
}
