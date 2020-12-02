<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pessoa */

?>
<div class="pessoa-view">

    <h3><b>Visualizar perfil:</b></h3>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Nome',
                'attribute' => 'nome',
            ],
            ['label' => 'Email',
                'attribute' => 'email',
            ],
            ['label' => 'Data Nascimento',
                'attribute' => 'dataNascimento',
            ],
            ['label' => 'Morada',
                'attribute' => 'morada',
            ],
            ['label' => 'NIF',
                'attribute' => 'nif',
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idPessoa], ['class' => 'btn btn-primary']) ?>

    </p>

</div>
