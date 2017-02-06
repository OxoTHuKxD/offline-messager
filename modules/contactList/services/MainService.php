<?php

namespace app\modules\contactList\services;

use app\modules\contactList\externalContracts\get\UserFinderInterface;
use app\modules\contactList\models\UserContactList;
use yii\base\Component;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;

class MainService extends Component
{
    /** @var UserFinderInterface */
    private $userFinder;

    /**
     * MainService constructor.
     * @param UserFinderInterface $userFinder
     * @param array $config
     */
    public function __construct(UserFinderInterface $userFinder, array $config = [])
    {
        $this->userFinder = $userFinder;
        parent::__construct($config);
    }

    /**
     * @param int $userId
     * @return ActiveDataProvider
     */
    public function getUserContactsProvider($userId)
    {
        return new ActiveDataProvider([
            'query' => UserContactList::find()->where(['user_id' => $userId]),
        ]);
    }

    /**
     * @param int $userId
     * @param int $contactUserId
     * @throws ErrorException
     */
    public function addUserContact($userId, $contactUserId)
    {
        if (UserContactList::find()->where(['user_id' => $userId, 'contact_user_id' => $contactUserId])->exists())
            throw new ErrorException("sdfsfdsdf");

        if (!($this->userFinder->hasUserById($userId) && $this->userFinder->hasUserById($contactUserId))) {
            throw new ErrorException("sdfsfdsdf");
        }

        $userContact = \Yii::createObject('app\modules\contactList\models\UserContactList');
        $userContact->user_id = $userId;
        $userContact->contact_user_id = $contactUserId;
        $userContact->save();
    }

    /**
     * @param int $userId
     * @param int $contactUserId
     */
    public function removeUserContact($userId, $contactUserId)
    {
        UserContactList::deleteAll(['user_id' => $userId, 'contact_user_id' => $contactUserId]);
    }
}