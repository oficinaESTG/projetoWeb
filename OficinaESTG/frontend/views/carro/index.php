<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar Veículo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  foreach($model as $carro){
        ?>
        <table class="table table-bordered">
            <tr>
                <th rowspan="6" width="200"><b>(Imagem)</b></th>
                <td><b>Dados:</b></td>
            </tr>
            <tr>
                <td>Marcação: <?= $carro->marcaCarro; ?> </td>
            </tr>
            <tr>
                <td>Modelo: <?= $carro->modeloCarro; ?> </td>
            </tr>
            <tr>
                <td>Km(s):: <?= $carro->quilometros; ?> </td>
            </tr>
            <tr>
                <td>Combustível: <?= $carro->combustivel; ?> </td>
            </tr>
            <tr>
                <td><?= Html::a('Ver Mais', ['view', 'id' => $carro->idCarro], ['class' => 'btn btn-primary']) ?></td>
            </tr>
        </table>
    <?php }
    ?>


</div>
