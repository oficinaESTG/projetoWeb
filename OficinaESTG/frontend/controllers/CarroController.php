<?php

namespace frontend\controllers;

use Yii;
use common\models\Carro;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarroController implements the CRUD actions for Carro model.
 */
class CarroController extends Controller
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
     * Lists all Carro models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewCarro')) {
            $model = Carro::find()->where(['fk_idPessoa' => Yii::$app->user->identity->getId()])->all();

            return $this->render('index', [
                'model' => $model
            ]);
        }else {
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }

    }

    /**
     * Displays a single Carro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewCarro')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else {
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    public function actionView_guest($id)
    {
        return $this->render('view_guest', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Carro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('createCarro')) {
            $model = new Carro();

            if ($model->load(Yii::$app->request->post())) {

                $model->tipoCarro = 'Reparacao';
                $model->fk_idPessoa = Yii::$app->user->identity->getId();

                if ($model->save()){
                    return $this->redirect(['view', 'id' => $model->idCarro]);
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }

    }

    /**
     * Updates an existing Carro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateCarro')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idCarro]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Deletes an existing Carro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteCarro')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Finds the Carro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
