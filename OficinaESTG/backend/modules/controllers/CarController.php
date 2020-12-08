<?php

namespace backend\modules\controllers;

use common\models\Carro;
use Yii;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class CarController extends ActiveController
{
    public $modelClass = 'common\models\Carro';

    public function actionIndex(){

        $carro = Carro::find()->all();

        return Json::encode($carro);

    }

    public function actionCarrocreate(){

        $marcaCarro=Yii::$app->request->post('marcaCarro');
        $modeloCarro=Yii::$app->request->post('modeloCarro');
        $ano=Yii::$app->request->post('ano');
        $matricula=Yii::$app->request->post('matricula');
        $quilometros=Yii::$app->request->post('quilometros');
        $combustivel=Yii::$app->request->post('combustivel');
        $precoCarro=Yii::$app->request->post('precoCarro');

        $modelCarro = new $this->modelClass;
        $modelCarro->marcaCarro = $marcaCarro;
        $modelCarro->modeloCarro = $modeloCarro;
        $modelCarro->ano = $ano;
        $modelCarro->matricula = $matricula;
        $modelCarro->quilometros = $quilometros;
        $modelCarro->combustivel = $combustivel;
        $modelCarro->precoCarro = $precoCarro;
        $modelCarro->tipoCarro = 'Reparação';
        $modelCarro->fk_idPessoa = 1;
        $modelCarro->vendido = false;

        $ret = $modelCarro->save();

        return ['SaveError'=> $ret];
    }
}
