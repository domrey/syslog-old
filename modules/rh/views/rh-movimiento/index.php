<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhMovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Movimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clave_trab',
            'id_plaza',
            'clave_plaza',
            'id_ausencia',
            'fec_inicio',
            'fec_termino',
            //'tipo_mov',
            //'descr:ntext',
            //'docs:ntext',
            //'motivo:ntext',
            //'ref_motivo:ntext',
            //'ref_origen:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
