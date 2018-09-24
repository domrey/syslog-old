<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
use app\modules\rh\models\RhAusencia;

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
$urlGetSituacionTrab = Url::to(['rh-trab/get-situacion-trab']);
$urlGetDatosPlazaPorId = Url::to(['rh-plaza/get-datos-plaza-por-id']);
$urlGetIdPlaza = Url::to(['rh-plaza/get-id-plaza']);

$theScript = <<< JS
  jQuery.extend(jQuery.expr[':'], {
      focusable: function (el, index, selector) {
        return $(el).is('input:enabled[type!=hidden], select, button[type=submit], [tabindex]');
      }
  });

  $(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var canfocus = $(':focusable');
        var index = canfocus.index(this) + 1;
        if (index >= canfocus.length) index = 0;
        console.log('Se enfoca al control no. ' + index);
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
      // infoJson es un registro con los campos: Tipo, Descanso, Jornada, Categoria, Clasificacion, IdPlaza, Plaza,
      // en formato json
      elementText = '<span><strong>';
      elementText += infoJson.Categoria;
      elementText += '</strong></span><br />';
      elementText += '<span>';
      elementText += '<span class="label label-info">' + infoJson.Clasificacion + '</span>&nbsp;&nbsp; '
      elementText += '<span class="badge">J-' + infoJson.Jornada + '</span>&nbsp;&nbsp; ';
      elementText += '<em>' + 'descansa el ' + infoJson.Descanso + '</em>';
      elementText += '</span><br />';
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

    function blankFields()
    {
      $('#infoPlaza').html('');
      $('#nombreTrab').html('');
      $('#clave_plaza').val('');
      $('#id_plaza').val('');
    }

    // Buscar los datos del trabajador por su ficha
   $('#clave_trab').on('change',
    function(e) {
     var url= '$urlGetSituacionTrab';
     jQuery.ajax(url, {
       'dataType':'json',
       'method':'get',
       'success': function(result) {
          if (result.Plaza === '') {
             alert ('Trabajador sin relación laboral actual.');
             blankFields();
           }
           else {
             $('#id_plaza').val(result.IdPlaza);
             $('#nombreTrab').html('<span>'+result.Trabajador+'</span>');
             $('#infoPlaza').html(infoToHtml(result));
             $('#clave_plaza').val(result.Plaza);
           }
        },
       'error': function(e) {
             $('#nombreTrab').html('');
             if ($('#clave_trab').val()!='') {
               alert ('Este trabajador no está registrado.');
             }
             blankFields();
        },
       'cache':false,
       'data':{clave_trab: $('#clave_trab').val()},
     });
    }
  );

  function actualizaDatosPlaza(idPlaza)
  {
    url='$urlGetDatosPlazaPorId';
    $('#id_plaza').val(idPlaza);
    jQuery.ajax(url, {
      'dataType':'json',
      'method':'get',
      'success':function(result) {
        $('#infoPlaza').html(infoToHtml(result));
      },
      'error': function(e) {
        console.log('Error!');
      },
      'cache': false,
      'data':{id:idPlaza},
    });
  }

  $('#clave_plaza').on('change', function(e) {
    var val = $('#clave_plaza').val();
    var url = '$urlGetIdPlaza';
    if (val === '') {
      $('#id_plaza').val('');
    }
    else {
      jQuery.ajax(url, {
        'dataType':'json',
        'method': 'get',
        'success': function(result) {
          actualizaDatosPlaza(result.IdPlaza);
        },
        'error': function(e) {
          $('#id_plaza').val('');
        },
        'data': {plaza: val},
      });
    }
  });

JS;
  $this->registerJs($theScript, \yii\web\View::POS_READY);
 ?>

<div class="rh-ausencia-form">

    <?php $form = ActiveForm::begin([
        'id'=>'frm-ausencia-registrar',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => [
          //'labelSpan' => 3,
          'showLabels'=>false,
          'deviceSize' => ActiveForm::SIZE_SMALL
        ],
    ]); ?>

<div class="form-group" style="margin-bottom: 0">
  <?= Html::activeLabel($model, 'clave_trab', ['label'=>'TRABAJADOR:', 'class'=>'col-sm-2 control-label']) ?>
  <div class="col-lg-2 col-md-2 col-sm-2">
    <?=
      $form->field($model, 'clave_trab', [
        'addon'=>[
            'append'=> [
              'content'=>Html::button('<i class="glyphicon glyphicon-sunglasses"></i>', [
                'id'=>'btn_lookup_click',
                'class'=>'btn btn-default',
                'value'=>Url::to(['rh-trab/lookup']),
                'tabindex'=>-1,
              ]),
              'asButton'=>true,
            ],
            'prepend'=>[
              //'content'=>Html::button('<span>F-</span>', [
              'content'=>'<span class="input-group-text" id="inputGroupPrepend">F-</span>',
              //'asButton'=>true,
            ],
          ],
        ])->textInput([
        'tabindex'=>1,
        'placeholder'=>'Ficha...',
        //'style'=>'width: 100px;',
        'autofocus'=>'autofocus',
        'id'=>'clave_trab',
        'horizontalCssClasses'=> [
          'wrapper' => 'col-lg-2 col-md-2 col-sm-2',
        ],
      ]);
    ?>
  </div>
  <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-6 col-md-6 col-sm-6">
      <div id="nombreTrab" class="text-left text-secondary"></div>
  </div>
</div>

<div class="form-group">
  <?= Html::activeLabel($model, 'clave_plaza', ['label'=>'EN PLAZA:', 'class'=>'col-sm-2 control-label']) ?>
  <div class="col-lg-3 col-md-3 col-sm-3">
    <?= AutoComplete::widget([
        'model'=> $model,
        'attribute'=>'clave_plaza',
        'name'=>'clave_plaza',
        'options'=>[
          'placeholder'=>'Plaza...',
          'id'=>'clave_plaza',
          'class'=>'form-control',
          'style'=>'width: 180px;',
          'tabindex'=>2
        ],
        'clientOptions'=>[
          'minLength'=>3,
          'type'=>'get',
          'source'=>Url::to(['rh-plaza/get-clave-plaza']),
          'select'=> new JsExpression('function(event, ui) {
            console.log("laPlaza vale="+ui.item.value);
          }'),
        ],
      ]);
    ?>
    <?= $form->field($model, 'id_plaza')->hiddenInput([
        'tabindex'=>false,
        'id'=>'id_plaza',
        ])->label(false);
     ?>
  </div>
  <div class="col-lg-7 col-md-7 col-sm-7">
       <div id="infoPlaza" class="text-left text-secondary"></div>
  </div>

</div>
<div class="form-group" style="margin-top: 20px;">
  <?= Html::activeLabel($model, 'id_motivo', ['label'=>'MOTIVO:', 'class'=>'col-sm-2 control-label']) ?>
  <div class="col-lg-3 col-md-3 col-sm-3">
    <?=
      Html::activeDropDownList($model, 'id_motivo', RhAusencia::listaIdsCobertura(), [
        'id'=>'id_motivo',
        'class'=>'form-control',
        'onchange'=>'val=$(this).find("option:selected").text().split("-")[1]; $("#clave_motivo").val(val); ',
         'tabindex'=>3,
         'options'=>[
           'label'=>'MOTIVO:',
           'style'=>'width: 200px;',
         ],
        ]
      );
    ?>
    <?=
     $form->field($model, 'clave_motivo')->hiddenInput([
         'id'=>'clave_motivo',
         'value'=>'???',
         'tabindex'=>false,
     ])->label(false);
      ?>
  </div>
</div>


<div class="form-group" style="margin-bottom:0">
      <?= Html::activeLabel($model, 'fec_inicio', ['label'=>'INICIO:', 'class'=>'col-sm-2 control-label']) ?>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <?=
          $form->field($model, 'fec_inicio')->widget(DateControl::classname(), [
            'options'=>[
                'tabindex'=>4,
                'placeholder'=>'Del...',
                'id'=>'fec_inicio',
             ],
           ])->label('INICIO:');
        ?>
      </div>
</div>

<div class="form-group" style="margin-bottom:0">
    <?= Html::activeLabel($model, 'fec_termino', ['label'=>'TERMINO:', 'class'=>'col-sm-2 control-label']) ?>
    <div class="col-lg-3 col-md-3 col-sm-3">
      <?=
        $form->field($model, 'fec_termino')->widget(DateControl::classname(), [
          'options'=>[
              'tabindex'=>5,
              'placeholder'=>'Al...',
              'id'=>'fec_termino',
           ],
         ])->label('TERMINO:');
      ?>
    </div>
</div>


<div class="form-group">
        <?= Html::activeLabel($model, 'obs', ['label'=>'COMENTARIOS:', 'class'=>'col-sm-2 control-label']) ?>
        <div class="col-lg-3 col-md-3 col-sm-3">
          <?=
          $form->field($model, 'obs')->textarea([
            'rows' => 2,
            'cols'=>40,
            'style'=>'width:100%',
            'tabindex'=>false
            ]
            )->label('COMENTARIOS:');
          ?>
        </div>
</div>

<div class="form-group" style="margin-bottom:0">
    <div class="col-sm-offset-2 col-sm-10">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reestablecer', ['class' => 'btn btn-default']) ?>
    </div>
</div>

  <?php ActiveForm::end(); ?>


</div>
