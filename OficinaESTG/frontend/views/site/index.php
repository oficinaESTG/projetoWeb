<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oficina ESTG';
?>

<div class="site-index">

    <?php  foreach($model as $carro){
            ?>
            <table class="table table-bordered">
                <tr>
                    <th rowspan="6" width="200">
                        <img src="<?= Yii::$app->request->baseUrl . '/images/car.jpg' ?>" class="img-responsive" >
                    </th>
                    <td><b>Dados</b></td>
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

                </tr>
                <tr>
                    <td>Preço: <?= $carro->precoCarro; ?> </td>

                        <?php
                        if (!Yii::$app->user->isGuest) { ?>
                    <td>
                        <?= Html::a('Ver mais', ['carro/view_guest', 'id' => $carro->idCarro], ['class' => 'btn btn-success']) ?>
                    </td>
                    <?php   } ?>

                </tr>

            </table>
        <?php }
    ?>

</div>
