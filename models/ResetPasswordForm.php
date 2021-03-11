<?php

namespace app\models;

use app\core\types\CommonStatus;
use InvalidArgumentException;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $username;

    /**
     * @var User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Token 验证失败，请重新操作。');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('链接无效或者已失效，请重新操作。');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['username', 'required', 'on' => 'confirmEmail'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message' => '{attribute}只能为数字和字母'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => '此{attribute}已经被使用'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '新密码',
        ];
    }


    /**
     * @param User $user
     * @return bool
     * @throws \yii\base\Exception
     */
    public static function setPasswordResetToken(User $user)
    {
        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }

        if (!$user->save()) {
            return false;
        }
    }


    /**
     * @return User
     * @throws \yii\base\Exception
     */
    public function resetPassword()
    {
        $user = $this->_user;
        if ($this->username) {
            $user->username = $this->username;
            $user->status = CommonStatus::STATUS_ACTIVE;
        }
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->save();
        return $user;
    }
}
