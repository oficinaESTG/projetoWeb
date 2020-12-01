<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $modelPessoa common\models\Pessoa */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($modelPessoa, 'nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($modelPessoa, 'dataNascimento')->widget(\yii\jui\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'language' => 'pt',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($modelPessoa, 'morada')->textInput(['maxlength' => true]) ?>

            <?= $form->field($modelPessoa, 'nif')->textInput() ?>

            <?= $form->field($modelPessoa, 'tipoPessoa')->dropDownList([ 'Mecanico' => 'Mecanico', 'Secretaria' => 'Secretaria', 'Cliente' => 'Cliente', 'Gestor' => 'Gestor', ], ['prompt' => '']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

