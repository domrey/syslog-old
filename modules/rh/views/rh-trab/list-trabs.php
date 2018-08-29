<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhTrabSearch */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Fichero';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-list">

    <h1><?= Html::encode($this->title) ?></h1>
   <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'layout' => '{summary}{items}{pager}',
		'showFooter' => false,
		'filterPosition' => GridView::FILTER_POS_BODY,
    'autoXlFormat'=>true,
    'export'=>[
        'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_BLANK
    ],
    'panel' => [
        'type' => 'primary',
        'heading' => 'Listado de Trabajadores'
    ],
		'columns' =>  [
			[ 'class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'clave',
				'format' => 'raw',
				'value' => function($model) {
						return Html::a($model->clave, ['rh-trab/view', 'id'=>$model->clave]);
				}
			],
			'nombre',
			'ap_pat',
			'ap_mat',
			'apodo',
				[
					'attribute' => 'activo',
					'format' => 'raw',
					'value' => function($model)
					{
						if ($model->activo===1)
							return '<span class="label label-success">ACTIVO</span>';
						else
							return '<span class="label label-default">INACTIVO</span>';
					}
				]
		]
		//'itemView' => '_view',
    ]); ?>
</div>
