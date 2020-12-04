<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = $model->idMarcacoes;
$this->params['breadcrumbs'][] = ['label' => 'Marcacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="marcacao-view">

    <?php

    $estado_0 = DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipoMarcacao',
            'dataMarcacao',
            'descricaoMarcacao',
            'estadoMarcacao'
        ],
    ]);

    $estado_1 = DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Tipo',
                'attribute' => 'tipoMarcacao',
            ],
            ['label' => 'Data',
                'attribute' => 'dataMarcacao',
            ],
            ['label' => 'Descrição problema',
                'attribute' => 'descricaoMarcacao',
            ],
            ['label' => 'Estado',
                'attribute' => 'estadoMarcacao',
            ],
            ['label' => 'Nome da Pessoa',
                'attribute' => 'pessoa.nome',
            ],
            ['label' => 'Preço',
                'attribute' => 'valorFinal',
            ],
            ['label' => 'Descrição trabalho',
                'attribute' => 'descricaoFinal',
            ],
            ['label' => 'Horas Trabalhadas (15€/h)',
                'attribute' => 'horasTrabalho',
            ],

        ],
    ]);

    if ($model->estadoMarcacao == 'Concluida'){
        echo  $estado_1;
    }else{
        echo  $estado_0;
    }



    ?>


    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idMarcacoes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idMarcacoes], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Pretende eliminar a marcação? Não será possível reverter a ação',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
