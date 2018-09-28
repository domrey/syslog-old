<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhMovimiento */
/* @var $form yii\widgets\ActiveForm */

$urlGetSituacionTrab = Url::to(['rh-trab/get-situacion-trab']);

$theScript = <<< JS
  $('#clave_trab').on('change', function() {
    // console.log('Cambio la clave del trabajador!');
    var url= '$urlGetSituacionTrab';
    jQuery.ajax(url, {
       'dataType':'json',
       'method':'get',
       'success': function(result) {
          if (result.Plaza === '') {
              console.log('Si se puede realizar el movimiento (sin relación laboral actual).');
           }
           else {
              if (result.MovVigente) {
                console.log('Necesita terminar la relacion laboral actual');
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
            console.log('Ocurrio un error en get-situacion-trab');
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

    <?= $form->field($model, 'clave_trab')->textInput(['id'=>'clave_trab']) ?>

    <?= $form->field($model, 'clave_plaza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_plaza')->textInput() ?>

    <?= $form->field($model, 'id_ausencia')->textInput() ?>

    <?= $form->field($model, 'id_mov_padre')->textInput() ?>

    <?= $form->field($model, 'fec_inicio')->textInput() ?>

    <?= $form->field($model, 'fec_termino')->textInput() ?>

    <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_form')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_origen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'DEFINITIVO' => 'DEFINITIVO', 'TEMPORAL' => 'TEMPORAL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'term_ant')->textInput() ?>

    <?= $form->field($model, 'term_descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term_motivo')->dropDownList([ 'VENCIMIENTO' => 'VENCIMIENTO', 'RENUNCIA' => 'RENUNCIA', 'CANCELACION' => 'CANCELACION', 'JUBILACION' => 'JUBILACION', 'LEGAL' => 'LEGAL', 'OTRO' => 'OTRO', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
