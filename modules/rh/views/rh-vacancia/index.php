<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhVacanciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Vacancias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-vacancia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Vacancia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
