<?php

namespace app\modules\user\forms;

use app\modules\user\Module;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    /** @var string */
    public $oldPassword;

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
            [['oldPassword', 'password', 'passwordRepeat'], 'filter', 'filter' => 'trim'],
            [['oldPassword', 'password', 'passwordRepeat'], 'required'],
            [['oldPassword', 'password'], 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => Module::t('module', 'OLD_PASSWORD'),
            'password' => Module::t('module', 'NEW_PASSWORD'),
            'passwordRepeat' => Module::t('module', 'NEW_PASSWORD_REPEAT')
        ];
    }

    public function clearForm()
    {
        $this->oldPassword = '';
        $this->password = '';
        $this->passwordRepeat = '';
    }
}