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


    <table class="table table-bordered">
        <tr>
            <th rowspan="9" width="200"><b>(Imagem)</b></th>
            <td><b>Dados</b></td>
        </tr>
        <tr>
            <td>Marca: <?= $model->marcaCarro; ?> </td>
        </tr>
        <tr>
            <td>Modelo: <?= $model->modeloCarro; ?> </td>
        </tr>
        <tr>
            <td>Ano: <?= $model->ano; ?> </td>
        </tr>
        <tr>
            <td>Km(s): <?= $model->quilometros; ?> </td>
        </tr>
        <tr>
            <td>Combustível: <?= $model->combustivel; ?> </td>
        </tr>
        <tr>
            <td>Matrícula: <?= $model->matricula; ?> </td>
        </tr>
        <tr>
            <td>Status: <?= $model->tipoCarro; ?> </td>
        </tr>
        <tr>
            <td>
                <?= Html::a('Alterar', ['update', 'id' => $model->idCarro], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->idCarro], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Pretende eliminar o registo do veículo? Não será possível reverter a ação',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
    </table>

</div>
