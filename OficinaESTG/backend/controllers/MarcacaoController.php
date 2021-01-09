<?php

namespace backend\controllers;

use common\models\Carro;
use common\models\Pessoa;
use Yii;
use common\models\Marcacao;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarcacaoController implements the CRUD actions for Marcacao model.
 */
class MarcacaoController extends Controller
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
     * Lists all Marcacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewMarcacao')) {
            $dataProvider = null;

            $pessoa = Pessoa::find()->where(['idPessoa' => Yii::$app->user->identity->id])->one();


            if ($pessoa->tipoPessoa === 'Secretaria') {

                $dataProvider = new ActiveDataProvider([
                    'query' => Marcacao::findAll(),
                ]);
            } else if ($pessoa->tipoPessoa === 'Mecanico') {

                $dataProvider = new ActiveDataProvider([
                    'query' => Marcacao::find()->where(['fk_idResponsavel' => Yii::$app->user->identity->id]),
                ]);
            }else{
                throw new ForbiddenHttpException('Não tem dados', 403);
            }


            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);


        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Displays a single Marcacao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewMarcacao')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }


    }

    /**
     * Creates a new Marcacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('createMarcacao')) {
            $model = new Marcacao();

            if ($model->load(Yii::$app->request->post())) {

                $model->fk_idPessoa = Yii::$app->user->identity->getId();

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->idMarcacoes]);
                }

            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Updates an existing Marcacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateMarcacao')) {
            $model = $this->findModel($id);


            if ($model->load(Yii::$app->request->post())) {

                if ($model->horasTrabalho > 0) {
                    $model->valorFinal = $model->valorFinal + (15 * $model->horasTrabalho);
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->idMarcacoes]);
                }

            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    public function actionUpdate_venda($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idMarcacoes]);
            }

        }

        return $this->render('update_venda', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Marcacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteMarcacao')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException('Não tem permissões', 403);
        }
    }

    /**
     * Finds the Marcacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Marcacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marcacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
