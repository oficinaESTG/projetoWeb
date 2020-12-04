<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcacao Haspecas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-haspecas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Associar Peça na marcação', ['create', 'idMarcacao' => Yii::$app->getRequest()->getQueryParam('idMarcacao')], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idMarcacao_hasPecas',
            //'fk_idPeca',
            //'fk_idMarcacao',
            //'quantidadeParaMarcacao',
            //'peca.nomePeca',

            [   'label' => 'Quantidade usada para a Marcação',
                'attribute' => 'quantidadeParaMarcacao',
            ],
            [   'label' => 'Nome da Peça',
                'attribute' => 'peca.nomePeca',
            ],
            [   'label' => 'Referência da Peça',
                'attribute' => 'peca.referenciaPeca',
            ],
            [   'label' => 'Preço Por Peça (€)',
                'attribute' => 'peca.precoPeca',
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
