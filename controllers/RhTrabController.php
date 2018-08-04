<?php

namespace app\controllers;

use Yii;
use app\models\RhTrab;
use app\models\RhTrabSimpleSearch;
use app\models\RhTrabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

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
        ** Acción para mostrar el fichero de trabajadores
        ** inicialmente se había pensado en utilizar el SqlDataProvider
        ** 
     */

    public function actionListTrabs()
    {
        $searchModel = new RhTrabSimpleSearch();
        $dataProvider = $searchModel -> search(Yii::$app->request->queryParams);
        
        return $this->render('list-trabs', [
            'searchModel' => $searchModel,
            'provider' => $dataProvider
        ]);
    }
    /**
     * Lista los trabajadores - Fichero
     */
    public function actionList()
    {
        $searchModel = new RhTrabSimpleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM rh_trab WHERE activo=:active', [':active' => 1])->queryScalar();

        $provider = new SqlDataProvider ([
            'sql' => 'SELECT clave, CONCAT(nombre, " ", ap_pat, " ", ap_mat) AS trab, curp FROM rh_trab WHERE activo=:active ORDER BY trab ASC',
            'params' => [':active' => 1],
            'totalCount' => $count
        ]);

        return $this->render('fichero', ['searchModel' => $searchModel, 'provider'=>$provider]);
        
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
