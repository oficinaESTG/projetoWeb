<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = 'Atualizar Marcação';

?>
<div class="marcacao-update">

    <h3><b>Atualizar marcação:</b></h3>

    <?= $this->render('_form_venda', [
        'model' => $model,
    ]) ?>

</div>
