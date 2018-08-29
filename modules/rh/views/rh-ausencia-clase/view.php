<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusenciaClase */

$this->title = $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Rh Ausencia Clases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-clase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->clave], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->clave], [
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
            'clave',
            'nombre',
            'descr',
            'id_vacancia',
        ],
    ]) ?>

</div>
