<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-puesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'puesto_stps') ?>

    <?= $form->field($model, 'clave_stps') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'id_rev') ?>

    <?php // echo $form->field($model, 'id_reg_cont') ?>

    <?php // echo $form->field($model, 'nivel') ?>

    <?php // echo $form->field($model, 'familia') ?>

    <?php // echo $form->field($model, 'labores') ?>

    <?php // echo $form->field($model, 'regimen') ?>

    <?php // echo $form->field($model, 'clasif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
