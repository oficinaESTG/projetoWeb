<?php

use common\models\Carro;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoMarcacao')->dropDownList([ 'Reparacao' => 'Reparacao', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dataMarcacao')->widget(\yii\jui\DatePicker::classname(), [
        'options' => ['class' => 'form-control'],
        'language' => 'pt',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'descricaoMarcacao')->textInput(['maxlength' => true]) ?>

   <?=  $form->field($model, 'estadoMarcacao')->hiddenInput(['value'=> 'Espera'])->label(false)  ?>

    <?= $form->field($model, 'fk_idPessoa')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'fk_idCarro')->dropDownList(ArrayHelper::map(Carro::find()->all(), 'idCarro', 'modeloCarro'), ['prompt' => ''] )->label('Carro') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
