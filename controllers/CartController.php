<?php
/**
 * Created by PhpStorm.
 * User: bohdan
 * Date: 07.04.2019
 * Time: 20:55
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use Yii;

class CartController extends AppController
{
    public function actionAdd(int $id, int $qty = 1)
    {
        $product = Product::findOne($id);
        if (empty($product)) return false;

        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart;
        $cart->addToCart($product, $qty);

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem($id)
    {
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с Вами');
                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom([Yii::$app->params['adminEmail'] => 'shop.ua'])
                    ->setTo('to@domain.com')
                    ->setSubject('Заказ')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems(array $items, int $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->price = $item['price'];
            $order_items->name = $item['name'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }
}