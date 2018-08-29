<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use app\modules\rh\models\RhAusencia;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhAusenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ausencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nueva Ausencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover' => true,
        'panel' => [
            'type' => 'primary',
            //'heading' => 'Ausencias Registradas'
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-log-out"></i>Ausencias Registradas</h3>',
        ],
        'showPageSummary' => false,
        'toolbar' => [
          [
            'content' => Html::button('<i class="glyphicon glyphicon-option-horizontal"></i>', [
                    'type'=>'button',
                    'title' => 'Add Book',
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                    'class' => 'btn btn-default',
                    'title' => 'Reset Grid'
                ]),
              'options' => ['class' => 'btn-group-sm']
          ],
          '{export}',
          '{toggleData}',
          'toggleDataContainer' => ['class' => 'btn-group-sm'],
          'exportContainer' => ['class' => 'btn-group-sm']
        ],
        'columns' => [
            [ 'class' => '\kartik\grid\SerialColumn'],
            [
                'attribute' => 'clave_trab',
                'label' => 'Ficha',
                'value' => function($model) {
                    return sprintf('%08d', $model->clave_trab);
                  },
                'width' => '100px',

            ],
            [
              'attribute' => 'obs',
              'value' => 'trabname',
              'label' => 'Trabajador',
            ],
            [
              'attribute' => 'fec_inicio',
              //'format'=>['date', 'php:d-M-Y'],
              //'format'=>['date', 'php:Y-M-d'],
              //'xlFormat'=>'mmm\-dd\, yyyy',  // different date format
              'width'=>'150px',
              'format' => 'raw',
              'filter' => DatePicker::widget([
                  'model' => $searchModel,
                  'attribute' => 'fec_inicio',
                  'language' => 'es',
                  //'options' => ['placeholder' => 'Select issue date ...'],
                  'type' => DatePicker::TYPE_INPUT,
                  'pluginOptions' => [
                    //'format' => 'yyyy/dd/mm',
                    'format' => 'dd-M-yyyy',
                    'format' => 'yyyy-mm-d',
                    'autoClose' => true,
                    'todayHighlight' => true
                  ]
              ]),
            ],
            [
              'attribute' => 'fec_termino',
              //'format'=>['date', 'php:d-M-Y'],
              'xlFormat'=>'mmm\-dd\, yyyy',  // different date format
              'width'=>'150px',
              //'filter' => yii\jui\DatePicker::widget([
              'filter' => DatePicker::widget([
                  'model' => $searchModel,
                  'attribute' => 'fec_termino',
                  'language' => 'es',
                  'type' => DatePicker::TYPE_INPUT,
                  'pluginOptions' => [
                    'format' => 'yyyy-mm-d',
                    'autoClose' => true,
                    'todayHighlight' => true
                  ]
              ]),
            ],
            //'fec_termino',
            //'id',
            //'rh_plaza.nombre',
            //'id_plaza',
            [
              'attribute' => 'id_plaza',
              'header' => 'Plaza',
              'value' => 'plaza.clave',
            ],
            [
                'attribute' => 'clave_tipo',
                //'value' => 'tipo.nombre',
                'label' => 'Motivo',
                'class' => '\kartik\grid\DataColumn',
                'value' => 'tipoCobertura',
                'filter' => Html::activeDropDownList($searchModel, 'clave_tipo', RhAusencia::ListaTiposCobertura(), ['class'=>'form-control','prompt' => 'All'])
            ],


            //'fec_reanuda',
            [
              'attribute' => 'req_cobertura', // atributo del modelo
              'label' => 'Cobertura',
              'class' => '\kartik\grid\DataColumn',
              'value' => 'statusCobertura',   // atributo magico get del modelo
              'filter' => Html::activeDropDownList($searchModel, 'req_cobertura', RhAusencia::ListaStatusCobertura(), ['class'=>'form-control','prompt' => 'All'])
              //'class' => '\kartik\grid\CheckboxColumn',
              //'trueLabel' => 'Si',
              //'falseLabel' => 'No'
            ],
            //'req_cobertura',
            //'docs:ntext',
            //'obs:ntext',

            //['class' => 'yii\grid\ActionColumn'],
            [
              'class' => '\kartik\grid\ActionColumn',
              //'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
            ],
        ],
    ]); ?>
</div>
