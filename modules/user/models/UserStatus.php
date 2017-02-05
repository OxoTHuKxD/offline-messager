<?php

namespace app\modules\user\models;

use app\modules\user\Module;
use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property integer $liked_user_id
 */
class UserStatus extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::getThisModule()->userStatusTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'liked_user_id'], 'required'],
            [['user_id', 'liked_user_id'], 'integer'],
            ['liked_user_id', 'validateAlreadyLike', 'skipOnError' => true],
            [['liked_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['liked_user_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function validateAlreadyLike($attribute)
    {
        if (self::find()->where(['user_id' => $this->user_id, 'liked_user_id' => $this->liked_user_id])->exists()) {
            $this->addError($attribute, 'Пользователь уже изменил статус пользователя!');
        }
    }

    /**
     * @inheritDoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            User::updateAllCounters(['status_count' => 1], ['id' => $this->liked_user_id]);
        }
    }

    /**
     * @inheritDoc
     */
    public function afterDelete()
    {
        parent::afterDelete();
        User::updateAllCounters(['status_count' => -1], ['id' => $this->liked_user_id]);
    }
}
