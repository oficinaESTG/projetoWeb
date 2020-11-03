<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoHaspecas */

$this->title = $model->idMarcacao_hasPecas;
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Haspecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="marcacao-haspecas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idMarcacao_hasPecas], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idMarcacao_hasPecas], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMarcacao_hasPecas',
            'fk_idPeca',
            'fk_idMarcacao',
            'quantidadeParaMarcacao',
        ],
    ]) ?>

</div>
