<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-trab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_pat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_mat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ncorto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apodo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'curp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colonia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nacionalidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edo_civil')->dropDownList([ 'SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO', 'VIUDO' => 'VIUDO', 'SEPARADO' => 'SEPARADO', 'UNION LIBRE' => 'UNION LIBRE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sexo')->dropDownList([ 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_cat')->textInput() ?>

    <?= $form->field($model, 'fec_depto')->textInput() ?>

    <?= $form->field($model, 'fec_planta')->textInput() ?>

    <?= $form->field($model, 'fec_ingreso')->textInput() ?>

    <?= $form->field($model, 'fec_nac')->textInput() ?>

    <?= $form->field($model, 'reg_cont')->dropDownList([ 'P' => 'P', 'T' => 'T', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reg_sind')->dropDownList([ 'S' => 'S', 'C' => 'C', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
