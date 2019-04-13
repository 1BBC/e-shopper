<?php

use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $dataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return $data->status
                        ? '<span class="text-success">Завершен</span>'
                        : '<span class="text-danger">Активен</span>';
                },
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
<!--    --><?// var_dump($model->orderItems)?>
<!--    <div class="table-responsive">-->
<!--        <table class="table table-hover table-stripped">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Наименование</th>-->
<!--                <th>Кол-во</th>-->
<!--                <th>Цена</th>-->
<!--                <th>Сумма</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            --><?php //foreach ($model->orderItems as $item): ?>
<!--                <tr>-->
<!--                    <td>--><?//= BaseHtml::a($item['name'], Url::to(['/product/view', 'id' => $item['id']])) ?><!--</td>-->
<!--                    <td>--><?//= $item['qty_item'] ?><!--</td>-->
<!--                    <td>--><?//= $item['price'] ?><!--</td>-->
<!--                    <td>--><?//= $item['sum_item'] ?><!--</td>-->
<!--                </tr>-->
<!--            --><?php //endforeach; ?>
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->
    <h1>Товары</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            [
                'attribute' => 'name',
                'value' => function($data) {
                    return Html::a($data->name, ['/product/view', 'id' => $data->id]);
                },
                'format' => 'html',
            ],
            'qty_item',
            'price',
            'sum_item',
        ],
    ]); ?>

</div>
