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
            <th rowspan="9" width="200">
                <img src="<?= Yii::$app->request->baseUrl . '/images/car.jpg' ?>" class="img-responsive" >
            </th>
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
            <td><?= Html::a('Marcar vistoria', ['marcacao/create_venda', 'id' => $model->idCarro], ['class' => 'btn btn-primary']) ?></td>
        </tr>

    </table>

</div>
