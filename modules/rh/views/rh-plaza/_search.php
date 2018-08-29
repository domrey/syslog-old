<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPlazaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rh-plaza-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'clave_puesto') ?>

    <?php // echo $form->field($model, 'activa') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'depto') ?>

    <?php // echo $form->field($model, 'clave_descanso') ?>

    <?php // echo $form->field($model, 'clave_jornada') ?>

    <?php // echo $form->field($model, 'fec_creacion') ?>

    <?php // echo $form->field($model, 'residencia') ?>

    <?php // echo $form->field($model, 'localidad') ?>

    <?php // echo $form->field($model, 'taller') ?>

    <?php // echo $form->field($model, 'instalacion') ?>

    <?php // echo $form->field($model, 'funcion') ?>

    <?php // echo $form->field($model, 'grupo') ?>

    <?php // echo $form->field($model, 'sirhn') ?>

    <?php // echo $form->field($model, 'posfin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
