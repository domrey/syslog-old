<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimiento */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rh Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-movimiento-view">

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
            'clave_trab',
            'id_plaza',
            'clave_plaza',
            'id_ausencia',
            'fec_inicio',
            'fec_termino',
            'descr:ntext',
            'doc:ntext',
            'ref_motivo:ntext',
            'ref_origen:ntext',
        ],
    ]) ?>

</div>
