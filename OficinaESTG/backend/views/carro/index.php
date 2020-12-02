<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestão de Carros';
?>
<div class="carro-index">

    <h3><b>Gestão de Carros para Venda:</b></h3>
    <br>

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
