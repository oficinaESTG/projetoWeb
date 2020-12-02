<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pessoa */

$this->title = 'Update Pessoa: ' . $model->idPessoa;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPessoa, 'url' => ['view', 'id' => $model->idPessoa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoa-update">

    <h3><b>Atualizar perfil:</b></h3>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
