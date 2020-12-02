<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = 'Create Carro';
$this->title = 'Criar Carro';
?>
<div class="carro-create">

    <h3><b>Adicionar Carro:</b></h3>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
