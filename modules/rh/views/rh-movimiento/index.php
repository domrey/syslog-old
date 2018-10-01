<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

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

    <h3><?= Html::encode($this->title) ?></h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Un Movimiento', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        // 'perfectScrollbar'=>true,
        'floatHeader'=>true,
        'showPageSummary'=>false,
        'showHeader'=>true,
        'export'=>[
            // 'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'panel' => [
            // 'type' => 'info',GridView::TYPE_INFO
            'type' => GridView::TYPE_INFO,
            //'heading' => 'Ausencias Registradas'
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-new-window"></i>&nbsp;Movimientos Registrados</h3>',
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
              'attribute'=>'id',
              'label'=>'ID',
              'width'=>'80px',
              'hAlign'=>GridView::ALIGN_CENTER,
            ],
            // 'clave_trab',
            [
              'attribute'=>'clave_trab',
              'label'=>'FICHA',
              'value' => function($model) {
                    return sprintf('%07d', $model->clave_trab);
                  },
                'width' => '80px',
                'hAlign'=>GridView::ALIGN_CENTER,
            ],
            [
              'value' => 'trabName',
              'label' => 'TRABAJADOR',
            ],
            // 'clave_plaza',
            [
              'attribute'=>'clave_plaza',
              'label'=>'EN PLAZA',
            ],
            // 'id_plaza',
            // 'id_ausencia',
            //'id_mov_padre',
            // 'fec_inicio',
            [
              'attribute'=>'fec_inicio',
              'label'=>'DESDE EL',
              'format'=>['date', Yii::$app->formatter->dateFormat],
              'width'=>'100px',
              // 'format' => 'raw',
              'filter' => DatePicker::widget([
                  'model' => $searchModel,
                  'attribute' => 'fec_inicio',
                  'options' => ['placeholder' => 'Elija la fecha...'],
                  'type' => DatePicker::TYPE_INPUT,
                     'removeButton'=>true,
                   'pluginOptions' => [
                     'format' => 'yyyy-mm-d',
                     'autoClose' => true,
                     'todayHighlight' =>false,
                   ]
              ]),
            ],
            // 'fec_termino',
            [
              'attribute'=>'fec_termino',
              'label'=>'HASTA EL',
              'format'=>['date', Yii::$app->formatter->dateFormat],
              'width'=>'100px',
              // 'format' => 'raw',
              'filter' => DatePicker::widget([
                  'model' => $searchModel,
                  'attribute' => 'fec_termino',
                  'options' => ['placeholder' => 'Elija la fecha...'],
                  'type' => DatePicker::TYPE_INPUT,
                   'pluginOptions' => [
                     'format' => 'yyyy-mm-d',
                     'autoClose' => true,
                     'todayHighlight' =>false,
                   ]
              ]),
            ],
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
