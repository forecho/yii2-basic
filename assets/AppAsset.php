<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '//at.alicdn.com/t/font_1765022_k5w1hgu6n0b.css',
    ];
    public $js = [
        'javascript/lazysizes.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        BootstrapAsset::class
    ];
}
