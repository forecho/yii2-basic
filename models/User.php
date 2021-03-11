<?php

namespace app\models;


use app\core\types\CommonStatus;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string|null $avatar
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int|null $role 用户角色：1普通用户 2管理员 3超级管理员
 * @property int|null $status 状态：1正常 0冻结
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_SUPER_ADMIN = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => CommonStatus::STATUS_ACTIVE],
            ['status', 'in', 'range' => [CommonStatus::STATUS_ACTIVE, CommonStatus::STATUS_UNACTIVATED]],
            ['role', 'default', 'value' => 10],
            [['username'], 'string', 'max' => 50],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_SUPER_ADMIN, self::FAKE_USER]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->where(['id' => $id, 'status' => CommonStatus::STATUS_ACTIVE])
            ->limit(1)
            ->one();
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|\yii\web\IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return array|ActiveRecord|User
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::find()->where([
            'password_reset_token' => $token,
            'status' => [CommonStatus::STATUS_UNACTIVATED, CommonStatus::STATUS_ACTIVE],
        ])->limit(1)->one();
    }

    /**
     * @param $username
     * @param array $condition
     * @return User|ActiveRecord
     */
    public static function findByUsername($username, $condition = [])
    {
        return static::find()->where(['username' => $username, 'status' => CommonStatus::STATUS_ACTIVE])
            ->andWhere($condition)
            ->limit(1)
            ->one();
    }


    /**
     * @param $email
     * @return array|ActiveRecord|null
     */
    public static function findByEmail($email)
    {
        return static::find()->where(['email' => $email, 'status' => CommonStatus::STATUS_ACTIVE])
            ->limit(1)
            ->one();
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'username' => '用户名',
            'email' => '邮件地址',
            'created_at' => '创建时间',
            'status' => '状态',
            'role' => '角色',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        parent::afterFind();
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }


    /**
     * @return User|array|null|\yii\db\ActiveRecord
     */
    public static function getFirstUser()
    {
        return User::find()->orderBy(['id' => SORT_ASC])->limit(1)->one();
    }

    /**
     * @param $username
     * @return bool
     */
    public static function isSuperAdmin($username): bool
    {
        if (static::findOne(['username' => $username, 'role' => self::ROLE_SUPER_ADMIN])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function currUserIsSuperAdmin(): bool
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        /** @var User $user */
        $user = Yii::$app->user->identity;
        return $user && $user->role == self::ROLE_SUPER_ADMIN;
    }


    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            '' => '全部',
            CommonStatus::STATUS_ACTIVE => '正常',
            CommonStatus::STATUS_UNACTIVATED => '停用',
        ];
    }

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_USER => '普通用户',
            self::ROLE_ADMIN => '管理员',
            self::ROLE_SUPER_ADMIN => '超级管理员',
        ];
    }
}
