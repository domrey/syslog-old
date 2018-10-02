<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhTrabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Trabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Trab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'nombre',
            'ap_pat',
            'ap_mat',
            'ncorto',
            'nlargo',
            //'apodo',
            //'activo',
            //'curp',
            //'rfc',
            //'calle_no',
            //'colonia',
            //'ciudad',
            //'estado',
            //'pais',
            //'nacionalidad',
            //'edo_civil',
            //'sexo',
            //'tel',
            //'email:email',
            //'fec_cat',
            //'fec_depto',
            //'fec_planta',
            //'fec_ingreso',
            //'fec_nac',
            //'reg_cont',
            //'reg_sind',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
