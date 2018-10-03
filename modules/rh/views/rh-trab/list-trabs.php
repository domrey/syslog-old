<?php

use yii\helpers\Html;
use kartik\grid\GridView;
// use kartik\icons\FontAwesomeAsset;
// FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhTrabSimpleSearch */
/* @var $provider yii\data\ActiveDataProvider */

// $this->title = 'Fichero';
$this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = $this->title;

$panelHeading='<h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i>&nbsp;Listado de Trabajadores</h3>';

$columns=[
  ['class' => 'kartik\grid\SerialColumn'],
  [
    'attribute'=>'clave',
    // 'mergeHeader'=>true,
    'format'=>'raw',
    'label'=>'FICHA',
		'value' => function($model) {
				return Html::a(sprintf('%07d', $model->clave), ['rh-trab/view', 'id'=>$model->clave]);
		},
    'width' => '100px',
    'hAlign'=>GridView::ALIGN_CENTER,
  ],
  [
    'attribute'=>'nlargo',
    'width'=>'400px',
    'label'=>'TRABAJADOR',
    'headerOptions'=>['style'=>'text-align:center'],
  ],
	[
		'attribute' => 'activo',
		'format' => 'raw',
		'value' => function($model)
		{
			if ($model->activo===1)
				return '<span class="label label-success">ACTIVO</span>';
			else
				return '<span class="label label-default">INACTIVO</span>';
		},
    'width'=>'200px',
    'hAlign'=>GridView::ALIGN_CENTER,
	],
];
?>
<div class="rh-trab-list">

  <h1><?= Html::encode($this->title) ?></h1>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'layout' => '{summary}{items}{pager}',
		'showFooter' => false,
    'floatHeader'=>true,
    'hover'=>'true',
		'filterPosition' => GridView::FILTER_POS_BODY,
    // 'bootstrap'=>true,
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    // 'autoXlFormat'=>true,
    // 'rowOptions'=>function($model, $key, $index, $column) {
      // return ['class'=>($model->activo==1 ? 'warning' : 'primary')];
    // },
    'export'=>[
        // 'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_BLANK,
        'header'=>'<li role="presentation" class="dropdown-header">Opciones para exportar la página</li>',
        // 'options'=>['class'=>'btn btn-primary'],
        // 'filename'=>'trabajadores'
        'options'=>[
          'title'=>'Pemex Exploración-Producción',
          'subject'=>'Fichero de trabajadores',
        ],
        'methods'=>[
          'SetHeader'=>['FICHERO DE TRABAJADORES'],
          'SetFooter'=>['PEMEX Depto. Logística Area Altamira | Página {PAGENO} |'],
        ],
    ],
    'panel' => [
        'type' => GridView::TYPE_INFO,
        'heading'=>$panelHeading,
    ],
    'toolbar' => [
      '{export}',
      '{toggleData}',
      'toggleDataContainer' => ['class' => 'btn-group-sm'],
      'exportContainer' => ['class' => 'btn-group-sm']
    ],
		'columns' => $columns,
		//'itemView' => '_view',
    ]);
  ?>
</div>
