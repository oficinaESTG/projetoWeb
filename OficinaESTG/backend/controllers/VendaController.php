<?php

namespace backend\controllers;

use common\models\Carro;
use common\models\Marcacao;
use Yii;
use common\models\venda;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendaController implements the CRUD actions for venda model.
 */
class VendaController extends Controller
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
     * Lists all venda models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewVenda')) {

            $dataProvider = new ActiveDataProvider([
                'query' => venda::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Displays a single venda model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewVenda')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Creates a new venda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (\Yii::$app->user->can('createVenda')) {
            $model = new venda();
            $modelCarro = Carro::find()->where(['idCarro' => $id])->one();
            $modelMarcacao = Marcacao::find()->where(['fk_idCarro' => $modelCarro->idCarro])->one();

            if ($model->load(Yii::$app->request->post())) {

                $model->fk_idCarro = $id;
                $model->quantiaVenda = 1;

                $modelCarro->vendido = true;

                if ($modelMarcacao != null) {
                    $modelMarcacao->estadoMarcacao = 'Concluida';
                    $modelMarcacao->save();
                }

                if ($model->save() && $modelCarro->save()) {
                    return $this->redirect(['view', 'id' => $model->idVenda]);
                }
            }

            return $this->render('create', [
                'model' => $model,
                'modelCarro' => $modelCarro,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Updates an existing venda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateVenda')) {
            $model = $this->findModel($id);

            $modelCarro = Carro::find()->where(['idCarro' => $model->fk_idCarro])->one();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idVenda]);
            }

            return $this->render('update', [
                'model' => $model,
                'modelCarro' => $modelCarro,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Deletes an existing venda model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteVenda')) {
            $model = $this->findModel($id);

            $modelCarro = Carro::find()->where(['idCarro' => $model->fk_idCarro])->one();
            $modelCarro->vendido = false;
            $modelCarro->save();

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Finds the venda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return venda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = venda::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
