<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = 'Update Marcacao: ' . $model->idMarcacoes;
$this->params['breadcrumbs'][] = ['label' => 'Marcacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMarcacoes, 'url' => ['view', 'id' => $model->idMarcacoes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
