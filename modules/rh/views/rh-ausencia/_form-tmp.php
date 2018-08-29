<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
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

<div class="container">
<?php
  $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
  ]);
?>
<!--
  <div class="row">
    <div class="col-md-1" style="display:grid;">
      Col 1
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 2
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 3
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 4
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 5
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 6
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 7
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 8
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 9
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 10
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 11
    </div>
    <div class="col-md-1" style="display:grid;">
      Col 12
    </div>
  </div>
-->
  <div class="row">
    <div class="col-md-2" style="display:grid;">
        <?= Html::activeLabel($model_trab, 'clave', ['label'=>'Para el trabajador:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-md-2" style="display: grid;">
          <div class="input-group">
            <?= $form->field($model_trab, 'clave', [
              'showLabels' => false,
              'template'=>'{label}{input}{hint}{error}',
              'addon' => [
                'append' => [
                  'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', ['id'=>'btn-lookup-click', 'class'=>'btn btn-default', 'value'=>Url::to(['rh-trab/lookup'])]),
                  'asButton'=>true,
                ]
              ],
            ])->textInput(['id'=>'clave_trab', 'placeholder' => 'Ficha', 'data-toggle' => 'tooltip', 'title'=>'Introduzca la ficha del trabajador que se ausenta', 'style'=>'width:100%;']) ?>
          </div>
      </div>
      <div class="col-md-6" style="display:grid;">
        <?= Html::textInput('nombre_trab', $nombreTrab, ['style'=>'width:100%; border: 0px;', 'class' => 'form-control', 'readonly'=>true]) ?>
      </div>
      <div class="col-md-2" style="display:grid;">
        &nbsp;
      </div>
    </div>

    <div class="row">
      <div class="col-md-2" style="display:grid;">
        <?= Html::activeLabel($model_plaza, 'clave', ['label'=>'En Plaza:', 'class'=>'control-label']) ?>
      </div>
      <div class="col-md-3" style="display:grid;">
       <?= $form->field($model, 'id_plaza', ['showLabels'=>false])->widget(Select2::classname(), [
                'data'=>$plazas,
                'options'=>['showLabels'=>false, 'placeholder'=>'Plaza actual...'],
                'initValueText'=>$plaza_actual,
                'pluginOptions'=> [
                    'allowClear'=>true,
                ],
            ]); ?>
      </div>
      <div class="col-md-5" style="display: grid;">
          <?= Html::textArea('info', $puesto . PHP_EOL . 'JORNADA: ' . $jornada . '    DESCANSO: ' . $descanso, ['class'=>'form-control', 'style'=>'border: 0px;', 'template'=>'{label}{input}{hint}{error}', 'readonly'=>true]) ?>
      </div>
      <div class="col-md-2" style="display:grid;">
      </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
             <hr />
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2" style="display:grid;">
        <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia:', 'class'=>'control-label']) ?>
      </div>

      <div class="col-md-2" style="display:grid;">
          <?= $form->field($model, 'fec_inicio',['showLabels'=>false])->widget(DatePicker::classname(), [
            'options'=>[
              'placeholder'=>'Del...',
              'showLabels'=>false,
              'style'=>'width:100%',
            ],
            'language'=>'es',
            'type'=>3,
            'size'=>'md',
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
        <div class="col-md-2" style="display:grid;">
            <?= $form->field($model, 'fec_termino', ['showLabels'=>false])->widget(DatePicker::classname(), [
            'options'=> [
                'placeholder'=>'Al...',
                'showLabels'=>false,
                'style'=>'width:100%',
            ],
            'language'=>'es',
            'removeButton'=>false,
            'type'=>3,
            'size'=>'md',
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
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-1">
            <?= Html::activeLabel($model, 'fec_reanuda', ['label' => "Reanudando:", 'class' => 'control-label']) ?>
        </div>
        <div class="col-md-2">
        <?= $form->field($model, 'fec_reanuda', ['showLabels'=>false])->widget(DatePicker::classname(), [
        'options'=> [
          'placeholder'=>'El...',
        ],
        'language'=>'es',
        'type'=>3,
        'size'=>'md',
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
    </div>

    <div class="row">
        <div class="col-md-2" style="display:grid;">
            <?= Html::activeLabel($model, 'clave_tipo', ['label' => 'Motivo:', 'class' => 'control-label']) ?>
        </div>
        <div class="col-md-4" style="display:grid;">
<!--            <?= $form->field($model_motivo, 'nombre', ['showLabels' => false])->textInput(['placeholder' => 'Motivo', 'maxlength' => true]) ?> -->
            <?= Html::activeDropDownList($model, 'clave_tipo', $motivos, ['label'=>'Motivo:', 'class'=>'form-control']); ?>
<!--            <?= $form->field($model, 'clave_tipo')->hiddenInput()->label(false) ?> -->
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-1">
            <?= Html::activeLabel($model, 'req_cobertura', ['label' => 'Cobertura?:', 'class' => 'control-label']) ?>
        </div>
        <div class="col-md-2">
             <?= Html::activeDropDownList($model, 'req_cobertura', $status_cobertura, ['class'=>'form-control']); ?>
        </div>
        <div class="col-md-2">
            &nbsp;
        </div>
    </div>

        <div class="form-group">
            <div class="col-md-2" style="display:grid;">
                <?= Html::activeLabel($model, 'docs', ['label'=>'Datos Adicionales:', 'class'=>'control-label']) ?>
            </div>
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
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            &nbsp;&nbsp;
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

  </div>

<?php ActiveForm::end(); ?>
</div>


