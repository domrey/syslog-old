<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhAusencia;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhAusenciaSearch;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhAusenciaTipo;
use app\modules\rh\models\RhMovimiento;
use app\modules\rh\models\RhDescanso;
use app\modules\rh\models\RhJornada;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * RhAusenciaController implements the CRUD actions for RhAusencia model.
 */
class RhAusenciaController extends Controller
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
     * Lists all RhAusencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhAusenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RhAusencia model.
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
     * Creates a new RhAusencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     public function actionCreate()
     {
       $model = new RhAusencia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
          'model'=>$model,
        ]);
     }

    /**
     * Updates an existing RhAusencia model.
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
     * Deletes an existing RhAusencia model.
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
     * Finds the RhAusencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RhAusencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RhAusencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**

    */
    public function actionGetDatosAusencia()
    {
      $idAusencia=Yii::$app->request->get('id');
      $ausencia=$this->findModel($idAusencia);
      $datos=[];
      $datos['IdPlaza'] = $ausencia->id_plaza;
      $datos['Plaza'] = $ausencia->clave_plaza;
      $datos['Desde'] = $ausencia->fec_inicio;
      $datos['Hasta'] = $ausencia->fec_termino;
      $datos['Referencia'] = $ausencia->referencia;
      $datos['Trabajador'] = $ausencia->trab->getFullName();
      Yii::$app->response->format=Response::FORMAT_JSON;
      return $datos;
    }
}
