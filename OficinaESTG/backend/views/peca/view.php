<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Peca */

$this->title = $model->idPeca;
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="peca-view">

    <h3><b>Gestão de peças:</b></h3>
    <br>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idPeca], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPeca], [
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
            'idPeca',
            'nomePeca',
            'quantidadePeca',
            'precoPeca',
            'referenciaPeca',
        ],
    ]) ?>

</div>
