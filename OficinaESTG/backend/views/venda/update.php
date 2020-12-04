<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\venda */

$this->title = 'Update Venda: ' . $model->idVenda;
?>
<div class="venda-update">

    <h3><b>Atualizar dados : </b></h3>

    <table class="table table-bordered">
        <tr>
            <th rowspan="9" width="200"><b>(Imagem)</b></th>
            <td><b>Dados</b></td>
        </tr>
        <tr>
            <td>Marcação: <?= $modelCarro->marcaCarro; ?> </td>
        </tr>
        <tr>
            <td>Modelo: <?= $modelCarro->modeloCarro; ?> </td>
        </tr>
        <tr>
            <td>Ano: <?= $modelCarro->ano; ?> </td>
        </tr>
        <tr>
            <td>Km(s):: <?= $modelCarro->quilometros; ?> </td>
        </tr>
        <tr>
            <td>Combustível: <?= $modelCarro->combustivel; ?> </td>
        </tr>
        <tr>
            <td>Matrícula: <?= $modelCarro->matricula; ?> </td>
        </tr>
        <tr>
            <td>Status: <?= $modelCarro->tipoCarro; ?> </td>
        </tr>
    </table>

    <?= $this->render('_form', [
        'model' => $model,
        'modelCarro'=>$modelCarro,
    ]) ?>

</div>
