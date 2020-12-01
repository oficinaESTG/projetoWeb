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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tipoMarcacao',
            'dataMarcacao',
            'descricaoMarcacao',
            'estadoMarcacao'
        ],
    ]) ?>

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
