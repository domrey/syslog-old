<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use yii\bootstrap\Modal;
use yii\jui\AutoComplete;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhTrabActivo;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\DateControl\Module;
use kartik\datecontrol\DateControl;

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


<?php
  $this->registerJs("
  // register jQuery extension
  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('input:enabled[type!=hidden], [tabindex]');
        //return $(el).is(':input[type!=hidden], :input[type!=readonly], [tabindex]');
        //return $(el).is('a, button, :input, [tabindex]');
    }
  });

  $(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var canfocus = $(':focusable');
        var index = canfocus.index(this) + 1;
        if (index >= canfocus.length) index = 0;
        canfocus.eq(index).focus();
    }
  });

  $('[data-toggle=\"tooltip\"]').tooltip();

  $('#btn_lookup_click').on('click', function(e) {
    console.log('Click');
    $('#popup1').modal('show').find('#popup-content').load($(this).attr('value'));
  });


  // Buscar los datos del trabajador por su ficha
  $('#clave_trab').on('change', function(e) {
    //console.log(e.target.value);
    var url='". Url::to(['rh-trab/get-situacion-trab']) . "';
    //console.log('Url=' + url);
    // Llamar via ajax a una rutina que verifique al Trabajador
    jQuery.ajax(url, {
      'dataType': 'json',
      'method': 'get',
      'success': function (result) {
        if (result.ficha!='') {
          if (result.plaza === '') {
            alert ('Trabajador sin relación laboral actual.');
            $('#info').val('');
            $('#plaza_actual').val('');
            $('#id_plaza').val('');
            $('#nombre_trab').val(result.nombre);
          }
          else {
            $('#id_plaza').val(result.id_plaza);
            $('#nombre_trab').val(result.nombre);
            $('#info').val(result.puesto + '\\r\\n' + 'Clasificación: ' + result.clasif + '\\r\\n' + 'Jornada ' + result.jornada + '\\r\\n' + 'Descanso: ' + result.descanso);
            $('#plaza_actual').val(result.plaza);
          }
        }
      },
      'error': function (e) {
        console.log ('Hubo un error ' + e.status + ' ' + e.responseText);
        if ($('#clave_trab').val()!='') {
          alert ('Este trabajador no está registrado.');
        }
        $('#id_plaza').val('');
        $('#nombre_trab').val('');
        $('#info').val('');
        $('#plaza_actual').val('');
      },
      'cache': false,
      //'data': 'clave_trab=' + e.target.value,
      //'data': jQuery(this).parents('form').serialize(),
      'data': {clave_trab: $('#clave_trab').val()},
    })
  });

  $('#plaza_actual').on('change', function(e) {
    var obj = $(this);
    var val = obj.val();
    var url = '" . Url::to(['rh-plaza/get-id-plaza']) . "';
    if(val==='') {
      $('#id_plaza').val('');
    }
    else {
        jQuery.ajax(url, {
          'dataType': 'json',
          'method': 'get',
          'success': function(result) {
            console.log(result);
            $('#id_plaza').val(result.id);
          },
          'error': function(e) {
            console.log('Error');
            $('#id_plaza').val('');
          },
          'cache': false,
          'data': {clave: val},
        });
    }
  });

  $('#clave_tipo').on('change', function(e) {
    console.log(e.target.value);
    var url='". Url::to(['rh-ausencia-tipo/get-nombre-ausencia']) . "';
    jQuery.ajax(url, {
      'dataType': 'json',
      'method': 'get',
      'success': function(result) {
        console.log(result.nombre);
        $('#tipo_ausencia').val(result.nombre);
      },
      'error': function(e) {
        console.log('Hubo un error!');
      },
      'cache': false,
      'data': {clave_tipo: $('#clave_tipo').val()},
    });
  });
  ", \yii\web\View::POS_READY);
 ?>


