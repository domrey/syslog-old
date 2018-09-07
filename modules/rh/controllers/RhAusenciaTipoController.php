<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhAusenciaTipo;
use app\modules\rh\models\RhAusenciaTipoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * RhAusenciaTipoController implements the CRUD actions for RhAusenciaTipo model.
 */
class RhAusenciaTipoController extends Controller
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
     * Lists all RhAusenciaTipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RhAusenciaTipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RhAusenciaTipo model.
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
     * Creates a new RhAusenciaTipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RhAusenciaTipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RhAusenciaTipo model.
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
     * Deletes an existing RhAusenciaTipo model.
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
     * Finds the RhAusenciaTipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RhAusenciaTipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RhAusenciaTipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetNombreAusencia()
    {
      $nombre_ausencia='';
      $clave_tipo = Yii::$app->request->get('clave_tipo');
      $tipo = RhAusenciaTipo::find()->where(['clave'=>$clave_tipo])->one();
      $nombre_ausencia = $tipo->descr;
      Yii::$app->response->format=Response::FORMAT_JSON;
      $tipo_ausencia['nombre']=$nombre_ausencia;
      //return $this->renderPartial('nombre-tipo-ausencia', [
      //  'nombre_tipo_ausencia'=>$nombre_ausencia
      //]);
      return $tipo_ausencia;
    }
}
