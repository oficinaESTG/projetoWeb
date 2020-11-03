<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Venda */

$this->title = 'Update Venda: ' . $model->idVenda;
$this->params['breadcrumbs'][] = ['label' => 'Vendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idVenda, 'url' => ['view', 'id' => $model->idVenda]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
