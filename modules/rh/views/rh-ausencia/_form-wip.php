<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
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
        return $(el).is('input:enabled[type!=hidden], select, textarea, [tabindex]');
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

  // Recibe un registro con los datos de una plaza_actual
  // el cual formatea en formato html para mostrarlo
  // en el formulario
  function infoToHtml(infoJson)
  {
    // info es un registro con los campos: Tipo, Descanso, Jornada, Categoria, Clasificacion, IdPlaza, Plaza,
    // en formato json
   elementText='<div class=\'clearfix\'>';
   elementText='<h4 class=\'text-center\'>Categoria:</h4> <h5 class=\'text-center\'>' + infoJson.Categoria+'</h5><br />';
   elementText+='<h4 class=\'text-center\'>Clasificación: </h4><h5 class=\'text-center\'>' + infoJson.Clasificacion + '</h5><br />';
   elementText+='<h4 class=\'text-center\'>Jornada: </h4><h5 class=\'text-center\'>' + infoJson.Jornada + '</h5><br />';
   elementText+='<h4 class=\'text-center\'>Descanso: </h4><h5 class=\'text-center\'>' + infoJson.Descanso+'</h5><br />';
   //elementText='<h5><span class=\'label-default\'>Categoria: </span>' + '<span class=\'text-info\'>'+infoJson.Categoria+'</span></h5><br />';
   //elementText+='<span class=\'text-dark\'>Clasificación: </span>' + '<span class=\'text-info\'>' + infoJson.Clasificacion + '</span><br />';
   //elementText+='<span class=\'text-dark\'>Jornada: </span>' + '<span class=\'text-info\'>' + infoJson.Jornada + '</span><br />';
   //elementText+='<span class=\'text-dark\'>Descanso: </span>' + '<span class=\'text-info\'>' + infoJson.Descanso+'</span><br />';
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
    //console.log(e.target.value);
    var url='". Url::to(['rh-trab/get-situacion-trab']) . "';
    //console.log('Url=' + url);
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
            $('#plaza_actual').val('');
            $('#id_plaza').val('');
          }
          else {
            $('#id_plaza').val(result.IdPlaza);
            $('#nombreTrab').html('<h4 class=\"text-center\">'+result.Trabajador+'</h4>');
            $('#info').html(infoToHtml(result));
            $('#plaza_actual').val(result.Plaza);
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
        $('#plaza_actual').val('');
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

  $('#plaza_actual').on('change blur', function(e) {
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
    'type' => ActiveForm::TYPE_VERTICAL,
    'formConfig' => [
      'deviceSize' => ActiveForm::SIZE_SMALL,
      'showLabels'=>false,
    ],
  ]);
  ?>

<div class="container">

  <div class="row" style="border: 4px solid Black;">
      <div class="col-lg-7 col-md-7 col-sm-7">

        <div class="row" style="border: 2px solid Red; background-color: Lightgray;">

          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'clave_trab', ['label'=>'Trabajador que se ausenta:', 'class'=>'control-label']); ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-5 col-md-5 col-sm-5">
                  <div class="row">
                  <?= $form->field($model, 'clave_trab', [
                    //'template'=>'{label}<div class="row"><div class="col-lg-2 col-md-2">{input}</div><div class="col-lg-5 col-md-5 col-lg-offset-1 col-md-offset-2"><div id="nombreTrab"></div>{error}{hint}</div></div>',
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

          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'plaza_actual', ['label'=>'Plaza en que se ausenta:', 'class'=>'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="row">
                    <?= AutoComplete::widget([
                      'name'=>'plaza_actual',
                      'options'=>[
                        'placeholder'=>'Plaza...',
                        'id'=>'plaza_actual',
                        'class'=>'form-control',
                        'tabstop'=>2
                      ],
                      'clientOptions'=>[
                        'minLength'=>2,
                        'type'=>'get',
                        'source'=>Url::to(['rh-plaza/get-clave-plaza']),
                        'select'=>'function(event, ui) {
                          $("#laPlaza").val(ui.item.value);
                        }',
                      ],
                    ]);
                    ?>
                    <?= $form->field($model, 'id_plaza')->hiddenInput([
                      'id'=>'id_plaza',
                      'placeholder'=>'ID de la ficha',
                      'tabstop'=>-1,
                      ]) ?>
                  </div>
              </div>
            </div>

          </div>


        </div>


        <div class="row" style="border: 2px solid Red; background-color: Lightgray;">

          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'req_cobertura', ['label' => "Especifique si se requiere la cobertura:", 'class' => 'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="row">
                  <?= Html::activeDropDownList($model, 'req_cobertura', RhAusencia::ListaStatusCobertura(), [
                    'class'=>'form-control',
                    'prompt'=>'Cobertura...',
                    'tabstop'=>3] );
                  ?>
                  </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'clave_motivo', ['label' => 'Especifique el motivo de la ausencia:', 'class' => 'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="row">
                    <?= Html::activeDropDownList($model, 'clave_motivo', RhAusencia::ListaTiposCobertura(), [
                      'id'=>'clave_motivo',
                      'class'=>'form-control',
                      'prompt'=>'Motivo...',
                      'tabstop'=>4]);
                    ?>
                </div>
              </div>
            </div>

          </div>


        </div>

        <div class="row" style="border: 2px solid Red; background-color: Lightgray;">

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'Período de Ausencia:', 'class'=>'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    <?= $form->field($model, 'fec_inicio', ['showLabels'=>true])->widget(DateControl::classname(), [
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
                            'tabstop'=>4,
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
                  ]) ?>
                  </div>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
		                <div>&nbsp;</div>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <?= $form->field($model, 'fec_termino', ['showLabels'=>true])->widget(DateControl::classname(), [
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
                            'tabstop'=>5,
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
            </div>

          </div>

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
		                <div>&nbsp;</div>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    <?= $form->field($model, 'fec_reanuda', ['showLabels'=>true])->widget(DatePicker::classname(), [
                        //'ajaxConversion'=>true,
                        'type'=>kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
                        //'type'=>'date',
                        //'autoWidget'=>true,
                        //'widgetClass'=>'',
                        //'displayFormat'=>'php:d-M-Y',
                        //'saveFormat'=>'php:Y-m-d',
                        //'saveTimezone'=>'America/Mexico_City',
                        //'displayTimezone'=>'America/Mexico_City',
                        //'saveOptions'=> [
                        //  'label'=>'Saved as: ',
                        //  'type'=>'text',
                        //  'readonly'=>true,
                        //  'class'=>'form-control hint-input text-muted',
                        //],
                        'options'=>[
                            'placeholder'=>'El...',
                            'tabstop'=>6,
                        ],
                        'language'=>'es',
                        'removeButton'=>false,
                        'convertFormat'=>false,
                        //'daysOfWeekHighlighted'=>[0,6],
                        'pluginOptions'=> [
                          'autoclose'=>true,
                          //'format'=>'yyyy-MM-dd',
                          'todayBtn'=>true,
                          'todayHighlight'=>true,
                        ]
                        //'widgetOptions'=>[
                        //  'removeButton'=>false,
                        //  'type'=>DatePicker::TYPE_COMPONENT_APPEND,
                        //  'pluginOptions'=> [
                        //    'autoclose'=>true,
                        //    'todayHighlight'=>true,
                        //    'todayBtn'=>false,
                        //    'calendarWeeks'=>true,
                        //    'daysOfWeekHighlighted'=>[0,6],
                        //  ],
                        //],
                  ]) ?>
                </div>
              </div>
            </div>

          </div>


        </div>
        <div class="row" style="border: 2px solid Red; background-color: Lightgray;">

          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'docs', ['label'=>'Documento:', 'class'=>'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-10 col-md-10 col-sm-10">
                  <div class="row">
                    <?= $form->field($model, 'docs')->textInput(['id'=>'docs', 'tabstop'=>8, 'placeholder'=>'Docs...']) ?>
                  </div>
              </div>
            </div>

          </div>

          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::activeLabel($model, 'obs', ['label'=>'Observaciones:', 'class'=>'control-label']) ?>
                </div>
              </div>
            </div>

            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <?= $form->field($model, 'obs')->textArea(['id'=>'obs', 'tabstop'=>9, 'placeholder'=>'Notas...']) ?>
                </div>
              </div>
            </div>

          </div>


        </div>


        <div class="row" style="border: 2px solid Red; background-color: Lightgray;">

          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="row" style="border: 1px Solid Blue;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <?= $form->errorSummary($model, ['header'=>'Corrija los errores:']); ?>
                </div>
              </div>
            </div>
          </div>



        </div>




      </div>

      <div class="col-lg-5 col-md-5 col-sm-5">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="row">
                <div  id="nombreTrab" style="border: 1px solid magenta;"></div>
              </div>

              <div class="row">
                <div id="info" style="border:2px solid green"></div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
          </div>
        </div>
        <div class="row">
        </div>
      </div>
  </div>


</div>


  <?php ActiveForm::end(); ?>

</div>
