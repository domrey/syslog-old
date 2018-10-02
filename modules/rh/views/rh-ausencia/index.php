<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\modules\rh\models\RhAusencia;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhAusenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ausencias';
$this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = $this->title;

$panelHeading='<i class="glyphicon glyphicon-log-out"></i>&nbsp;Ausencias Registradas';
$btnAdd=Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
            'class'=> 'btn btn-primary',
            'title'=> 'Registrar Ausencia',
            // 'onclick'=>'alert("this is click");'
            'data-pjax'=>0,
            ]);
?>
<div class="rh-ausencia-index">

    <!-- <h3>Ausencias de los trabajadores</h3> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a('Registrar Una Ausencia', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        'striped'=>false,
        'bordered'=>false,
        'condensed'=>true,
        'pjax'=>true,
        // 'perfectScrollbar'=>true,
        'resizableColumns'=>true,
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
            // 'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Ausencias Registradas</h3>',
            'heading'=>$panelHeading,
            'before'=>'<em>Muestra todas las ausencias de los trabajadores registradas</em>',
        ],
        'toolbar' => [
          [
            'content'=> $btnAdd,
            'options'=>['class'=>'btn-group mr-2'],
          ],
          '{export}',
          '{toggleData}',
          'toggleDataContainer' => ['class' => 'btn-group-sm'],
          'exportContainer' => ['class' => 'btn-group-sm']
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            // ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            [
              'attribute'=>'id',
              'label'=>'ID',
              'width'=>'80px',
              'hAlign'=>GridView::ALIGN_CENTER,
            ],
            [
              'attribute'=>'clave_trab',
              'label'=>'FICHA',
              'value' => function($model) {
                    return sprintf('%07d', $model->clave_trab);
                  },
                'width' => '80px',
                'hAlign'=>GridView::ALIGN_CENTER,
            ],
            // [
              // 'attribute'=>'apodo',
              // 'value' => 'trab.apodo',
              // 'label' => 'SOBRENOMBRE',
            // ],

            [
              'attribute'=>'trabName',
              // 'value' => 'trab.apodo',
              'label' => 'TRABAJADOR',
                'hAlign'=>GridView::ALIGN_CENTER,
            ],
            [
              'attribute'=>'clave_plaza',
              'label'=>'EN PLAZA',
                'hAlign'=>GridView::ALIGN_CENTER,
            ],
            // 'id_motivo',
            // 'clave_motivo',
            [
                'attribute' => 'clave_motivo',
                //'value' => 'tipo.nombre',
                'label' => 'MOTIVO',
                'class' => '\kartik\grid\DataColumn',
                'value' => 'motivoCobertura',
                'filter' => Html::activeDropDownList($searchModel, 'clave_motivo', RhAusencia::ListaMotivosCobertura(), ['class'=>'form-control','prompt' => 'All'])
                // 'hAlign'=>'center',
                // 'hAlign'=>GridView::ALIGN_CENTER,
            ],
            [
              'attribute'=>'fec_inicio',
              'label'=>'DESDE EL',
              'hAlign'=>GridView::ALIGN_CENTER,
              'format'=>['date', Yii::$app->formatter->dateFormat],
              'width'=>'120px',
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
            [
              'attribute'=>'fec_termino',
              'label'=>'HASTA EL',
              'hAlign'=>GridView::ALIGN_CENTER,
              'format'=>['date', Yii::$app->formatter->dateFormat],
              'width'=>'120px',
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
            [
              'class' => 'kartik\grid\ActionColumn',
              // 'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
