<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-ausencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave_trab') ?>

    <?= $form->field($model, 'id_plaza') ?>

    <?= $form->field($model, 'clave_plaza') ?>

    <?= $form->field($model, 'id_motivo') ?>

    <?php // echo $form->field($model, 'clave_motivo') ?>

    <?php // echo $form->field($model, 'fec_inicio') ?>

    <?php // echo $form->field($model, 'fec_termino') ?>

    <?php // echo $form->field($model, 'fec_reanuda') ?>

    <?php // echo $form->field($model, 'req_cobertura') ?>

    <?php // echo $form->field($model, 'doc') ?>

    <?php // echo $form->field($model, 'obs') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
