<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = $model->idCarro;
$this->params['breadcrumbs'][] = ['label' => 'Carros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->idCarro], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idCarro], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Pretende eliminar o registo do veículo? Não será possível reverter a ação',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idCarro',
            'modeloCarro',
            'marcaCarro',
            'ano',
            'matricula',
            'tipoCarro',
            'quilometros',
            'combustivel',
            //'fk_idPessoa',
        ],
    ]) ?>

</div>
