<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pessoa */


?>
<div class="pessoa-view">

    <h3><b>Ver pessoa:</b></h3>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'email:email',
            'morada',
            'dataNascimento',
            'nif',
            'tipoPessoa',
        ],
    ]) ?>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idPessoa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPessoa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
