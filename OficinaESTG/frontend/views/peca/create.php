<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Peca */

$this->title = 'Create Peca';
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
