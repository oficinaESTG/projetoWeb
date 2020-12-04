<?php

use common\models\Peca;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoHaspecas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-haspecas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_idPeca')->dropDownList(ArrayHelper::map(Peca::find()->all(), 'idPeca', 'nomePeca'), ['prompt' => ''])->label('Peça') ?>


    <?= $form->field($model, 'fk_idMarcacao')->hiddenInput(['value'=>Yii::$app->getRequest()->getQueryParam('idMarcacao')])->label(false) ?>

    <?= $form->field($model, 'quantidadeParaMarcacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
