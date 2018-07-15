<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlazaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plazas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plaza-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Plaza', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'descr',
            'tipo',
            'clave_puesto',
            'activa',
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
