<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhMovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimientos de trabajadores';
$this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = $this->title;
$actionCol= [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Acciones',
            'headerOptions'=>['width'=>'120'],
            'template' => '{view} {update}&nbsp;&nbsp;&nbsp;&nbsp;{terminate}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
            'buttons' => [
                'update' => function ($url,$model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        $url);
                },
                'terminate' => function ($url,$model,$key) {
                    if ($model->fec_termino>=date('Y-m-d'))
                      return Html::a('<span class="glyphicon glyphicon-off"></span>', $url);
                    else
                      return '&nbsp;&nbsp;&nbsp; ';

                },
	          ],
          ];
?>
<div class="rh-movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
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
            'clave_plaza',
            'id_plaza',
            // 'id_ausencia',
            //'id_mov_padre',
            'fec_inicio',
            'fec_termino',
            //'descr',
            'doc_form',
            'doc_num',
            //'ref_motivo',
            //'ref_origen',
            //'tipo',
            //'term_ant',
            //'term_descr',
            //'term_motivo',

            // ['class' => 'yii\grid\ActionColumn'],
            $actionCol,
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
