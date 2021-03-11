<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2019/5/11 7:17 PM
 * description:
 */

namespace app\core\types;

use yii\helpers\ArrayHelper;

class CommonStatus
{
    /**
     * @var integer 激活
     */
    const STATUS_ACTIVE = 1;

    /**
     * @var integer 未激活状态
     */
    const STATUS_UNACTIVATED = 0;


    /**
     * 通用状态名称列表
     * @return array
     */
    public static function getNames(): array
    {
        return [
            self::STATUS_ACTIVE => '显示',
            self::STATUS_UNACTIVATED => '不显示',
        ];
    }

    /**
     * 通用状态名称
     * @param int $status
     * @return string
     */
    public static function getName(int $status): string
    {
        return ArrayHelper::getValue(self::getNames(), $status, '');
    }
}