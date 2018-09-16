<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave_trab')->textInput() ?>

    <?= $form->field($model, 'id_plaza')->textInput() ?>

    <?= $form->field($model, 'id_ausencia')->textInput() ?>

    <?= $form->field($model, 'fec_inicio')->textInput() ?>

    <?= $form->field($model, 'fec_termino')->textInput() ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'doc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ref_motivo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ref_origen')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
