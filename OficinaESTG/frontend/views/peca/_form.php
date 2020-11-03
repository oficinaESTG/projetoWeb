<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Peca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPeca')->textInput() ?>

    <?= $form->field($model, 'nomePeca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidadePeca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precoPeca')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
