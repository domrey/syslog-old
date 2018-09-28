<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimiento */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Terminacion de Movimientos';
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Terminacion';

$ENTER=PHP_EOL;
?>
<h2><?= $this->title ?></h2>
<div class="rh-movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave_trab')->textInput(['readonly'=>'readonly']) ?>

    <?= Html::label('Trabajador:'); ?>

    <?= Html::textInput('nomTrab', $model->claveTrab->getfullname(), ['class'=>'form-control', 'readonly'=>'readonly']); ?>

    <?= $form->field($model, 'clave_plaza')->textInput(['maxlength' => true, 'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'fec_inicio')->textInput(['readonly'=>'readonly']) ?>

  <?php
      $datos='MOVIMIENTO ' . $model->tipo . $ENTER;
      $datos.=$model->descr . $ENTER;
      $datos.=$model->doc_form . ' ' . $model->doc_num . $ENTER;
      $datos.=$model->ref_motivo . $ENTER;
      $datos.= $model->ref_origen;
    ?>
    <?= Html::label('Informacion:'); ?>
    
    <?= Html::textArea('datos', $datos, ['class'=>'form-control', 'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'fec_termino')->textInput() ?>
    <?= $form->field($model, 'term_ant')->hiddenInput(['value'=>'1', 'readonly'=>'readonly'])->label(false) ?>

    <?= $form->field($model, 'term_descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term_motivo')->dropDownList([ 'VENCIMIENTO' => 'VENCIMIENTO', 'RENUNCIA' => 'RENUNCIA', 'CANCELACION' => 'CANCELACION', 'JUBILACION' => 'JUBILACION', 'LEGAL' => 'LEGAL', 'OTRO' => 'OTRO', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
