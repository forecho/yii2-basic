# Yii2 Basic Project Template

## 安装

```
cp .env.example .env
```

然后修改 .env 文件中的环境变量，并且创建数据库。再执行命令：

```
composer install
php yii migrate
chmod 777 -R runtime/
chmod 777 -R web/assets/
chmod 777 -R web/upload/
```

