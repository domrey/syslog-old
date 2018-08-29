<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use modules\rh\RhPlaza;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $this->registerJs("
  $('[data-toggle=\"tooltip\"]').tooltip();
  ", \yii\web\View::POS_READY); ?>

<?php $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
]); ?>
<div class="form-group">
  <?= Html::activeLabel($model, 'clave_trab', ['label'=>'Para el trabajador:', 'class'=>'col-md-2 control-label']) ?>
  <div class="col-md-3">
      <div class="input-group">
        <span class="input-group-addon">
            <?= Html::a('<i class="glyphicon glyphicon-sunglasses"></i>', ['rh-trab/lookup']) ?>
        </span>
        <?= $form->field($model, 'clave_trab', [
          'showLabels' => false,
          ])->textInput(['id'=>'clave_trab', 'placeholder' => 'Ficha', 'data-toggle' => 'tooltip', 'title'=>'Introduzca la ficha del trabajador que se ausenta', 'style'=>'width:70%;']) ?>
      </div>
  </div>

  <div class="col-md-5">
    <?= Html::textInput('nombre_trab', '', ['style'=>'width:100%;', 'class' => 'form-control']) ?>
  </div>
  <div class="col-md-2">
  </div>
</div>


<div class="form-group">
  <?= Html::activeLabel($model_plaza, 'clave', ['label'=>'En Plaza:', 'class'=>'col-md-2 control-label']) ?>
  <div class="col-md-3">
    <?= $form->field($model_plaza, 'clave', [
      'showLabels' => false,
      ])->textInput(['placeholder' => 'Plaza']) ?>
  </div>
  <div class="col-md-1">
      <?= $form->field($model, 'id_plaza')->hiddenInput()->label(false) ?>
  </div>
  <div class="col-md-4">
    <?= Html::textInput('jornada-descanso', '', ['style'=>'width:100%', 'class' => 'form-control']) ?>
  </div>
</div>

<div class="form-group">
  <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia', 'class'=>'col-md-2 control-label']) ?>
    <div class="col-md-2">
        <?= $form->field($model, 'fec_inicio',['showLabels'=>false])->textInput(['placeholder'=>'Del..']); ?>
    </div>
    <div class="col-md-2">
      <?= $form->field($model, 'fec_termino',['showLabels'=>false])->textInput(['placeholder'=>'Al..']); ?>
  </div>
    <?= Html::activeLabel($model, 'fec_reanuda', ['label' => "Reanudando:", 'class' => 'col-md-2 control-label']) ?>
    <div class="col-md-2">
      <?= $form->field($model, 'fec_reanuda', ['showLabels' => false])->textInput(['placeholder'=>'El...']); ?>
    </div>
    <div class="col-md-2">
    </div>
</div>

<div class="form-group">
  <?= Html::activeLabel($model, 'nombre', ['label' => 'Motivo:', 'class' => 'col-md-2 control-label']) ?>
  <div class='col-md-4'>
    <?= $form->field($model, 'clave_tipo', ['showLabels' => false])->textInput(['placeholder' => 'Motivo', 'maxlength' => true]) ?>
  </div>

  <?= Html::activeLabel($model, 'req_cobertura', ['label' => 'Con Cobertura:', 'class' => 'col-md-2 control-label']) ?>
  <div class='col-md-2'>
    <?= $form->field($model, 'req_cobertura',['showLabels' => false])->textInput(['placeholder'=>'Si o No']) ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'clave_tipo')->hiddenInput()->label(false) ?>
  </div>
</div>

<div class="form-group">
    <?= Html::activeLabel($model, 'docs', ['label'=>'Datos Adicionales:', 'class'=>'col-md-2 control-label']) ?>
    <div class="col-md-4">
      <?= $form->field($model, 'docs', ['showLabels'=>false])->textInput(['placeholder'=>'Documento...']) ?>
    </div>
    <div class="col-md-4">
      <?= $form->field($model, 'obs', ['showLabels'=>false])->textarea(['rows' => '2', 'placeholder' => 'Observaciones']) ?>
    </div>
    <div class="col-md-2">
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
    </div>
    <div class="col-md-offset-8 col-md-8">
        <hr>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        &nbsp;&nbsp;
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
