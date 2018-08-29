<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */
/* @var $form yii\widgets\ActiveForm */
?>
<div>
  Trabajador:
  <label>Ficha:</label>
  <label>Nombre:</label>
  <label>En Plaza:</label>
</div>
<div class="rh-ausencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave_trab')->textInput() ?>

    <?= $form->field($model, 'id_plaza')->textInput() ?>

    <?= $form->field($model, 'clave_tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_inicio')->textInput() ?>

    <?= $form->field($model, 'fec_termino')->textInput() ?>

    <?= $form->field($model, 'fec_reanuda')->textInput() ?>

    <?= $form->field($model, 'req_cobertura')->textInput() ?>

    <?= $form->field($model, 'docs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'obs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
