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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idMarcacoes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idMarcacoes], [
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
            'idMarcacoes',
            'tipoMarcacao',
            'dataMarcacao',
            'descricaoMarcacao',
            'estadoMarcacao',
            'fk_idPessoa',

        ],
    ]) ?>

    <p>
    <?= Html::a('Ver Peças na Marcação', ['marcacao-haspecas/index', 'idMarcacao' => $model->idMarcacoes], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
