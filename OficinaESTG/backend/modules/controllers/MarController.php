<?php

namespace backend\modules\controllers;

use common\models\Carro;
use common\models\Marcacao;
use common\models\Pessoa;
use common\models\User;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class MarController extends ActiveController
{
    public $modelClass = 'common\models\Marcacao';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function actions() {
        $actions =parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionMarcacaoget()
    {
        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();
        $marcacao = Marcacao::find()->where(['fk_idPessoa' => $pessoa->idPessoa])->all();

        return $marcacao;

    }

    public function actionMarcacaocreate(){

        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();

        $dataMarcacao=Yii::$app->request->post('dataMarcacao');
        $descricaoMarcacao=Yii::$app->request->post('descricaoMarcacao');
        $fk_idCarro=Yii::$app->request->post('fk_idCarro');

        $modelMarcacao = new $this->modelClass;

        $modelMarcacao->dataMarcacao = $dataMarcacao;
        $modelMarcacao->descricaoMarcacao = $descricaoMarcacao;
        $modelMarcacao->fk_idCarro = $fk_idCarro;
        $modelMarcacao->tipoMarcacao = 'Reparacao';
        $modelMarcacao->estadoMarcacao = 'Espera';
        $modelMarcacao->fk_idPessoa = $pessoa->idPessoa;

        $ret = $modelMarcacao->save();

        return ['SaveError'=> $ret];
    }

    public function actionMarcacaovendacreate(){

        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();

        $dataMarcacao=Yii::$app->request->post('dataMarcacao');
        $descricaoMarcacao=Yii::$app->request->post('descricaoMarcacao');
        $fk_idCarro=Yii::$app->request->post('fk_idCarro');

        $modelMarcacao = new $this->modelClass;

        $modelMarcacao->dataMarcacao = $dataMarcacao;
        $modelMarcacao->descricaoMarcacao = $descricaoMarcacao;
        $modelMarcacao->fk_idCarro = $fk_idCarro;
        $modelMarcacao->tipoMarcacao = 'Venda';
        $modelMarcacao->estadoMarcacao = 'Espera';
        $modelMarcacao->fk_idPessoa = $pessoa->idPessoa;

        $ret = $modelMarcacao->save();

        return ['SaveError'=> $ret];
    }


}
