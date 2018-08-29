<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-movimiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave_trab') ?>

    <?= $form->field($model, 'id_plaza') ?>

    <?= $form->field($model, 'id_ausencia') ?>

    <?= $form->field($model, 'fec_inicio') ?>

    <?php // echo $form->field($model, 'fec_termino') ?>

    <?php // echo $form->field($model, 'tipo_mov') ?>

    <?php // echo $form->field($model, 'descr') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <?php // echo $form->field($model, 'motivo') ?>

    <?php // echo $form->field($model, 'ref_motivo') ?>

    <?php // echo $form->field($model, 'ref_origen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
