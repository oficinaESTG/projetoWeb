<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoHaspecas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-haspecas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_idPeca')->textInput() ?>

    <?= $form->field($model, 'fk_idMarcacao')->textInput() ?>

    <?= $form->field($model, 'quantidadeParaMarcacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
