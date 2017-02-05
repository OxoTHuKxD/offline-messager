<?php

namespace app\modules\user\forms;

use app\modules\user\Module;
use app\modules\user\models\User;
use yii\base\Model;

class RegisterForm extends Model
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordRepeat;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'passwordRepeat'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'password', 'passwordRepeat'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Module::t('module', 'ERROR_EMAIL_EXISTS')],
            ['password', 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Module::t('module', 'REGISTER_NAME'),
            'email' => Module::t('module', 'REGISTER_EMAIL'),
            'password' => Module::t('module', 'REGISTER_PASSWORD'),
            'passwordRepeat' => Module::t('module', 'REGISTER_PASSWORD_REPEAT')
        ];
    }
}