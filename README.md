## 安装

```
cp .env.example .env
```

然后修改 .env 文件中的环境变量，并且创建数据库。再执行命令：

```
composer install
php yii migrate
php yii migrate --migrationPath=@yiier/actionStore/migrations/
php yii migrate --migrationPath=@yiier/targetSetting/migrations/
chmod 777 -R runtime/
chmod 777 -R web/assets/
chmod 777 -R web/upload/
```

