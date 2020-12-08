<?php

namespace backend\modules\controllers;

use common\models\Carro;
use common\models\Pessoa;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class CarController extends ActiveController
{
    public $modelClass = 'common\models\Carro';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }

    public function auth($username, $password)
    { $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            return $user;
        }
        return null;
    }


    public function actionIndex(){

        $carro = Carro::find()->all();

        return Json::encode($carro);

    }

    public function actionCarroget()
    {
        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();
        $rec = Carro::find()->where(['fk_idPessoa' => $pessoa->idPessoa])->all();

        return Json::encode($rec);

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

    public function actionCarroput($id){

        $marcaCarro=Yii::$app->request->post('marcaCarro');
        $modeloCarro=Yii::$app->request->post('modeloCarro');
        $ano=Yii::$app->request->post('ano');
        $matricula=Yii::$app->request->post('matricula');
        $quilometros=Yii::$app->request->post('quilometros');
        $combustivel=Yii::$app->request->post('combustivel');
        $precoCarro=Yii::$app->request->post('precoCarro');

        $modelCarro = new $this->modelClass;
        $rec = $modelCarro::find()->where(['idCarro' => $id])->one();


        if(count($rec) > 0){
            $rec = new $this->modelClass;

            $rec->marcaCarro = $marcaCarro;
            $rec->modeloCarro = $modeloCarro;
            $rec->ano = $ano;
            $rec->matricula = $matricula;
            $rec->quilometros = $quilometros;
            $rec->combustivel = $combustivel;
            $rec->precoCarro = $precoCarro;
            $rec->tipoCarro = 'Reparação';
            $rec->fk_idPessoa = 1;
            $rec->vendido = false;

            $ret = $modelCarro->save();

            return ['SaveError'=> $ret];
        }

        throw new \yii\web\NotFoundHttpException(" id not found!");


    }
}
