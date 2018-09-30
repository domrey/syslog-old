<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use app\modules\rh\models\RhAusencia;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimiento */
/* @var $form yii\widgets\ActiveForm */


/* @var $tiposMov - array con los tipos de movimiento, en params.php */

$urlGetSituacionTrab = Url::to(['rh-trab/get-situacion-trab']);
$urlGetDatosAusencia = Url::to(['rh-ausencia/get-datos-ausencia']);
$urlGetDatosPlazaPorClave = Url::to(['rh-plaza/get-datos-plaza-por-clave']);
$tiposMov=['DEFINITIVO'=>'DEFINITIVO', 'TEMPORAL'=>'TEMPORAL'];

$theScript = <<< JS

  function showSitActual(info)
  {
    $('#saCategoria').html(info.Categoria);
    $('#saPlaza').html(info.Plaza);
    $('#saDel').html(info.MovDesde);
    $('#saAl').html(info.MovHasta);
  }

  $('#clave_plaza').on('change', function() {
    var url='$urlGetDatosPlazaPorClave';
    var clavePlaza = $('#clave_plaza').val();
    jQuery.ajax(url, {
      'dataType':'json',
      'method':'get',
      'success': function(result) {
        if(result.IdPlaza) {
          $('#id_plaza').val(result.IdPlaza);
          console.log(result.IdPlaza);
        }
        else {
          alert('Problemas con esta plaza');
          console.log('Plaza inválida');
        }
      },
      'error': function(e) { console.log('Hubo en error en ' + url); },
      'cache': false,
      'data': {clave:clavePlaza},
    });

  });

  $('#ausencias').on('change', function() {
    var id_ausencia=$('#ausencias').val();
    var url= '$urlGetDatosAusencia';
    // alert(url);
    $('#id_ausencia').val(id_ausencia);
    jQuery.ajax(url, {
      'dataType':'json',
      'method':'get',
      'success': function(result) {
        $('#clave_plaza').val(result.Plaza);
        $('#id_plaza').val(result.IdPlaza);
        $('#fec_inicio').val(result.Desde);
        $('#afec_inicio').val(result.Desde);
        $('#fec_termino').val(result.Hasta);
        $('#afec_termino').val(result.Hasta);
        $('#ref_motivo').val('COBERTURA POR ' + ((result.Referencia) ? result.Referencia : '' + ' ') + result.Trabajador)
        $('#tipo').val('TEMPORAL');
      },
      'error': function(e) {},
      'cache':false,
      'data': {id:id_ausencia},
    });
  });

  $('#clave_trab').on('change', function() {
    // console.log('Cambio la clave del trabajador!');
    var url= '$urlGetSituacionTrab';
    var tipoMov=$('#tipo').val();

    jQuery.ajax(url, {
       'dataType':'json',
       'method':'get',
       'success': function(result) {
          if (result.Plaza === '') {
              console.log('Si se puede realizar el movimiento (sin relación laboral actual).');
           }
           else {
              if (result.MovVigente) {
                showSitActual(result);
                if (tipoMov=='DEFINITIVO') {
                  console.log('Necesita terminar la relacion laboral actual');
                }
                else {
                  //Es la relación laboral vigente un movimiento DEFINITIVO??
                  if (result.TipoMov=='DEFINITIVO') {
                    console.log ('Se puede proceder con el movimiento');
                  }
                  else {
                    console.log('Necesita terminar la relacion laboral actual');
                  }
                }
              }
              else {
                console.log('Si se puede realizar el movimento.')
              }
             // console.log('En plaza: ' + result.Plaza);
             // $('#id_plaza').val(result.IdPlaza);
             // $('#nombreTrab').html('<span>'+result.Trabajador+'</span>');
             // $('#infoPlaza').html(infoToHtml(result));
             // $('#clave_plaza').val(result.Plaza);
           }
        },
       'error': function(e) {
            // console.log('Ocurrio un error en get-situacion-trab');
             if ($('#clave_trab').val()!='') {
               console.log ('Este trabajador no está registrado.');
             }
        },
       'cache':false,
       'data':{clave_trab: $('#clave_trab').val()},
     });
  });
JS;
$this->registerJs($theScript, \yii\web\View::POS_READY);

?>

<div class="rh-movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->dropDownList($tiposMov, ['id'=>'tipo', 'value'=>'TEMPORAL', 'prompt' => '']) ?>
    <?= $form->field($model, 'clave_trab')->textInput(['id'=>'clave_trab']) ?>
    <div id="info">
      <span>SITUACION ACTUAL</span>
      <p>Categoría: <span id="saCategoria"</span></p>
      <p>Plaza: <span id="saPlaza"></span></p>
      <p>Del: <span id="saDel"></span>, Al: <span id="saAl"></span></p>
    </div>

    <?= Html::label('Cubriendo una ausencia:'); ?>
    <?= Html::dropdownList('ausencias', '', RhAusencia::ListaVigentes(), ['id'=>'ausencias', 'class'=>'form-control', 'prompt'=>'Ninguna']); ?>
    <?= $form->field($model, 'clave_plaza')->textInput(['id'=>'clave_plaza', 'maxlength' => true]) ?>
    <?= $form->field($model, 'id_plaza')->textInput(['id'=>'id_plaza'])->label(false); ?>

    <?= $form->field($model, 'id_ausencia')->textInput(['id'=>'id_ausencia'])->label(false); ?>

    <?= $form->field($model, 'id_mov_padre')->textInput() ?>

    <?= $form->field($model, 'fec_inicio')->textInput(['id'=>'fec_inicio']) ?>
    <?= Html::hiddenInput('afec_inicio', '', ['id'=>'afec_inicio','class'=>'form-control']) ?>

    <?= $form->field($model, 'fec_termino')->textInput(['id'=>'fec_termino']) ?>
    <?= Html::hiddenInput('afec_termino', '', ['id'=>'afec_termino', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'descr')->textInput(['id'=>'descr', 'maxlength' => true]) ?>

    <?= $form->field($model, 'doc_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_form')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_motivo')->textInput(['id'=>'ref_motivo', 'maxlength' => true]) ?>

    <?= $form->field($model, 'ref_origen')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
