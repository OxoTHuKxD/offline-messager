<?php

namespace app\modules\user\adapters;

use app\modules\user\models\User;
use yii\web\IdentityInterface;

class IdentityInterfaceAdapter implements IdentityInterface
{
    /** @var User */
    private $user;

    /**
     * IdentityInterfaceAdapter constructor.
     * @param int $id
     */
    public function __construct($id)
    {
        $this->user = User::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        $self = new self($id);
        return $self->user ? $self : null;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->user->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
    }

}