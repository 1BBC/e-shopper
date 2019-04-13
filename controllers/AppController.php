<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 06.04.2019
 * Time: 16:36
 */

namespace app\controllers;

use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
       $this->view->title = $title;
       $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
       $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }
}