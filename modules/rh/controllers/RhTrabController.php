<?php

namespace app\modules\rh\controllers;

use Yii;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhTrabSearch;
use app\modules\rh\models\RhTrabSimpleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    * Muestra el fichero de Trabajadores
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
      return $this->renderAjax('_lookup-tmp', [
        '$model' => $searchModel,
        'dataProvider' => $dataProvider,
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
}
