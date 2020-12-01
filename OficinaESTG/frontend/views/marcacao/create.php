<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->title = 'Create Marcacao';
$this->params['breadcrumbs'][] = ['label' => 'Marcacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-create">

    <h3><b>Marcar reparação:</b></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
