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
        <?= Html::a('Criar Marcação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label' => 'Tipo',
                'attribute' => 'tipoMarcacao',
            ],
            ['label' => 'Data',
                'attribute' => 'dataMarcacao',
            ],
            ['label' => 'Descrição',
                'attribute' => 'descricaoMarcacao',
            ],
            ['label' => 'Estado',
                'attribute' => 'estadoMarcacao',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'rowOptions' => function($model, $key, $index, $column){
            if($model->estadoMarcacao === 'Espera'){
                return ['class' => 'info'];
            }
            if($model->estadoMarcacao === 'Aceite'){
                return ['class' => 'success'];
            }
            if($model->estadoMarcacao === 'Rejeitada'){
                return ['class' => 'danger'];
            }
            if($model->estadoMarcacao === 'Concluida'){
                return ['class' => 'warning'];
            }
        },
    ]); ?>


</div>
