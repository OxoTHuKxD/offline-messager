<?php

namespace app\modules\messages\controllers;

use app\modules\messages\services\MainService;
use yii\base\Module;
use yii\web\Controller;

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

    /**
     * @param $userId
     * @return string
     */
    public function actionDialog($userId)
    {
        return $this->render('dialog', ['userId' => $userId]);
    }
}
