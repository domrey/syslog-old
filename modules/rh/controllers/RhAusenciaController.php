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

    public function actionCreate2($id=null)
    {
        $model = new RhAusencia();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model_trab = new RhTrab();
        $model_plaza = new RhPlaza();
        $model_motivo = new RhAusenciaTipo();
        $motivos = ArrayHelper::map(RhAusenciaTipo::find()->all(), 'id', 'nombre');
        $status_cobertura = RhAusencia::ListaStatusCobertura();
        $plazas = RhPlaza::PlazasActivas();
        $jd = '';
        $puesto='';
        $jornada='';
        $descanso='';
        $nombreTrab='';
        $plaza_actual='';

        // Verificar si se está solicitando un trabajador en particular
        //$clave_trab=Yii::$app->request->get('id');
        if ($id !== null) {
            $model_trab = RhTrab::findOne($id);
            if ($model_trab!==null) {
              $nombreTrab=$model_trab->getFullName();

            // Ahora averiguar en qué plaza se encuentra actualmente este Trabajador
            $model_movimiento = RhMovimiento::UltimoMovimientoTrab($model_trab);
            // De ese movimiento se deduce la plaza actual del Trabajador
            if ($model_movimiento !== null){
              $model_plaza=$model_movimiento->plaza;
              $plaza_actual=$model_plaza->clave;
              // Determinar los detalles de la plaza supuesta - jornada y descanso
              if ($model_plaza !== null) {
                $descanso = $model_plaza->descanso->strDescanso();
                $jornada = $model_plaza->jornada->StrJornada();
                $jd = $jornada . ' Descanso:' . $descanso;
                $puesto = $model_plaza->puesto->StrPuesto();
              }
            }
          }
        }

        return $this->render('create', [
            'model' => $model,
            'model_trab'=>$model_trab,
            'model_plaza' => $model_plaza,
            'model_motivo' => $model_motivo,
            //'jornada_descanso' => $jd,
            'puesto' => $puesto,
            'jornada' => $jornada,
            'descanso' => $descanso,
            'nombreTrab' => $nombreTrab,
            'motivos' => $motivos,
            'status_cobertura'=>$status_cobertura,
            'plazas'=>$plazas,
            'plaza_actual'=>$plaza_actual,
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
}
