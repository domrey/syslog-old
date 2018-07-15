<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trab', ['create'], ['class' => 'btn btn-success']) ?>
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
</div>
