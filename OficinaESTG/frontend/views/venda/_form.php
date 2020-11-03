<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Venda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idVenda')->textInput() ?>

    <?= $form->field($model, 'quantiaVenda')->textInput() ?>

    <?= $form->field($model, 'dataVenda')->textInput() ?>

    <?= $form->field($model, 'descricaoVenda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_idCarro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
