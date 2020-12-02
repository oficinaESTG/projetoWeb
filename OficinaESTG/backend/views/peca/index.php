<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pecas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peca-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Peca', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <input type="text" id="referencia" >


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPeca',
            'nomePeca',
            'quantidadePeca',
            'precoPeca',
            'referenciaPeca',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
