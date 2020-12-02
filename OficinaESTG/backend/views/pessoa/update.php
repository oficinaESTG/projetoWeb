<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pessoa */
?>
<div class="pessoa-update">

    <h3><b>Atualizar pessoa:</b></h3>
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
