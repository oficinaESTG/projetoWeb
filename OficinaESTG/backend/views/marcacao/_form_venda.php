<?php

use common\models\Carro;
use common\models\Pessoa;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'tipoMarcacao')->dropDownList([ 'Reparacao' => 'Venda', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'dataMarcacao')->widget(\yii\jui\DatePicker::classname(), [
            'options' => ['class' => 'form-control'],
            'language' => 'pt',
            'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

        <?= $form->field($model, 'descricaoMarcacao')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'estadoMarcacao')->dropDownList([ 'Aceite' => 'Aceite', 'Rejeitada' => 'Rejeitada', 'Concluida' => 'Concluida', 'Espera' => 'Espera', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'fk_idCarro')->dropDownList(ArrayHelper::map(Carro::find()->all(), 'idCarro', 'modeloCarro'), ['prompt' => ''])->label('Carro') ?>

        <?= $form->field($model, 'fk_idResponsavel')->dropDownList(ArrayHelper::map(Pessoa::find()->where(['tipoPessoa'=> 'Mecanico'])->all(), 'idPessoa', 'nome'), ['prompt' => ''])->label('Responsável') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
