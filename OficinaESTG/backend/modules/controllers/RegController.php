<?php

namespace backend\modules\controllers;

use common\models\Carro;
use common\models\LoginForm;
use common\models\Pessoa;
use common\models\User;
use frontend\models\SignupForm;
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
class RegController extends ActiveController
{
    public $modelClass = 'common\models\Pessoa';
    public $modelLogin = 'common\models\LoginForm';

    public function actionRegistar()
    {
        $username=Yii::$app->request->post('username');
        $email=Yii::$app->request->post('email');
        $password=Yii::$app->request->post('password');
        $nome=Yii::$app->request->post('nome');
        $dataNascimento=Yii::$app->request->post('dataNascimento');
        $morada=Yii::$app->request->post('morada');
        $nif=Yii::$app->request->post('nif');

        $model = new SignupForm();

        $model->username = $username;
        $model->email = $email;
        $model->password = $password;

        if ($model->signup()){

            $identity = User::findOne(['email' => $email]);

            $modelPessoa = new $this->modelClass;

            $modelPessoa->nome = $nome;
            $modelPessoa->dataNascimento = $dataNascimento;
            $modelPessoa->morada = $morada;
            $modelPessoa->nif = $nif;
            $modelPessoa->tipoPessoa = "Cliente";
            $modelPessoa->email = $email;
            $modelPessoa->fk_IdUser = $identity->getId();

            if ($modelPessoa->save()){

                $auth = \Yii::$app->authManager;
                $utenteRole = $auth->getRole($modelPessoa->tipoPessoa);
                $auth->assign($utenteRole, Yii::$app->user->identity->getId());

                return ['SaveError'=> true];
            }

            return ['SaveError'=> $modelPessoa];
        }

        return ['SaveError'=> $model];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->username = Yii::$app->request->post('username');
        $model->password = Yii::$app->request->post('password');

        if( $model->login()){
            return User::find()->where(['username' => $model->username])->one();
        }

        return false;
    }


}
