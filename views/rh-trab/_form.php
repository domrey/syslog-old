<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RhTrab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-trab-form">

    <?php $form = ActiveForm::begin([
            'id' => 'create-trab',
            'options' => ['class' => 'form-horizonal'],
        ]); ?>

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

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true, 'value'=>'MEXICO']) ?>

    <?= $form->field($model, 'nacionalidad')->textInput(['maxlength' => true, 'value' => 'MEXICANA']) ?>

    <?= $form->field($model, 'edo_civil')->dropDownList([ 'SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO', 'VIUDO' => 'VIUDO', 'SEPARADO' => 'SEPARADO', 'UNION LIBRE' => 'UNION LIBRE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sexo')->dropDownList([ 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_cat')->widget(\yii\jui\DatePicker::class, [
        'language' => 'es-MX',
        'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

    <?= $form->field($model, 'fec_depto')->widget(\yii\jui\DatePicker::class, [
        'language' => 'es-MX',
        'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

    <?= $form->field($model, 'fec_planta')->widget(\yii\jui\DatePicker::class, [
        'language' => 'es-MX',
        'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

    <?= $form->field($model, 'fec_ingreso')->widget(\yii\jui\DatePicker::class, [
        'language' => 'es-MX',
        'dateFormat' => 'yyyy-MM-dd',
        ]) ?>

<?= $form->field($model, 'fec_nac')->widget(\yii\jui\DatePicker::class, [
    'language' => 'es',
    'dateFormat' => 'yyyy-MM-dd',
    'inline' => false,
]) ?>

    <?= $form->field($model, 'reg_cont')->dropDownList([ 'P' => 'PLANTA', 'T' => 'TRANSITORIO', ], ['value' => 'P', 'prompt' => '']) ?>

    <?= $form->field($model, 'reg_sind')->dropDownList([ 'S' => 'SINDICALIZADO', 'C' => 'CONFIANZA', ], ['value'=>'S', 'prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
