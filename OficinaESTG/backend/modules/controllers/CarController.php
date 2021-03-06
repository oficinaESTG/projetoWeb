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
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
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

        return $rec;
    }

    public function actionCarrovendaget()
    {
        $rec = Carro::find()->where(['tipoCarro' => 'venda' ])->all();

        return $rec;
    }

    public function actionCarrocreate(){

        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();

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
        $modelCarro->fk_idPessoa = $pessoa->idPessoa;
        $modelCarro->vendido = false;

        $ret = $modelCarro->save();

        return ['SaveError'=> $ret];

    }

    public function actionCarroput($id){

        //$id = Yii::$app->request->get("id");

        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();
        $request = Yii::$app->request;

        $marcaCarro = $request->getBodyParam('marcaCarro');
        $modeloCarro = $request->getBodyParam('modeloCarro');
        $ano = $request->getBodyParam('ano');
        $matricula = $request->getBodyParam('matricula');
        $quilometros = $request->getBodyParam('quilometros');
        $combustivel = $request->getBodyParam('combustivel');
        $precoCarro = $request->getBodyParam('precoCarro');



        $modelCarro = new $this->modelClass;

        $rec = $modelCarro::find()->where("idCarro=".$id)->one();

        if($rec != null){

            $rec->marcaCarro = $marcaCarro;
            $rec->modeloCarro = $modeloCarro;
            $rec->ano = $ano;
            $rec->matricula = $matricula;
            $rec->quilometros = $quilometros;
            $rec->combustivel = $combustivel;
            $rec->precoCarro = $precoCarro;
            $rec->tipoCarro = 'Reparação';
            $rec->vendido = false;

            if( $rec->save()){
                return ['Save'=> $rec];
            }else{
                return ['SaveError'=> $rec];
            }
        }

        throw new \yii\web\NotFoundHttpException(" idCarro not found!");

    }

    public function actionCarrodel($id){
        $modelCarro = new $this->modelClass;
        $ret = $modelCarro->deleteAll("idCarro=".$id);
        if($ret){
            Yii::$app->response->statusCode =200; return ['code'=>'ok'];
        }
        Yii::$app->response->statusCode =404; return ['code'=>'error'];
    }
}
