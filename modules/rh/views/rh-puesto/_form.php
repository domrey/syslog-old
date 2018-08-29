<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPuesto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-puesto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave')->textInput() ?>

    <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'puesto_stps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clave_stps')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'id_rev')->textInput() ?>

    <?= $form->field($model, 'id_reg_cont')->textInput() ?>

    <?= $form->field($model, 'nivel')->textInput() ?>

    <?= $form->field($model, 'familia')->textInput() ?>

    <?= $form->field($model, 'labores')->textInput() ?>

    <?= $form->field($model, 'regimen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clasif')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
