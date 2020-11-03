<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = 'Update Carro: ' . $model->idCarro;
$this->params['breadcrumbs'][] = ['label' => 'Carros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCarro, 'url' => ['view', 'id' => $model->idCarro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
