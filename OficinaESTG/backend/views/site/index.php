<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
$this->title = 'OficinaESTG';

$pessoa_count=\common\models\Pessoa::find()->count();
$carro_count=\common\models\Carro::find()->where(['tipocarro'=> 'Venda'])->count();
$marcacao_count=\common\models\Marcacao::find()->count();
$carro_venda=\common\models\Carro::find()->where(['tipocarro'=> 'Venda'])->all();
?>
<div class="site-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" style="background-color: yellowgreen;border-radius: 20px;color: white;margin-left: 2px;margin-right: 2px;width: 250px;">
                <h1>
                    <b>
                        <?php
                        echo $pessoa_count;
                        ?>
                    </b>
                </h1>
                <br>
                <h3><b>Pessoas Registadas</b></h3>
            </div>
            <div class="col-sm-4" style="background-color: yellowgreen;border-radius: 20px;color: white;margin-left: 2px;margin-right: 2px;width: 250px;">
                <h1>
                    <b>
                        <?php
                        echo $carro_count;
                        ?>
                    </b>
                </h1>
                <br>
                <h3><b>Carros (Venda) Registados</b></h3>
            </div>
            <div class="col-sm-4" style="background-color: yellowgreen;border-radius: 20px;color: white;margin-left: 2px;margin-right: 2px;width: 250px;">
                <h1>
                    <b>
                        <?php
                        echo $marcacao_count;
                        ?>
                    </b>
                </h1>
                <br>
                <h3><b>Carros (Venda) Registados</b></h3>
            </div>
        </div>
    </div>

    <br>
    <?php  foreach($carro_venda as $carro){
        ?>
        <table class="table table-bordered">
            <tr>
                <th rowspan="6" width="200">
                    <img src="<?= Yii::$app->request->baseUrl . '/images/car.jpg' ?>" class="img-responsive" >
                </th>
                <td><b>Dados</b></td>
            </tr>
            <tr>
                <td>Marcação: <?= $carro->marcaCarro; ?> </td>
            </tr>
            <tr>
                <td>Modelo: <?= $carro->modeloCarro; ?> </td>
            </tr>
            <tr>
                <td>Km(s):: <?= $carro->quilometros; ?> </td>
            </tr>
            <tr>
                <td>Combustível: <?= $carro->combustivel; ?> </td>
            </tr>
            <tr>
                <?php
                if (!Yii::$app->user->isGuest) { ?>
                    <td>
                        <?= Html::a('Ver mais', ['carro/view', 'id' => $carro->idCarro], ['class' => 'btn btn-success']) ?>
                    </td>
                <?php   } ?>
            </tr>
        </table>
    <?php }
    ?>
</div>
