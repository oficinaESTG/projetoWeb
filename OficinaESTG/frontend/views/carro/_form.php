<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marcaCarro')->textInput(['maxlength' => true])->label('Marca') ?>

    <?= $form->field($model, 'modeloCarro')->textInput(['maxlength' => true])->label('Modelo') ?>

    <?= $form->field($model, 'ano')->textInput(['maxlength' => 4])->label('Ano') ?>

    <?= $form->field($model, 'matricula')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '**-**-**',
    ])->label('Matrícula') ?>

    <?= $form->field($model, 'quilometros')->textInput(['maxlength' => true])->label('Quilómetros') ?>

    <?= $form->field($model, 'combustivel')->dropDownList([ 'Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', ], ['prompt' => '', 'id'=>'combustivel']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
