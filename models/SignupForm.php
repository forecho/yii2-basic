<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2020/2/4 4:16 下午
 * description:
 */

namespace app\models;


use app\core\types\CommonStatus;
use yii\base\Model;
use yiier\helpers\Security;

/**
 * Signup form
 *
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $inviteCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'filter', 'filter' => 'trim'],
            [['username', 'email'], 'required'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message' => '{attribute}只能为数字和字母'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => '此{attribute}已经被使用'],
            ['username', 'string', 'min' => 4, 'max' => 12],
            [['username', 'email'], 'string', 'min' => 2, 'max' => 80],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '此{attribute}已经被使用'],

            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
//            ['inviteCode', 'required'],
//            ['inviteCode', 'yiier\inviteCode\CodeValidator'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'inviteCode' => '邀请码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = ($this->username) ? $this->username : Security::random();
        $user->email = $this->email;
        $user->status = CommonStatus::STATUS_ACTIVE; // 激活
        $user->role = User::ROLE_USER;
        $user->avatar = "";
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            return $user;
        }
        return null;
    }
}