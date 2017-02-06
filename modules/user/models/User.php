<?php

namespace app\modules\user\models;

use app\modules\user\models\query\UserQuery;
use app\modules\user\Module;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status_count
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User[] $usersWhoLikeMe
 * @property User[] $myLikedUsers
 */
class User extends ActiveRecord
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::getThisModule()->userTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash'], 'required'],
            [['status_count', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'USER_ID'),
            'username' => Module::t('module', 'USER_NAME'),
            'email' => Module::t('module', 'USER_EMAIL'),
            'status_count' => Module::t('module', 'USER_STATUS_COUNT'),
            'created_at' => Module::t('module', 'USER_CREATED_AT'),
            'updated_at' => Module::t('module', 'USER_UPDATED_AT'),
        ];
    }

    /**
     * Пользователи, которые лайкнули текущего пользователя
     * @return \yii\db\ActiveQuery
     */
    public function getUsersWhoLikeMe()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable(Module::getThisModule()->userStatusTableName, ['liked_user_id' => 'id']);
    }

    /**
     * Пользователи, которых лайкнул текущий пользователь
     * @return \yii\db\ActiveQuery
     */
    public function getMyLikedUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'liked_user_id'])
            ->viaTable(Module::getThisModule()->userStatusTableName, ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\user\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function hasLike($userId)
    {
        return UserStatus::find()->where(['user_id' => $userId, 'liked_user_id' => $this->id])->exists();
    }

    public function isOnline()
    {
        return \Yii::$app->cache->exists(['type' => Module::getThisModule()->onlineCacheKey, 'id' => $this->id]);
    }
}
