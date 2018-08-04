<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhTrabSearch */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Fichero';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-list">

    <h1><?= Html::encode($this->title) ?></h1>
   <?= GridView::widget([
        'dataProvider' => $provider,
		'filterModel' => $searchModel
		//'itemView' => '_view',
    ]); ?>
</div>
