<?php

namespace app\modules\contactList\controllers;

use app\modules\contactList\services\MainService;
use yii\base\ErrorException;
use yii\base\Module;
use yii\web\Controller;

/**
 * Default controller for the `contactList` module
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


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => $this->mainService->getUserContactsProvider(\Yii::$app->user->id)
        ]);
    }

    /**
     * @param int $id
     */
    public function actionAddContact($id)
    {
        try {
            $this->mainService->addUserContact(\Yii::$app->user->id, $id);
        } catch (ErrorException $e) {}
        $this->redirect(['/user/default/profile', 'id' => $id]);
    }

    /**
     * @param int $id
     */
    public function actionRemoveContact($id)
    {
        try {
            $this->mainService->removeUserContact(\Yii::$app->user->id, $id);
        } catch (ErrorException $e) {}
        $this->redirect(['/user/default/profile', 'id' => $id]);
    }
}
