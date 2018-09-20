<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhAusenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ausencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Una Ausencia', ['create'], ['class' => 'btn btn-success']) ?>
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
            'id_motivo',
            //'clave_motivo',
            //'fec_inicio',
            //'fec_termino',
            //'fec_reanuda',
            //'req_cobertura',
            //'doc:ntext',
            //'obs:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
