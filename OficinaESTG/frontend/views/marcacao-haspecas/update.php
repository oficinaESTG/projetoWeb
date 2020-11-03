<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoHaspecas */

$this->title = 'Update Marcacao Haspecas: ' . $model->idMarcacao_hasPecas;
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Haspecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMarcacao_hasPecas, 'url' => ['view', 'id' => $model->idMarcacao_hasPecas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcacao-haspecas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
