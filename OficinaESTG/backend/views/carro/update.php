<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = 'Update Carro: ' . $model->idCarro;
?>
<div class="carro-update">

    <h3><b>Atualizar dados </b> (<?= Html::encode($this->title) ?>) <b> : </b></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
