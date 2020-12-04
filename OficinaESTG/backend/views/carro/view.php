<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = 'Ver Carro';
?>

<div class="carro-view">


    <table class="table table-bordered">
        <tr>
            <th rowspan="9" width="200"><b>(Imagem)</b></th>
            <td><b>Dados</b></td>
        </tr>
        <tr>
            <td>Marcação: <?= $model->marcaCarro; ?> </td>
        </tr>
        <tr>
            <td>Modelo: <?= $model->modeloCarro; ?> </td>
        </tr>
        <tr>
            <td>Ano: <?= $model->ano; ?> </td>
        </tr>
        <tr>
            <td>Km(s):: <?= $model->quilometros; ?> </td>
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
                <?php
                if($model->vendido ==false)
                {
                    echo Html::a('Vender', ['../venda/create', 'id' => $model->idCarro], ['class' => 'btn btn-primary']);
                }
                ?>
                <?= Html::a('Alterar Carro', ['update', 'id' => $model->idCarro], ['class' => 'btn btn-success']) ?>
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
