<?php

namespace app\modules\user\forms;

use app\modules\user\Module;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            [['email', 'password'], 'required'],
            ['rememberMe', 'safe'],
            ['rememberMe', 'boolean'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6]
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Module::t('module', 'LOGIN_EMAIL'),
            'password' => Module::t('module', 'LOGIN_PASSWORD'),
            'rememberMe' => Module::t('module', 'LOGIN_REMEMBER_ME')
        ];
    }
}