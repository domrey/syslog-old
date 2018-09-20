<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-trab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'ap_pat') ?>

    <?= $form->field($model, 'ap_mat') ?>

    <?= $form->field($model, 'ncorto') ?>

    <?php // echo $form->field($model, 'apodo') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'curp') ?>

    <?php // echo $form->field($model, 'rfc') ?>

    <?php // echo $form->field($model, 'calle_no') ?>

    <?php // echo $form->field($model, 'colonia') ?>

    <?php // echo $form->field($model, 'ciudad') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'pais') ?>

    <?php // echo $form->field($model, 'nacionalidad') ?>

    <?php // echo $form->field($model, 'edo_civil') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fec_cat') ?>

    <?php // echo $form->field($model, 'fec_depto') ?>

    <?php // echo $form->field($model, 'fec_planta') ?>

    <?php // echo $form->field($model, 'fec_ingreso') ?>

    <?php // echo $form->field($model, 'fec_nac') ?>

    <?php // echo $form->field($model, 'reg_cont') ?>

    <?php // echo $form->field($model, 'reg_sind') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
