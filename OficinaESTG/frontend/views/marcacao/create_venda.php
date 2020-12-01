<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = 'Create Marcacao';
$this->params['breadcrumbs'][] = ['label' => 'Marcacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-create">

    <h3><b>Marcar vistoria:</b></h3>

    <?= $this->render('_form_venda', [
        'model' => $model,
    ]) ?>

</div>
