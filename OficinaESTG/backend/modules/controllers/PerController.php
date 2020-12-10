<?php

namespace backend\modules\controllers;

use common\models\Carro;
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

    public function actionPessoaget()
    {
        $actoken = Yii::$app->request->get("access-token");
        $user = User::findIdentityByAccessToken($actoken);
        $pessoa = Pessoa::find()->where(['fk_IdUser' => $user->id])->one();

        return $pessoa;
    }
}
