<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhDescansoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Descansos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-descanso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nuevo Descanso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'clave',
            'descr',
            'valor',
            'abrevn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
