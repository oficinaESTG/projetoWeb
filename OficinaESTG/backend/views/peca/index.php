<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestão de peças';
?>
<div class="peca-index">

    <h3><b>Gestão de peças:</b></h3>
    <br>

    <p>
        <?= Html::a('Adicionar Peça', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomePeca',
            'quantidadePeca',
            'precoPeca',
            'referenciaPeca',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
