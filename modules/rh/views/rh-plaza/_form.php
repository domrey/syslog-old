<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPlaza */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-plaza-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'DEFINITIVA' => 'DEFINITIVA', 'TEMPORAL' => 'TEMPORAL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'clave_puesto')->textInput() ?>

    <?= $form->field($model, 'activa')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <?= $form->field($model, 'depto')->textInput() ?>

    <?= $form->field($model, 'clave_descanso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clave_jornada')->textInput() ?>

    <?= $form->field($model, 'fec_creacion')->textInput() ?>

    <?= $form->field($model, 'residencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instalacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grupo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sirhn')->textInput() ?>

    <?= $form->field($model, 'posfin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
