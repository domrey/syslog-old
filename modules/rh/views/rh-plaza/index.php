<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhPlazaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Plazas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-plaza-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Plaza', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clave',
            'descr',
            'tipo',
            'clave_puesto',
            //'activa',
            //'visible',
            //'depto',
            //'clave_descanso',
            //'clave_jornada',
            //'fec_creacion',
            //'residencia',
            //'localidad',
            //'taller',
            //'instalacion',
            //'funcion',
            //'grupo',
            //'sirhn',
            //'posfin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
