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

    <?php $form = ActiveForm::begin(['id'=>'form-marcacao']); ?>

    <?= $form->field($model, 'dataMarcacao')->widget(\yii\jui\DatePicker::classname(), [
        'options' => ['class' => 'form-control'],
        'language' => 'pt',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('Data') ?>

    <?= $form->field($model, 'descricaoMarcacao')->textInput(['maxlength' => true])->label('Descrição') ?>

    <?= $form->field($model, 'fk_idCarro')->dropDownList(ArrayHelper::map(Carro::find()->where(['fk_idPessoa'=>Yii::$app->user->identity->id])->all(), 'idCarro', 'modeloCarro'), ['prompt' => '', 'id'=>'fkcarro'])->label('Carro') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
