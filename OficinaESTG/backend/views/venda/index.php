<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestão de Vendas';
?>
<div class="venda-index">

    <h3><b>Gestão de Vendas:</b></h3>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'Data',
                'attribute' => 'dataVenda',
            ],
            ['label' => 'Descrição',
                'attribute' => 'descricaoVenda',
            ],
            ['label' => 'Marca',
                'attribute' => 'carro.marcaCarro',
            ],
            ['label' => 'Modelo',
                'attribute' => 'carro.modeloCarro',
            ],
            ['label' => 'Matrícula',
                'attribute' => 'carro.matricula',
            ],
            ['label' => 'Preço Vendido',
                'attribute' => 'carro.precoCarro',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
