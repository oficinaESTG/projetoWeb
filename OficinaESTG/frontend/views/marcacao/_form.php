<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMarcacoes')->textInput() ?>

    <?= $form->field($model, 'tipoMarcacao')->dropDownList([ 'Reparacao' => 'Reparacao', 'Venda' => 'Venda', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dataMarcacao')->textInput() ?>

    <?= $form->field($model, 'descricaoMarcacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estadoMarcacao')->dropDownList([ 'Aceite' => 'Aceite', 'Rejeitada' => 'Rejeitada', 'Concluida' => 'Concluida', 'Espera' => 'Espera', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fk_idPessoa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
