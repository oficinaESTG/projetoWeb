<?php

namespace backend\controllers;

use common\models\Marcacao;
use common\models\Peca;
use Yii;
use common\models\MarcacaoHaspecas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarcacaoHaspecasController implements the CRUD actions for MarcacaoHaspecas model.
 */
class MarcacaoHaspecasController extends Controller
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
     * Lists all MarcacaoHaspecas models.
     * @return mixed
     */
    public function actionIndex($idMarcacao)
    {
        if (\Yii::$app->user->can('viewMarcPecas')) {
            $dataProvider = new ActiveDataProvider([
                'query' => MarcacaoHaspecas::find()->where(['fk_idMarcacao' => $idMarcacao]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Displays a single MarcacaoHaspecas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewMarcPecas')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Creates a new MarcacaoHaspecas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idMarcacao)
    {
        if (\Yii::$app->user->can('createMarcPecas')) {
            $model = new MarcacaoHaspecas();

            if ($model->load(Yii::$app->request->post())) {

                $model->fk_idMarcacao = $idMarcacao;


                if ($model->save()) {
                    $modelPeca = Peca::find()->where(['idPeca' => $model->fk_idPeca])->one();
                    $modelPeca->quantidadePeca = $modelPeca->quantidadePeca - $model->quantidadeParaMarcacao;

                    $modelMarcacao = Marcacao::find()->where(['idMarcacoes' => $idMarcacao])->one();
                    $modelMarcacao->valorFinal = $modelMarcacao->valorFinal + ($modelPeca->precoPeca * $model->quantidadeParaMarcacao);

                    if ($modelPeca->save() && $modelMarcacao->save()) {
                        return $this->redirect(['view', 'id' => $model->idMarcacao_hasPecas]);
                    }

                }

            }

            return $this->render('create', [
                'model' => $model,
                'idMarcacao' => $idMarcacao,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Updates an existing MarcacaoHaspecas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateMarcPecas')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idMarcacao_hasPecas]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Deletes an existing MarcacaoHaspecas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteMarcPecas')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Finds the MarcacaoHaspecas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MarcacaoHaspecas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MarcacaoHaspecas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
