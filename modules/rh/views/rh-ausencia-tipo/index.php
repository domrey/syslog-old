<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhAusenciaTipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Ausencia Tipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-tipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Ausencia Tipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clave',
            'nombre',
            'descr',
            'clave_clase',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
