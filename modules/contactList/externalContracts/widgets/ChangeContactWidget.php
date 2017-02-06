<?php

namespace app\modules\contactList\externalContracts\widgets;

use app\modules\contactList\services\MainService;
use yii\bootstrap\Widget;

class ChangeContactWidget extends Widget
{
    /** @var MainService */
    private $service;

    public $userId;

    public function __construct(MainService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(\Yii::$app->user->id && \Yii::$app->user->id !== $this->userId) {
            return $this->render('changeContact', [
                'userId' => $this->userId,
                'hasContact' => $this->service->hasUserContact(\Yii::$app->user->id, $this->userId)
            ]);
        }else{
            return '';
        }
    }
}