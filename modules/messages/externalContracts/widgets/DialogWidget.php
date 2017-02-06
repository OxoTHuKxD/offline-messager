<?php

namespace app\modules\messages\externalContracts\widgets;

use app\modules\messages\services\MainService;
use yii\bootstrap\Widget;

class DialogWidget extends Widget
{
    /** @var MainService */
    private $service;

    /** @var int */
    public $userId;

    public function __construct(MainService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($config);
    }

    public function run()
    {
        if (\Yii::$app->user->id && \Yii::$app->user->id !== $this->userId) {
            return $this->render('dialog', [
                'userId' => $this->userId,
                'dataProvider' => $this->service->getDialogProvider(\Yii::$app->user->id, $this->userId)
            ]);
        } else {
            return '';
        }
    }
}