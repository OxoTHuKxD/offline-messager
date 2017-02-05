<?php

namespace app\modules\user\services;

use app\modules\user\Module;
use yii\base\Component;

class UserOnlineService extends Component
{
    /**
     * @param int $id
     */
    public function setWebUserOnline($id)
    {
        \Yii::$app->cache->set(['type' => Module::getThisModule()->onlineCacheKey, 'id' => $id], true, Module::getThisModule()->freeOnlineTime);
    }

    /**
     * @param int $id
     */
    public function setWebUserOffline($id)
    {
        \Yii::$app->cache->delete(['type' => Module::getThisModule()->onlineCacheKey, 'id' => $id]);
    }
}