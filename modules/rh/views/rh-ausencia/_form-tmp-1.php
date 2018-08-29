<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
//use kartik\dialog\Dialog;
use yii\bootstrap\Modal;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhTrab;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
  Modal::begin([
    //'header'=>'<h4>Localizar trabajador...</h4>',
    'header'=>null,
    'id' => 'popup1',
    'size'=>'modal-md',
  ]);
  echo "<div id='popup-content'></div>";
  Modal::end();
?>

<?php $this->registerJs("
  $('[data-toggle=\"tooltip\"]').tooltip();
  $('#btn-lookup-click').click(function(e) {
    $('#popup1').modal('show').find('#popup-content').load($(this).attr('value'));

  });
  ", \yii\web\View::POS_READY); ?>

<?php $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
]); ?>
<div class="form-group">
  <?= Html::activeLabel($model_trab, 'clave', ['label'=>'Para el trabajador:', 'class'=>'col-md-2 control-label']) ?>
  <div class="col-md-3">
      <div class="input-group">
        <?= $form->field($model_trab, 'clave', [
          'showLabels' => false,
          'template'=>'{label}{input}{hint}{error}',
          'addon' => [
            'append' => [
              //'content'=>'' . Html::a('<i class="glyphicon glyphicon-sunglasses"></i>', ['rh-trab/lookup'])
              'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', ['id'=>'btn-lookup-click', 'class'=>'btn btn-default', 'value'=>Url::to(['rh-trab/lookup'])]),
              'asButton'=>true,
            ]
          ],
        ])->textInput(['id'=>'clave_trab', 'placeholder' => 'Ficha', 'data-toggle' => 'tooltip', 'title'=>'Introduzca la ficha del trabajador que se ausenta', 'style'=>'width:100%;']) ?>
      </div>
  </div>

  <div class="col-md-5">
    <?= Html::textInput('nombre_trab', $nombreTrab, ['style'=>'width:100%;', 'class' => 'form-control', 'disabled'=>'disabled']) ?>
<!--    <?= $form->field($model_trab, 'fullName', ['showLabels'=>false])->textInput(['style'=>'width:100%;', 'class' => 'form-control']) ?>
-->
  </div>
  <div class="col-md-2">
  </div>
</div>


<div class="form-group">
  <?= Html::activeLabel($model_plaza, 'clave', ['label'=>'En Plaza:', 'class'=>'col-md-2 control-label']) ?>
  <div class="col-md-3">
    <?= AutoComplete::widget ([
      'model' => $model_plaza,
      'attribute' => 'clave',
      'options' => ['class'=>'form-control', 'style'=>'width: 100%;', 'template'=>'{label}{input}{hint}{error}'],
      'clientOptions' => [
        'minLength' => '3',
        'type' => 'get',
        'source' => Url::to(['rh-plaza/get-clave-plaza']),
        'select' => 'function event(event, ui) {
          $("#id_plaza").text(ui.item.valor);
        }',
      ],
    ]) ?>
  </div>
  <div class="col-md-1">
    <?= $form->field($model, 'id_plaza', ['showLabels'=>false])->hiddenInput() ?>
  </div>

  <div class="col-md-4">
    <?= Html::textInput('info', $puesto . ' ' . $jornada . ' ' . $descanso, ['style'=>'width:100%', 'class' => 'form-control', 'readonly' => true]) ?>
    <!--
    <?= $form->field($model_plaza, 'clave_jornada', ['showLabels'=>false])->textInput(['style'=>'width:30%; display:inline;', 'class'=>'form-control']) ?>&nbsp;
    <?= $form->field($model_plaza, 'clave_descanso', ['showLabels'=>false])->textInput(['style'=>'width:30%; display:inline;', 'class'=>'form-control']) ?>
  -->
  </div>
</div>

<div class="form-group">
    <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia', 'class'=>'col-md-2 control-label']) ?>
    <div class="col-md-2">
      <?= $form->field($model, 'fec_inicio')->label(false)->widget(DatePicker::classname(), [
        'options'=>[
          'placeholder'=>'Del...',
          'showLabels'=>false,
        ],
        'language'=>'es',
        'removeButton' => false,
        'pluginOptions'=> [
          'autoclose'=>true,
          'format'=>'dd/mm/yyyy',
          'todayHighlight'=>true,
          'todayBtn'=>false,
          'calendarWeeks'=>true,
          'daysOfWeekHighlighted'=>[0,6],
          //'daysOfWeekDisabled'=>[0,6],
        ]
      ]) ?>
    </div>
    <div class="col-md-2">
      <?= $form->field($model, 'fec_termino', ['showLabels'=>false])->widget(DatePicker::classname(), [
        'options'=> [
          'placeholder'=>'Al...',
        ],
        'language'=>'es',
        'removeButton'=>false,
        'pluginOptions'=>[
          'autoclose'=>true,
          'format'=>'dd/mm/yyyy',
          'todayHighlight'=>true,
          'todayBtn'=>false,
          'calendarWeeks'=>true,
          'daysOfWeekHighlighted'=>[0,6],
        ]
      ]) ?>
  </div>
    <?= Html::activeLabel($model, 'fec_reanuda', ['label' => "Reanudando:", 'class' => 'col-md-2 control-label']) ?>
    <div class="col-md-2">
      <?= $form->field($model, 'fec_reanuda', ['showLabels'=>false])->widget(DatePicker::classname(), [
        'options'=> [
          'placeholder'=>'Al...',
        ],
        'language'=>'es',
        'removeButton'=>false,
        'pluginOptions'=>[
          'autoclose'=>true,
          'format'=>'dd/mm/yyyy',
          'todayHighlight'=>true,
          'todayBtn'=>true,
          'calendarWeeks'=>true,
          'daysOfWeekHighlighted'=>[0,6],
        ]
      ]) ?>
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
