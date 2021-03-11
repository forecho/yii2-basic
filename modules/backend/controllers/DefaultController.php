<?php

namespace app\modules\backend\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yiier\helpers\DateHelper;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // 自定义一个规则，返回true表示满足该规则，可以访问，false表示不满足规则，也就不可以访问actions里面的操作啦
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'matchCallback' => function ($rule, $action) {
                            return User::currUserIsSuperAdmin();
                        },
                    ],
                ]
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $start = DateHelper::beginTimestamp();
        $end = DateHelper::endTimestamp();
        $todayUserTotal = User::find()->where(['between', 'created_at', $start, $end])->count();
        return $this->render('index', [
            'todayUserTotal' => $todayUserTotal,
        ]);
    }
}
