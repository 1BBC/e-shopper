<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success" role="alert">
        <?= Yii::$app->session->getFlash('success'); ?>
    </div>
    <?php else:?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif;?>
    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= \yii\helpers\Html::img($item['img'], ['height' => 50]) ?></td>
                        <td><?= BaseHtml::a($item['name'], Url::to(['product/view', 'id' => $id])) ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="4">Итого</td>
                    <td colspan="4"><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму</td>
                    <td colspan="4"><?= $session['cart.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
    <?php $form = ActiveForm::begin()?>
        <?= $form->field($order, 'name')?>
        <?= $form->field($order, 'email')?>
        <?= $form->field($order, 'phone')?>
        <?= $form->field($order, 'address')?>
    <div class="form-group">
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success'])?>
    </div>
    <?php $form = ActiveForm::end()?>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>




</div>
