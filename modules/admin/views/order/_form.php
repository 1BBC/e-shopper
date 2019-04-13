<?php

use janisto\timepicker\TimePicker as TimePickerAlias;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->widget(TimePickerAlias::class, [
        //'language' => 'fi',
        'mode' => 'datetime',
        'clientOptions'=>[
            'dateFormat' => 'yy-mm-dd',
            'timeFormat' => 'HH:mm:ss',
        ]
    ]); ?>

    <?= $form->field($model, 'updated_at')->widget(TimePickerAlias::class, [
        //'language' => 'fi',
        'mode' => 'datetime',
        'clientOptions'=>[
            'dateFormat' => 'yy-mm-dd',
            'timeFormat' => 'HH:mm:ss',
        ]
    ]); ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Активен', '1' => 'Завершен',]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->input('email'); ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38 (999) 999-9999',]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
