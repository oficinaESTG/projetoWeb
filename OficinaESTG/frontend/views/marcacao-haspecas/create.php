<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoHaspecas */

$this->title = 'Create Marcacao Haspecas';
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Haspecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-haspecas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
