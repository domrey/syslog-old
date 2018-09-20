<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrab */

$this->title = $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Rh Trabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-view">

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
            'ap_pat',
            'ap_mat',
            'ncorto',
            'apodo',
            'activo',
            'curp',
            'rfc',
            'calle_no',
            'colonia',
            'ciudad',
            'estado',
            'pais',
            'nacionalidad',
            'edo_civil',
            'sexo',
            'tel',
            'email:email',
            'fec_cat',
            'fec_depto',
            'fec_planta',
            'fec_ingreso',
            'fec_nac',
            'reg_cont',
            'reg_sind',
        ],
    ]) ?>

</div>
