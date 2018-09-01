<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use yii\bootstrap\Modal;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhTrabActivo;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;

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
            $('#info').val(result.puesto + '\\r\\n' + 'Jornada ' + result.jornada + '\\r\\n' + 'Descanso: ' + result.descanso);
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

    <?php $form = ActiveForm::begin(); ?>
    <div class="input-group">
        <?= Html::activeLabel($model, 'clave', ['label'=>'Para el trabajador:', 'class'=>'control-label']) ?>
    <?= $form->field($model, 'clave_trab', [
      'showLabels'=>false,
      'addon'=>[
        'append'=> [
          'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', ['id'=>'btn_lookup_click', 'class'=>'btn btn-default', 'value'=>Url::to(['rh-trab/lookup']), 'tabstop'=>-1]),
          'asButton'=>true,
        ]
      ],
      ])->textInput(['id'=>'clave_trab', 'tabstop'=>1, 'placeholder'=>'Ficha', 'title'=>'Introduzca la ficha', 'data-toggle'=>'tooltip']) ?>
    </div>
    <?= Html::textInput('nombre_trab', '', ['id'=>'nombre_trab', 'tabstop'=>-1, 'style'=>'border: 0px;', 'class'=>'form-control', 'readonly'=>true, 'disabled'=>'disabled']) ?>
    <div class="help-block"></div>
    <?= Html::textArea('info', '', ['id'=>'info', 'tabstop'=>-1, 'readonly'=>true, 'class'=>'form-control', 'rows'=>3, 'disabled'=>'disabled']) ?>
    <div class="help-block"></div>
        <?= Html::activeLabel($model, 'clave', ['label'=>'En Plaza:', 'class'=>'control-label']) ?>
    <?= Html::textInput('plaza', '', ['id'=>'plaza_actual', 'tabstop'=>2, 'class'=>'form-control']) ?>
    <div class="help-block"></div>
    <?= $form->field($model, 'id_plaza')->textInput(['id'=>'id_plaza']) ?>

            <?= Html::activeLabel($model, 'clave_tipo', ['label' => 'Motivo:', 'class' => 'control-label']) ?>
    <?= $form->field($model, 'clave_tipo', ['showLabels'=>false])->textInput(['maxlength' => true, 'id'=>'clave_tipo']) ?>
    <?= Html::textInput('tipo_ausencia', '', ['showLabels'=>false, 'id'=>'tipo_ausencia', 'tabstop'=>-1, 'style'=>'border: 0px;', 'class'=>'form-control', 'readonly'=>true, 'disabled'=>'disabled']) ?>
    <div class="help-block"></div>

        <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia:', 'class'=>'control-label']) ?>
          <?= $form->field($model, 'fec_inicio',['showLabels'=>false])->widget(DatePicker::classname(), [
            'options'=>[
              'placeholder'=>'Del...',
              'showLabels'=>false,
              'style'=>'width:100%',
              'tabstop'=>3,
              'id'=>'fec_inicio',
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

            <?= $form->field($model, 'fec_termino', ['showLabels'=>false])->widget(DatePicker::classname(), [
            'options'=> [
                'placeholder'=>'Al...',
                'showLabels'=>false,
                'style'=>'width:100%',
                'tabstop'=>4,
                'id' => 'fec_termino',
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
            <?= Html::activeLabel($model, 'fec_reanuda', ['label' => "Reanudando:", 'class' => 'control-label']) ?>

        <?= $form->field($model, 'fec_reanuda', ['showLabels'=>false])->widget(DatePicker::classname(), [
        'options'=> [
          'placeholder'=>'El...',
          'tabstop'=>5,
          'id'=>'fec_reanuda',
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

    <?= $form->field($model, 'req_cobertura')->textInput(['id'=>'req_cobertura', 'tabstop'=>6]) ?>

    <?= $form->field($model, 'docs')->textarea(['rows' => 1, 'id'=>'docs', 'tabstop'=>7]) ?>

    <?= $form->field($model, 'obs')->textarea(['rows' => 2, 'id'=>'obs', 'tabstop'=>8]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
