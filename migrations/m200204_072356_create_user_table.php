<?php

use yiier\helpers\Migration;


/**
 * Handles the creation of table `{{%user}}`.
 */
class m200204_072356_create_user_table extends Migration
{
    /**
     * @var string 用户表
     */
    public $tableName = '{{%user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(80)->notNull()->unique(),
            'avatar' => $this->string(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(80)->unique(),
            'role' => $this->smallInteger()->defaultValue(1)->comment('用户角色：1普通用户 2管理员 3超级管理员'),
            'status' => $this->smallInteger()->defaultValue(1)->comment('状态：1正常 0冻结'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
