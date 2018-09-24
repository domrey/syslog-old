<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhTrabSearch;
use app\modules\rh\models\RhTrabSimpleSearch;
use app\modules\rh\models\RhMovimiento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


/**
 * RhTrabController implements the CRUD actions for RhTrab model.
 */
class RhTrabController extends Controller
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
     * Lists all RhTrab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhTrabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RhTrab model.
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
     * Creates a new RhTrab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RhTrab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->clave]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RhTrab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->clave]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RhTrab model.
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
     * Finds the RhTrab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RhTrab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RhTrab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    * Obtiene la situacion actual del trabajador dada su clave
    * @param integer $clave_trab
    * @return Array: [nombre, plaza_actual, puesto_actual, jornada_actual, descanso_actual]
    *
    */
    public function actionGetSituacionTrab()
    {
      $datos['Ficha']='';
      $datos['Trabajador']='';
      $datos['IdPlaza']='';
      $datos['Plaza']='';
      $datos['Tipo']='';
      $datos['Descanso']='';
      $datos['Jornada']='';
      $datos['Categoria']='';
      $datos['Clasificacion']='';

      $trab;        // model RhTrab
      $movimiento; // modelo RhMovimiento
      $plaza;       // modelo RhPlaza
      $nombre_completo='';
      $plaza_actual='';
      $puesto_actual='';
      $jornada_actual='';
      $descanso_actual='';
      $clasif_actual='';

      // Buscar la clave
      $clave_trab=Yii::$app->request->get('clave_trab');
      if ($clave_trab === null || ($trab=RhTrab::findOne($clave_trab))===null) {
        return null;
      }
      else {
        $nombre_completo=$trab->getFullName();
        $datos['Ficha']=$clave_trab;
        $datos['Trabajador']=$nombre_completo;
        // Ahora averiguar en qué plaza se encuentra actualmente este Trabajador
        $movimiento = RhMovimiento::UltimoMovimientoTrab($trab);
        // De ese movimiento se deduce la plaza actual del Trabajador
        if ($movimiento !== null){
          $plaza=$movimiento->plaza;
          // Determinar los detalles de la plaza supuesta - jornada y descanso
          if ($plaza !== null) {
            $plaza_actual=$plaza->clave;
            $descanso_actual = $plaza->descanso->strDescanso();
            $jornada_actual = $plaza->jornada->StrJornada();
            $puesto_actual = $plaza->puesto->StrPuesto();
            $clasif_actual = $plaza->puesto->StrClasif();

            // Llenar la información
            $datos['Categoria'] = $puesto_actual;
            $datos['Plaza'] = $plaza_actual;
            $datos['IdPlaza'] = $plaza->id;
            $datos['Tipo'] = $plaza->tipo;
            $datos['Jornada']=$jornada_actual;
            $datos['Descanso']=$descanso_actual;
            $datos['Clasificacion']=$clasif_actual;
          }
        }
        Yii::$app->response->format=Response::FORMAT_JSON;
        return $datos;
      }
      //return $this->renderPartial('situacion-actual', ['datos'=>$datos]);
      //return $datos;
    }

    /* Muestra el fichero de Trabajadores
    * @return mixed
    */
    public function actionList()
    {
      $searchModel = new RhTrabSimpleSearch();
      $dataProvider = $searchModel -> search(Yii::$app->request->queryParams);

      return $this->render('list-trabs', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
      ]);
    }


    //public function actionLookup($searchStr)
    public function actionLookup()
    {
      $searchModel = new RhTrabSimpleSearch();
      $lookfor = Yii::$app->request->get('search');
      $dataProvider = null;
      //$search = Yii::$app->request->post('search');
      //$dataProvider = $searchModel->lookup($search);
      //$dataProvider = $searchModel->lookup(Yii::$app->request->queryParams);
      if ($lookfor !== null) {
        $dataProvider = $searchModel->lookup($lookfor);
      }
      //$dataProvider = $searchModel->lookup($searchStr);
      return $this->renderAjax('_lookup', [
        '$model' => $searchModel,
        'dataProvider' => $dataProvider,
      ]);
    }

    public function actionGetDatosTrabPorId()
    {
      $datos=[];
      $clave_trab=Yii::$app->request->get("id");
      if ($clave_trab===null || ($trab=RhTrab::findOne($clave_trab))===null) {
        return null;
      }
      $datos['Ficha']=$clave_trab;
      $datos['Nombre']=$trab->getFullName();
      Yii::$app->response->format=Response::FORMAT_JSON;
      return $datos;
    }

    public function actionGetPlazaActual()
    {
      $datos=[];
      $trab=null;
      $movimiento=null;
      $clave_trab = Yii::$app->request->get('clave_trab');
      if ($clave_trab === null || ($trab=RhTrab::findOne($clave_trab))===null) {
        return null;
      }
      $movimiento = RhMovimiento::UltimoMovimientoTrab($trab);
      if ($movimiento != null) {
        $plaza_actual = $movimiento->plaza;
        $datos['Id'] = $plaza_actual->id;
        $datos['Clave'] = $plaza_actual->clave;
      }
      Yii::$app->response->format=Response::FORMAT_JSON;
      return $datos;
    }

    public function actionGetNextBirthdays()
    {
      $daysInterval=7;
      $sql = 'SELECT clave AS IdTrab, concat(nombre,\' \', ap_pat) AS NombreTrab, fec_nac AS FecNac ';
      $sql .= 'FROM rh_trab WHERE CONCAT(IF(CONCAT( YEAR(CURDATE()), ';
      $sql .= 'substring(`fec_nac`, 5, length(`fec_nac`))) < CURDATE(), ';
      $sql .= 'YEAR(CURDATE()) + 1, YEAR(CURDATE()) ), substring(`fec_nac`, 5, length(`fec_nac`))) ';
      $sql .= 'BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL :dint DAY)';

      $data=['results'=>['IdTrab'=>'', 'NombreTrab'=>'', 'FecNac'=>'']];
      $data['results'] = Yii::$app->db->createCommand($sql)->bindValue(':dint', $daysInterval)->queryAll();
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $data;
    }

}
