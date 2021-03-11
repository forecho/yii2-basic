<?php
/**
 * author     : forecho
 * createTime : 2020/7/5 10:01 上午
 * description:
 */

namespace app\core\types;

class Lang
{
    /**
     * 中文简体
     */
    const ZH_CN = 'zh-CN';

    /**
     * 台湾繁体
     */
    const ZH_TW = 'zh-TW';

    public static function getNames()
    {
        return [
            self::ZH_TW => '繁体',
            self::ZH_CN => '简体',
        ];
    }

    public static function getTarget()
    {
        if (\Yii::$app->language == self::ZH_TW) {
            return [self::ZH_CN => self::getNames()[self::ZH_CN]];
        }
        return [self::ZH_TW => self::getNames()[self::ZH_TW]];
    }
}