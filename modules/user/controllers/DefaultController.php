<?php

namespace app\modules\user\controllers;

use app\modules\user\services\MainService;
use yii\base\ErrorException;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `user` module
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

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['change-status-user'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['dataProvider' => $this->mainService->getUserListProvider()]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProfile($id)
    {
        if (!$model = $this->mainService->getUser(intval($id))) {
            throw new NotFoundHttpException(\app\modules\user\Module::t('module', 'USER_NOT_FOUND'));
        }
        return $this->render('profile', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionChangeStatusUser($id)
    {
        try {
            $this->mainService->changeLikeStatus(\Yii::$app->user->id, intval($id));
            \Yii::$app->session->setFlash('statusChangeResultOk');
        } catch (ErrorException $e) {
            \Yii::$app->session->setFlash('statusChangeResultError');
        }
        return $this->redirect(['default/profile', 'id' => $id]);
    }
}
