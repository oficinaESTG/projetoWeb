<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="pessoa-index">

    <h3><b>Gestão de Utilizadores:</b></h3>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'Id',
                'attribute' => 'idPessoa',
            ],
            ['label' => 'Nome',
                'attribute' => 'nome',
            ],
            ['label' => 'Data de Nascimento',
                'attribute' => 'dataNascimento',
            ],
            ['label' => 'Morada',
                'attribute' => 'morada',
            ],
            ['label' => 'NIF',
                'attribute' => 'nif',
            ],
            ['label' => 'Tipo',
                'attribute' => 'tipoPessoa',

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
