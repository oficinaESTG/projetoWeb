<?php

namespace backend\controllers;

use common\models\Marcacao;
use common\models\User;
use common\models\Carro;
use Yii;
use common\models\Pessoa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pessoa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewPessoa_back')) {
            $dataProvider = new ActiveDataProvider([
                'query' => Pessoa::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Displays a single Pessoa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       if (\Yii::$app->user->can('viewPessoa_back')) {
            $model = $this->findModel($id);

            $carro = Carro::find()->where(['fk_idPessoa' => $model->idPessoa])->all();

            return $this->render('view', [
                'model' => $model,
                'carro' => $carro,
            ]);
        }else{
           throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Creates a new Pessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('createPessoa_back')) {
            $model = new Pessoa();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idPessoa]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if (\Yii::$app->user->can('updatePessoa_back')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    $user_id = User::find()->where(['id' => $id])->one();

                    $auth = \Yii::$app->authManager;
                    $utenteRole = $auth->getRole($model->tipoPessoa);
                    $auth->revokeAll($user_id->id);
                    $auth->assign($utenteRole, $id);

                    return $this->redirect(['view', 'id' => $model->idPessoa]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
       }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deletePessoa_back')) {
            $this->findModel($id)->delete();

            if (Carro::find()->where(['fk_idPessoa' => $id]) != null){
                Carro::deleteAll(['fk_idPessoa' => $id]);
            }
            if (Marcacao::find()->where(['fk_idPessoa' => $id]) != null){
                Marcacao::deleteAll(['fk_idPessoa' => $id]);
            }
            if (Pessoa::find()->where(['fk_IdUser' => $id]) != null){
                Pessoa::deleteAll(['fk_IdUser' => $id]);
            }


            User::deleteAll(['id' => $id]);

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
