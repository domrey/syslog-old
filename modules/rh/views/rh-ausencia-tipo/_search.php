<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusenciaTipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-ausencia-tipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'clave_clase') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
