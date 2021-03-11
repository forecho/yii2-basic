<?php
/**
 * author     : forecho
 * createTime : 2020/4/21 11:57 上午
 * description:
 */

foreach (json_decode(file_get_contents(__DIR__ . '/../composer.lock'))->packages as $package) {
    if (!preg_match('#^(bower|npm)-asset/(.+)$#', $package->name, $name) or !preg_match('#^v?(.+)$#', $package->version,
            $version)) {
        continue;
    }
    $name = $name[2];
    $version = $version[1];
    switch ($name) {
        case 'jquery':
            $bundles['yii\web\JqueryAsset'] = [
                'sourcePath' => null,
                'baseUrl' => '//cdn.bootcss.com/jquery/' . $version,
                'css' => [],
                'js' => ['jquery.min.js'],
            ];
            break;
        case 'bootstrap':
            $bundles['yii\bootstrap4\BootstrapAsset'] = [
                'sourcePath' => null,
                'baseUrl' => '//cdn.bootcss.com/twitter-bootstrap/' . $version,
                'css' => ['css/bootstrap.min.css'],
                'js' => [],
            ];
            $bundles['yii\bootstrap4\BootstrapPluginAsset'] = [
                'sourcePath' => null,
                'baseUrl' => '//cdn.bootcss.com/twitter-bootstrap/' . $version,
                'css' => [],
                'js' => ['js/bootstrap.min.js'],
            ];
            break;
//        case 'font-awesome':
//            $bundles['common\assets\FontAwesomeAsset'] = [
//                'sourcePath' => null,
//                'css' => ['//cdnjs.cloudflare.com/ajax/libs/font-awesome/' . $version . '/css/font-awesome.min.css'],
//                'js' => [],
//            ];
//            break;
    }
}
return $bundles;
