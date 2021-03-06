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
            throw new ErrorException();

        if (!($this->userFinder->hasUserById($userId) && $this->userFinder->hasUserById($contactUserId))) {
            throw new ErrorException();
        }

        $userContact = \Yii::createObject('app\modules\contactList\models\UserContactList');
        $userContact->user_id = $userId;
        $userContact->contact_user_id = $contactUserId;
        $userContact->save();
    }

    /**
     * @param int $userId
     * @param int $contactUserId
     * @return bool
     */
    public function hasUserContact($userId, $contactUserId)
    {
        return UserContactList::find()->where(['user_id' => $userId, 'contact_user_id' => $contactUserId])->exists();
    }

    /**
     * @param int $userId
     * @param int $contactUserId
     */
    public function removeUserContact($userId, $contactUserId)
    {
        UserContactList::deleteAll(['user_id' => $userId, 'contact_user_id' => $contactUserId]);
    }

    public function getUserContactsIdList($userId)
    {
        return array_map(
            function($el) {
                return intval($el['contact_user_id']);
            }, UserContactList::find()->where(['user_id' => $userId])->asArray()->select('contact_user_id')->all()
        );
    }
}