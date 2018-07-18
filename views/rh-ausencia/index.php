<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhAusenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Ausencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Ausencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clave_trab',
            'id_plaza',
            'clave_tipo',
            'fec_inicio',
            //'fec_termino',
            //'fec_reanuda',
            //'req_cobertura',
            //'docs:ntext',
            //'obs:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
