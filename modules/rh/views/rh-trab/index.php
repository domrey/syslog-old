<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhTrabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trabajadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-index">

    <h1>Catálogo de <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar un nuevo trabajdor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'clave',
            'nombre',
            'ap_pat',
            'ap_mat',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
