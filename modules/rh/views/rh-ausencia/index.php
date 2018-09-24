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
?>
<div class="rh-ausencia-index">

    <h3>Ausencias de los trabajadores</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Una Ausencia', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>'true',
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
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Ausencias Registradas</h3>',
        ],
        'toolbar' => [
          '{export}',
          '{toggleData}',
          'toggleDataContainer' => ['class' => 'btn-group-sm'],
          'exportContainer' => ['class' => 'btn-group-sm']
        ],
        'columns' => [
            // ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [
              'attribute'=>'clave_trab',
              'label'=>'FICHA',
              'value' => function($model) {
                    return sprintf('%07d', $model->clave_trab);
                  },
                'width' => '80px',
                'hAlign'=>GridView::ALIGN_RIGHT,
            ],
            [
              'attribute' => 'obs',
              'value' => 'trabName',
              'label' => 'TRABAJADOR',
            ],
            [
              'attribute'=>'clave_plaza',
              'label'=>'EN PLAZA',
            ],
            // 'id_motivo',
            // 'clave_motivo',
            [
                'attribute' => 'clave_motivo',
                //'value' => 'tipo.nombre',
                'label' => 'Motivo',
                'class' => '\kartik\grid\DataColumn',
                'value' => 'motivoCobertura',
                'filter' => Html::activeDropDownList($searchModel, 'clave_motivo', RhAusencia::ListaMotivosCobertura(), ['class'=>'form-control','prompt' => 'All'])
            ],
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
            [
              'class' => 'kartik\grid\ActionColumn',
              // 'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
