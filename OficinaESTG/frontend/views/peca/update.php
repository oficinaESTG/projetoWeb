<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Peca */

$this->title = 'Update Peca: ' . $model->idPeca;
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPeca, 'url' => ['view', 'id' => $model->idPeca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
