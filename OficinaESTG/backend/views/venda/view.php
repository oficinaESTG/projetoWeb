<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\venda */

$this->title = 'Ver Venda';

?>
<div class="venda-view">

    <h3><b>Ver Venda : </b></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idVenda], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idVenda], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idVenda',
            'quantiaVenda',
            'dataVenda',
            'descricaoVenda',
            'fk_idCarro',
        ],
    ]) ?>

</div>
