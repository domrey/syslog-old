<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhAusenciaMotivo;
use app\modules\rh\models\RhAusenciaMotivoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * RhAusenciaMotivoController implements the CRUD actions for RhAusenciaMotivo model.
 */
class RhAusenciaMotivoController extends Controller
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
     * Lists all RhAusenciaMotivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhAusenciaMotivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RhAusenciaMotivo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RhAusenciaMotivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RhAusenciaMotivo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RhAusenciaMotivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RhAusenciaMotivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RhAusenciaMotivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RhAusenciaMotivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RhAusenciaMotivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetNombreAusencia()
    {
      $nombre_ausencia='';
      $clave_tipo = Yii::$app->request->get('clave_tipo');
      $tipo = RhAusenciaMotivo::find()->where(['clave'=>$clave_tipo])->one();
      $nombre_ausencia = $tipo->descr;
      Yii::$app->response->format=Response::FORMAT_JSON;
      $tipo_ausencia['nombre']=$nombre_ausencia;
      //return $this->renderPartial('nombre-tipo-ausencia', [
      //  'nombre_tipo_ausencia'=>$nombre_ausencia
      //]);
      return $tipo_ausencia;
    }


}