<div class="rh-ausencia-form">

    <?php $form = ActiveForm::begin([
      'id'=>'frm_add_ausencia',
      'type' => ActiveForm::TYPE_HORIZONTAL,
      'formConfig' => [
        'deviceSize' => ActiveForm::SIZE_SMALL,
        'showLabels'=>false,
      ],
    ]); ?>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'clave', ['label'=>'Para el trabajador:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
      <div class="input-group">
        <?= $form->field($model, 'clave_trab', [
          'showLabels'=>false,
          'addon'=>[
              'append'=> [
                'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', ['id'=>'btn_lookup_click', 'class'=>'btn btn-default', 'value'=>Url::to(['rh-trab/lookup']), 'tabstop'=>-1]),
                'asButton'=>true,
              ],
          ],
        ])->textInput(['id'=>'clave_trab', 'autofocus'=>'autofocus', 'tabstop'=>1, 'placeholder'=>'Ficha', 'title'=>'Introduzca la ficha', 'data-toggle'=>'tooltip']) ?>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <?= Html::textInput('nombre_trab', '', ['id'=>'nombre_trab', 'tabstop'=>-1, 'style'=>'border: 0px;', 'class'=>'form-control', 'readonly'=>true, 'disabled'=>'disabled']) ?>
      <div class="help-block"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
      &nbsp;
    </div>
    <div class="col-lg-8 col-md-8 col-md-8">
      <?= Html::textArea('info', '', ['id'=>'info', 'tabstop'=>-1, 'readonly'=>true, 'class'=>'form-control', 'rows'=>4, 'disabled'=>'disabled']) ?>
      <div class="help-block"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'clave', ['label'=>'En Plaza:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
      <?= AutoComplete::widget([
        'name'=>'plaza_actual',
        'options'=>['placeholder'=>'En plaza', 'id'=>'plaza_actual', 'class'=>'form-control', 'tabstop'=>2],
        'clientOptions'=>[
          'minLength'=>2,
          'type'=>'get',
          'source'=>Url::to(['rh-plaza/get-clave-plaza']),
          'select'=>'function(event, ui) {
            $("#laPlaza").text(ui.item.value);
          }',
        ],
      ]);
      ?>
      <div class="col-lg-5 col-md-5 col-sm-5">
    <!--  <div class="help-block"></div>  -->
        <?= $form->field($model, 'id_plaza')->hiddenInput(['id'=>'id_plaza']) ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'clave_tipo', ['label' => 'Motivo:', 'class' => 'control-label']) ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
      <?= $form->field($model, 'clave_tipo', ['showLabels'=>false])->textInput(['maxlength' => true, 'id'=>'clave_tipo']) ?>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5">
      <?= Html::textInput('tipo_ausencia', '', ['showLabels'=>false, 'id'=>'tipo_ausencia', 'tabstop'=>-1, 'style'=>'border: 0px;', 'class'=>'form-control', 'readonly'=>true, 'disabled'=>'disabled']) ?>
      <div class="help-block"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= $form->field($model, 'fec_inicio', ['showLabels'=>false])->widget(DateControl::classname(), [
            'ajaxConversion'=>true,
            'type'=>'date',
            'autoWidget'=>true,
            'widgetClass'=>'',
            'displayFormat'=>'php:d-M-Y',
            'saveFormat'=>'php:Y-m-d',
            'saveTimezone'=>'America/Mexico_City',
            'displayTimezone'=>'America/Mexico_City',
            'options'=>[
                'placeholder'=>'Del...',
            ],
            'language'=>'es',
            'widgetOptions'=>[
              'removeButton'=>false,
              'type'=>DatePicker::TYPE_COMPONENT_APPEND,
              'pluginOptions'=> [
                'autoclose'=>true,
                'todayHighlight'=>true,
                'todayBtn'=>false,
                'calendarWeeks'=>true,
                'daysOfWeekHighlighted'=>[0,6],
              ],
            ],
      ]) ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
      <?= Html::label('Al', '') ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= $form->field($model, 'fec_termino', ['showLabels'=>false])->widget(DateControl::classname(), [
            'ajaxConversion'=>true,
            'type'=>'date',
            'autoWidget'=>true,
            'widgetClass'=>'',
            'displayFormat'=>'php:d-M-Y',
            'saveFormat'=>'php:Y-m-d',
            'saveTimezone'=>'America/Mexico_City',
            'displayTimezone'=>'America/Mexico_City',
            'options'=>[
                'placeholder'=>'Al...',
            ],
            'language'=>'es',
            'widgetOptions'=>[
              'removeButton'=>false,
              'type'=>DatePicker::TYPE_COMPONENT_APPEND,
              'pluginOptions'=> [
                'autoclose'=>true,
                'todayHighlight'=>true,
                'todayBtn'=>false,
                'calendarWeeks'=>true,
                'daysOfWeekHighlighted'=>[0,6],
              ],
            ],
      ]) ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
        <?= Html::activeLabel($model, 'fec_reanuda', ['label' => "Reanudando:", 'class' => 'control-label']) ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= $form->field($model, 'fec_reanuda', ['showLabels'=>false])->widget(DateControl::classname(), [
            'ajaxConversion'=>true,
            'type'=>'date',
            'autoWidget'=>true,
            'widgetClass'=>'',
            'displayFormat'=>'php:d-M-Y',
            'saveFormat'=>'php:Y-m-d',
            'saveTimezone'=>'America/Mexico_City',
            'displayTimezone'=>'America/Mexico_City',
            //'saveOptions'=> [
            //  'label'=>'Saved as: ',
            //  'type'=>'text',
            //  'readonly'=>true,
            //  'class'=>'form-control hint-input text-muted',
            //],
            'options'=>[
                'placeholder'=>'El...',
            ],
            'language'=>'es',
            'widgetOptions'=>[
              'removeButton'=>false,
              'type'=>DatePicker::TYPE_COMPONENT_APPEND,
              'pluginOptions'=> [
                'autoclose'=>true,
                'todayHighlight'=>true,
                'todayBtn'=>false,
                'calendarWeeks'=>true,
                'daysOfWeekHighlighted'=>[0,6],
              ],
            ],
      ]) ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= Html::activeLabel($model, 'req_cobertura', ['label' => "Con Cobertura?:", 'class' => 'control-label']) ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">
      <?= $form->field($model, 'req_cobertura')->textInput(['id'=>'req_cobertura', 'tabstop'=>6]) ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'docs', ['label'=>'Documentos:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
      <?= $form->field($model, 'docs')->textarea(['rows' => 1, 'id'=>'docs', 'tabstop'=>7]) ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">&nbsp;</div>
    <div class="col-lg-2 col-md-2 col-sm-2">&nbsp;</div>
    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'obs', ['label'=>'Observaciones:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
      <?= $form->field($model, 'obs')->textarea(['rows' => 2, 'id'=>'obs', 'tabstop'=>8]) ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
    </div>
    <div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-8">
      <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>

</div>
