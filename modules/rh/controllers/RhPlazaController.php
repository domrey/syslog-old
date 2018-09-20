<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhPlazaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RhPlazaController implements the CRUD actions for RhPlaza model.
 */
class RhPlazaController extends Controller
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
     * Lists all RhPlaza models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhPlazaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RhPlaza model.
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
     * Creates a new RhPlaza model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RhPlaza();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RhPlaza model.
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
     * Deletes an existing RhPlaza model.
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
     * Finds the RhPlaza model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RhPlaza the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RhPlaza::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    /***
      **  Obtiene ls claves de Plaza
      */

    public function actionGetClavePlaza($term)
    {
      $data =[];
      if (isset($term)) {
        $data = Yii::$app->db->createCommand("SELECT id, clave AS value FROM rh_plaza WHERE clave LIKE :cadena")
        ->bindValue(':cadena', '%' . $term . '%')->queryAll();
      }
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $data;
    }

    public function actionGetListadoPlazas($q=null, $id=null)
    {
      $data=['results'=>['id'=>'', 'text'=>'']];
      if (!is_null($q)) {
        $data['results'] = Yii::$app->db->createCommand("SELECT id, clave AS text FROM rh_plaza WHERE clave LIKE :cadena")
        ->bindValue(':cadena', '%' . $q . '%')->queryAll();

      }
      elseif ($id>0) {
        $data['results']=['id'=>$id, 'text'=>RhPlaza::find($id)];
      }
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $data;
    }

    public function actionGetIdPlaza()
    {
      $data=[];
      $clave = Yii::$app->request->get('plaza');
      $data = Yii::$app->db->createCommand("SELECT id as IdPlaza FROM rh_plaza WHERE clave = :key")
      ->bindValue(':key', $clave)->queryOne();
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $data;
    }

    // Para ser utilizada con ajaxConversion
    // Obtiene la información de jornada, clasificacion, categoria y descanso para la plaza_actual'
    // especificada en el parámetro
    public function actionGetDatosPlazaPorId()
    {
      $data=[];
      $id_plaza = Yii::$app->request->get('id');
      $data = Yii::$app->db->createCommand("SELECT a.id as IdPlaza, a.clave AS Plaza, a.tipo AS Tipo, c.descr AS Descanso, LPAD(a.clave_jornada, 2, '0') AS Jornada, b.descr AS Categoria, b.clasif As Clasificacion FROM rh_plaza a INNER JOIN rh_puesto b ON a.clave_puesto=b.clave INNER JOIN rh_descanso c ON a.clave_descanso=c.clave  WHERE a.id=:ID")
        ->bindValue(":ID", $id_plaza)->queryOne();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $data;

    }
}
