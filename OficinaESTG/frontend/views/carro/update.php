<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title =  $model->marcaCarro . " ". $model->modeloCarro;
$this->params['breadcrumbs'][] = ['label' => 'Carros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCarro, 'url' => ['view', 'id' => $model->idCarro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carro-update">

    <h3><b>Atualizar dados </b> (<?= Html::encode($this->title) ?>) <b> : </b></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
