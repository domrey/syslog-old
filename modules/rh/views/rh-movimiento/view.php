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
            'clave_plaza',
            'id_plaza',
            'id_ausencia',
            'id_mov_padre',
            'fec_inicio',
            'fec_termino',
            'descr',
            'doc_num',
            'doc_form',
            'ref_motivo',
            'ref_origen',
            'tipo',
            'term_ant',
            'term_descr',
            'term_motivo',
        ],
    ]) ?>

</div>
