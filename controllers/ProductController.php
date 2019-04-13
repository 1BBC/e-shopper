<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 07.04.2019
 * Time: 12:18
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty($product)) {
            throw new HttpException(404, 'Такой категории нет');
        }
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1);

        $count = 6;
        $hit = Product::find()->where(['hit' => 1])->limit($count)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hit', 'count'));
    }
}