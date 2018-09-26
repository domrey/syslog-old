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
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave_trab') ?>

    <?= $form->field($model, 'clave_plaza') ?>

    <?= $form->field($model, 'id_plaza') ?>

    <?= $form->field($model, 'id_ausencia') ?>

    <?php // echo $form->field($model, 'id_mov_padre') ?>

    <?php // echo $form->field($model, 'fec_inicio') ?>

    <?php // echo $form->field($model, 'fec_termino') ?>

    <?php // echo $form->field($model, 'descr') ?>

    <?php // echo $form->field($model, 'doc_num') ?>

    <?php // echo $form->field($model, 'doc_form') ?>

    <?php // echo $form->field($model, 'ref_motivo') ?>

    <?php // echo $form->field($model, 'ref_origen') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'term_ant') ?>

    <?php // echo $form->field($model, 'term_descr') ?>

    <?php // echo $form->field($model, 'term_motivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
