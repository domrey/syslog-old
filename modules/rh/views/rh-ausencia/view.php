<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rh Ausencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-view">

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
            'id_motivo',
            'clave_motivo',
            'fec_inicio',
            'fec_termino',
            'fec_reanuda',
            'req_cobertura',
            'doc:ntext',
            'obs:ntext',
        ],
    ]) ?>

</div>
