<?php

/* @var $this \yii\web\View */
?>
<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
            <tr>
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
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['qty'] * $item['price'] ?></td>
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
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>



