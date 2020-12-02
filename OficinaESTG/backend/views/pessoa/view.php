<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pessoa */
/* @var $carro common\models\Carro */


?>
<div class="pessoa-view">

    <h3><b>Ver pessoa:</b></h3>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'email:email',
            'morada',
            'dataNascimento',
            'nif',
            'tipoPessoa',
        ],
    ]) ?>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idPessoa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPessoa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    if ($carro != null) {
    ?>
        <h3><b>Carros Associados:</b></h3>
        <br>

        <?php  foreach($carro as $car){
            ?>
            <?= Html::a('Ver Carro ('. $car->marcaCarro . ' ' . $car->modeloCarro . ')', ['..\carro\view', 'id' => $car->idCarro], ['class' => 'btn btn-success', 'style'=>'width:500px;']) ?>
            <br>
            <br>
        <?php } }
        ?>

</div>