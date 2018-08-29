<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPlaza */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rh Plazas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-plaza-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'clave',
            'descr',
            'tipo',
            'clave_puesto',
            'activa',
            'visible',
            'depto',
            'clave_descanso',
            'clave_jornada',
            'fec_creacion',
            'residencia',
            'localidad',
            'taller',
            'instalacion',
            'funcion',
            'grupo',
            'sirhn',
            'posfin',
        ],
    ]) ?>

</div>
