<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Marcacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idMarcacoes',
            'tipoMarcacao',
            'dataMarcacao',
            'descricaoMarcacao',
            'estadoMarcacao',
            //'fk_idPessoa',
            //'fk_idCarro',
            //'fk_idResponsavel',
            //'valorFinal',
            //'descricaoFinal:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
