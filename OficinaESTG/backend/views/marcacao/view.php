<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = 'Ver marcação';
?>
<div class="marcacao-view">

    <h3><b>Ver marcação :</b></h3>

    <?php
    $reparacao = DetailView::widget([
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

    $venda = DetailView::widget([
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
        ],
    ]);

    if ($model->tipoMarcacao == 'Venda'){
        echo $venda;
        echo Html::a('Atualizar', ['update_venda', 'id' => $model->idMarcacoes], ['class' => 'btn btn-primary']);
        echo Html::a('Eliminar', ['delete', 'id' => $model->idMarcacoes], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        if ($model->estadoMarcacao != 'Espera') {
            echo Html::a('Vender', ['venda/create', 'id' => $model->fk_idCarro], ['class' => 'btn btn-success']) ;
        }
    }

    if ($model->tipoMarcacao == 'Reparacao') {
        echo $reparacao;
        echo Html::a('Atualizar', ['update', 'id' => $model->idMarcacoes], ['class' => 'btn btn-primary']);
        echo Html::a('Eliminar', ['delete', 'id' => $model->idMarcacoes], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        if ($model->estadoMarcacao != 'Espera') {
            echo Html::a('Ver Peças na Marcação', ['marcacao-haspecas/index', 'idMarcacao' => $model->idMarcacoes], ['class' => 'btn btn-success']) ;
        }
    }

    ?>


</div>
