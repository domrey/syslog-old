<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RhPuesto */

$this->title = $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Rh Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-puesto-view">

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
            'descr',
            'nombre',
            'puesto_stps',
            'clave_stps',
            'activo',
            'id_rev',
            'id_reg_cont',
            'nivel',
            'familia',
            'labores',
            'regimen',
            'clasif',
        ],
    ]) ?>

</div>
