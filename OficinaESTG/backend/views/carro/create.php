<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carro */

$this->title = 'Create Carro';
$this->params['breadcrumbs'][] = ['label' => 'Carros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
