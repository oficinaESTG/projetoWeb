<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marcaCarro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modeloCarro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ano')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'matricula')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '**-**-**',
    ]) ?>

    <?= $form->field($model, 'quilometros')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'combustivel')->dropDownList([ 'Diesel' => 'Diesel', 'Gasolina' => 'Gasolina', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
