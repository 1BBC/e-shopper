<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 02.04.2019
 * Time: 15:27
 */

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

class ItAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
    'js/html5shiv.js',
    'js/respond.min.js',
    ];

    public $jsOptions = [
      'condition' => 'lte IE9',
      'position' => View::POS_HEAD,
    ];
}