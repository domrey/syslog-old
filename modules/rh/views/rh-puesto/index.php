<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhPuestoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-puesto-index">

    <h1>Catálogo de <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nuevo Puesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'descr',
            //'nombre',
            //'puesto_stps',
            //'clave_stps',
            //'activo',
            //'id_rev',
            //'id_reg_cont',
            'nivel',
            //'familia',
            //'labores',
            'regimen',
            'clasif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
