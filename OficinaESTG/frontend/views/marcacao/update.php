<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcacao */

$this->params['breadcrumbs'][] = ['label' => 'Marcacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMarcacoes, 'url' => ['view', 'id' => $model->idMarcacoes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcacao-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><b>Atualizar dados: </b></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
