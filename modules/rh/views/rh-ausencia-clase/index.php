<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhAusenciaClaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Ausencia Clases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-clase-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Ausencia Clase', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'nombre',
            'descr',
            'id_vacancia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
