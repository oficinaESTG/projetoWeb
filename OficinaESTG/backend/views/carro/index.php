<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carro-index">

    <h1>Carros Para Venda:</h1>

    <p>
        <?= Html::a('Adicionar Um Carro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idCarro',

            'marcaCarro',
            'modeloCarro',
            'ano',
            'matricula',
            'tipoCarro',
            'quilometros',
            'combustivel',
            //'fk_idPessoa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
