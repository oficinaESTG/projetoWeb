<?php

namespace backend\modules\controllers;

use common\models\Carro;
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
class PerController extends ActiveController
{
    public $modelClass = 'common\models\Pessoa';

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

    public function actionPessoaget()
    {
        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();

        return $pessoa;

    }

    public function actionPessoacreate()
    {

        $username=Yii::$app->request->post('username');
        $email=Yii::$app->request->post('email');
        $password=Yii::$app->request->post('password');
        $nome=Yii::$app->request->post('nome');
        $dataNascimento=Yii::$app->request->post('dataNascimento');
        $morada=Yii::$app->request->post('morada');
        $nif=Yii::$app->request->post('nif');



        $modelPessoa = new $this->modelClass;

        $modelPessoa->nome = $nome;
        $modelPessoa->descricaoMarcacao = $dataNascimento;
        $modelPessoa->fk_idCarro = $morada;
        $modelPessoa->tipoMarcacao = $nif;
        $modelPessoa->tipoMarcacao = $nif;
        $modelPessoa->tipoPessoa = "Cliente";
        $modelPessoa->email = $email;
        $modelPessoa->


        $ret = $modelPessoa->save();

        return ['SaveError'=> $ret];


    }

}
