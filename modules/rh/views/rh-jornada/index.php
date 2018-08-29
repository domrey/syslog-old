<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhJornadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jornadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-jornada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nueva Jornada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'descr',
            'clave_texto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
