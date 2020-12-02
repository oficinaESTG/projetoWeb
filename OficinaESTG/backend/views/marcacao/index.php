<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestão de Marcação';
?>
<div class="marcacao-index">

    <h3><b>Gestão de Marcação:</b></h3>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            ['label' => 'ID da Marcação',
                'attribute' => 'idMarcacoes',
            ],
            ['label' => 'Tipo de Marcação',
                'attribute' => 'tipoMarcacao',
            ],
            ['label' => 'Data Para a Marcação',
                'attribute' => 'dataMarcacao',
            ],
            ['label' => 'Estado da Marcação',
                'attribute' => 'estadoMarcacao',
            ],
            //'fk_idPessoa',
            ['label' => 'Nome da Pessoa',
                'attribute' => 'pessoa.nome',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
          'rowOptions' => function($model, $key, $index, $column){
            if($model->tipoMarcacao === 'Venda' && $model->estadoMarcacao === 'Espera'){
                return ['class' => 'alert'];
            }else if($model->tipoMarcacao === 'Reparacao' && $model->estadoMarcacao === 'Espera' ){
                return ['class' => 'danger'];
            }else if ($model->estadoMarcacao === 'Concluida'){

            }
          },
    ]); ?>


</div>
