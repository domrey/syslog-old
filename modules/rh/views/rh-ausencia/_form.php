<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\jui\AutoComplete;
use app\modules\rh\models\RhTrab;
use app\modules\rh\models\RhPlaza;
use app\modules\rh\models\RhTrabActivo;
use app\modules\rh\models\RhAusencia;
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
  $this->registerCss("
    div.required label.control-label:after {
      content: ' *'';
      color: red;
    }
  ");

  $this->registerJs("
  // register jQuery extension
  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('input:enabled[type!=hidden], select, button[type=submit], [tabindex]');
        //return $(el).is('input:enabled[type!=hidden], select, textarea, [tabindex]');
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

  $('#btn_lookup_click').on('click', function(e) {
    console.log('Click');
    $('#popup1').modal('show').find('#popup-content').load($(this).attr('value'));
  });

  // Recibe un registro con los datos de una clave_plaza
  // el cual formatea en formato html para mostrarlo
  // en el formulario
  function infoToHtml(infoJson)
  {
    // info es un registro con los campos: Tipo, Descanso, Jornada, Categoria, Clasificacion, IdPlaza, Plaza,
    // en formato json
   elementText='<div>';
   elementText='<span class=\'text-center text-muted\'>' + infoJson.Categoria+'</span><br />';
   elementText+='<span class=\'text-center text-muted\'>'+ infoJson.Clasificacion + ', ' + 'J-' + infoJson.Jornada + ', descansa el ' + infoJson.Descanso + '</span><br />';
   elementText+='</div>';
   return elementText;
  }

  function infoToText(infoJson)
  {
   elementText='';
   elementText='Categoria: ' + infoJson.Categoria + '\\r\\n';
   elementText+='Clasificación: ' + infoJson.Clasificacion + '\\r\\n';
   elementText+='Jornada: ' + infoJson.Jornada + '\\r\\n';
   elementText+='Descanso: ' + infoJson.Descanso;
   return elementText;
  }

  // Buscar los datos del trabajador por su ficha
  $('#clave_trab').on('change blue', function(e) {
    var url='". Url::to(['rh-trab/get-situacion-trab']) . "';
    // Llamar via ajax a una rutina que verifique al Trabajador
    jQuery.ajax(url, {
      'dataType': 'json',
      'method': 'get',
      'success': function (result) {
        if (result.Ficha!='') {
          if (result.Plaza === '') {
            alert ('Trabajador sin relación laboral actual.');
            $('#info').html('');
            $('#nombreTrab').html('');
            $('#clave_plaza').val('');
            $('#id_plaza').val('');
          }
          else {
            $('#id_plaza').val(result.IdPlaza);
            $('#nombreTrab').html('<span class=\"text-center text-muted\">'+result.Trabajador+'</span>');
            $('#info').html(infoToHtml(result));
            $('#clave_plaza').val(result.Plaza);
          }
        }
      },
      'error': function (e) {
        console.log ('Hubo un error ' + e.status + ' ' + e.responseText);
        $('#nombreTrab').html('Error con este trabajador: ' + e.responseText);
        if ($('#clave_trab').val()!='') {
          alert ('Este trabajador no está registrado.');
        }
        $('#id_plaza').val(0);
        $('#nombre_trab').html('');
        $('#info').html('');
        $('#clave_plaza').val('');
      },
      'cache': false,
      //'data': jQuery(this).parents('form').serialize(),
      'data': {clave_trab: $('#clave_trab').val()},
    })
  });

  function actualizaDatosPlaza(idPlaza)
  {
    url='" . Url::to(['rh-plaza/get-datos-plaza-por-id']) . "';
    jQuery.ajax(url, {
      'dataType': 'json',
      'method': 'get',
      'success': function (r) {
        $('#info').html(infoToHtml(r));
      },
      'error': function(e) {
        console.log('Error!');
      },
      'cache': false,
      'data': {id:idPlaza},
    });
  }

  $('#clave_plaza').on('change blur', function(e) {
    var obj = $(this);
    var val = obj.val();
    var url = '" . Url::to(['rh-plaza/get-id-plaza']) . "';
    //console.log ('Controlador: ' + url);
    if(val==='') {
      $('#id_plaza').val('');
    }
    else {
        jQuery.ajax(url, {
          'dataType': 'json',
          'method': 'get',
          'success': function(result) {
            //console.log(result);
            $('#id_plaza').val(result.IdPlaza);
            // Ahora actualizar el campo Info para la nueva plaza
            actualizaDatosPlaza(result.IdPlaza);
          },
          'error': function(e) {
            console.log('Error: Plaza no válida!');
            $('#id_plaza').val('');
          },
          'cache': false,
          'data': {plaza: val},
        });
    }
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
  ]);
  ?>
<div class="container">


  <div class="row">

    <div class="col-lg-2 col-md-2 col-sm-2">
      <?= Html::activeLabel($model, 'clave_trab', ['label'=>'Trabajador que se ausenta:', 'class'=>'control-label']); ?>
    </div>
    <div class="col-lg-8 col-md-10 col-sm-10">
      <div class="col-lg-12 col-md-12">
          <?= $form->field($model, 'clave_trab', [
            'template'=>'<div class="row"><div class="col-lg-3 col-md-3 col-sm-3">{input}</div><div class="col-lg-offset-1 col-lg-8 col-md-8 col-sm-8"><div id="nombreTrab"></div></div></div><div class="row"><div class="col-lg-12 col-md-12">{error}{hint}</div></div>',
            'addon'=>[
              'append'=> [
                'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', [
                  'id'=>'btn_lookup_click',
                  'class'=>'btn btn-default',
                  'value'=>Url::to(['rh-trab/lookup']),
                  'tabstop'=>-1,
                ]),
                'asButton'=>true,
              ],
            ],
          ])->textInput([
                  'id'=>'clave_trab',
                  'autofocus'=>'autofocus',
                  'tabstop'=>1,
                  'placeholder'=>'Ficha...',
                  'title'=>'Introduzca la ficha del trabajador',
              ]);
          ?>
        </div>
    </div>

  </div>


  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= Html::activeLabel($model, 'clave_plaza', ['label'=>'Plaza en que se ausenta:', 'class'=>'control-label']) ?>
    </div>

    <div class="col-lg-10 col-md-10 col-sm-10">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
          <?= AutoComplete::widget([
            'model'=> $model,
            'attribute'=>'clave_plaza',
            'name'=>'clave_plaza',
            'options'=>[
              'placeholder'=>'Plaza...',
              'id'=>'clave_plaza',
              'class'=>'form-control',
              //'template'=>'<div class="row"><div class="col-lg-4 col-md-4">{input}</div><div class="col-lg-12 col-md-12">{error}{hint}</div></div>',
              'tabstop'=>2
            ],
            'clientOptions'=>[
              'minLength'=>2,
              'type'=>'get',
              'source'=>Url::to(['rh-plaza/get-clave-plaza']),
              'select'=> new JsExpression('function(event, ui) {
                //$("#laPlaza").val(ui.item.value);
                console.log("laPlaza vale="+ui.item.value);
              }'),
            ],
          ]);
          ?>
          <?= $form->field($model, 'id_plaza')->hiddenInput([
              'id'=>'id_plaza',
              'tabstop'=>-1,
            ]) ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div id="info"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
        <?= Html::activeLabel($model, 'clave_motivo', ['label' => 'Especifique el motivo de la ausencia:', 'class' => 'control-label']) ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
          <?= Html::activeDropDownList($model, 'id_motivo', RhAusencia::listaIdsCobertura(), [
            'id'=>'id_motivo',
            'class'=>'form-control',
            'onchange'=>'val=$(this).find("option:selected").text().split("-")[1]; $("#clave_motivo").val(val); console.log(val);',
            'tabstop'=>4]);
          ?>
          <?= $form->field($model, 'clave_motivo')->hiddenInput([
            'id'=>'clave_motivo',
            'value'=>'???',
            'tabstop'=>-1,
            ])
          ?>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
       <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Fecha del inicio de la ausencia:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
          <?= $form->field($model, 'fec_inicio', ['showLabels'=>false])->widget(DateControl::classname(), [
              'ajaxConversion'=>true,
              'language'=>'es',
              'type'=>'date',
              'autoWidget'=>true,
              'widgetClass'=>'',
              'displayFormat'=>'php:d-M-Y',
              'saveFormat'=>'php:Y-m-d',
              'saveTimezone'=>'America/Mexico_City',
              'displayTimezone'=>'America/Mexico_City',
              'options'=>[
                  'tabstop'=>5,
                  'placeholder'=>'Del...',
                  'prompt'=>'Del...',
               ],
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
            ])
          ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2">
         <?= Html::activeLabel($model, 'fec_termino', ['label'=>'Fecha del termino de la ausencia:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">
            <?= $form->field($model, 'fec_termino', ['showLabels'=>false])->widget(DateControl::classname(), [
                'ajaxConversion'=>true,
                'type'=>DateControl::FORMAT_DATE,
                //'type'=>'date',
                'autoWidget'=>true,
                'widgetClass'=>'',
                'displayFormat'=>'php:d-M-Y',
                'saveFormat'=>'php:Y-m-d',
                'saveTimezone'=>'America/Mexico_City',
                'displayTimezone'=>'America/Mexico_City',
                'options'=>[
                    'placeholder'=>'Al...',
                    'tabstop'=>6,
                ],
                'language'=>'es',
                'widgetOptions'=>[
                  'removeButton'=>false,
                  //'mask'=>'99/99/9999',
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
        <?= Html::activeLabel($model, 'obs', ['label'=>'Observaciones:', 'class'=>'control-label']) ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <?= $form->field($model, 'obs')->textArea(['id'=>'obs', 'tabstop'=>8, 'placeholder'=>'Notas...', 'style'=>'width: 100%;']) ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
      <div class="col-lg-10 col-md-10">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'tabstop'=>7]) ?>
      </div>
    </div>
  </div>

</div>

<?php ActiveForm::end(); ?>
