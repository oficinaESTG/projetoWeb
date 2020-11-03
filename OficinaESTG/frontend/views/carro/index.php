<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Carro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCarro',
            'modeloCarro',
            'marcaCarro',
            'ano',
            'matricula',
            //'tipoCarro',
            //'fk_idPessoa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
