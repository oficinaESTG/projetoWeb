<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCarro')->textInput() ?>

    <?= $form->field($model, 'modeloCarro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marcaCarro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoCarro')->dropDownList([ 'Reparacao' => 'Reparacao', 'Venda' => 'Venda', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fk_idPessoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
