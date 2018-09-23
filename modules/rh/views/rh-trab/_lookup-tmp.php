<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrabSimpleSearch */
/* @var $dataProvider app\db\
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
  $('document').on('pjax:complete', function(e) {
    console.log('pjax completado');
  });
  // $('[data-toggle=\"tooltip\"]').tooltip();
  $('#popup1').on('shown.bs.modal', function() {
    setTimeout(function() {
      $('#search').focus();
    }, 10);
  });
  $('#btnBuscar').click(function(e) {
    var lookfor=$('#search').val();
    if (lookfor.length>0) {
      var form=$('#lookform');
      var formdata=form.serialize();
      var pjaxcontainer=$('#pjax-container');
      $.pjax.reload({container: '#pjax-container', url:''});
    }
  });
  $('#search').on('keyup', function(e) {
    //e.preventDefault();
    var lookfor=$('#search').val();
    var minchars=0;
    //$.pjax.reload({container: '#pjax-container'});
    if (isNaN(lookfor)) {
      minchars=2;
    }
    else {
      minchars=5;
    }
    if (lookfor.length>=minchars) {
      var form=$('#lookform');
      var formdata=form.serialize();
      var formdata={search:lookfor};
      var pjaxcontainer=$('#pjax-container');
      var url='" . Url::to(['rh-trab/lookup']) . "'+'?search='+lookfor;
      $.ajax ( {
        type: 'GET',
        url: url,
        data: formdata,
        dataType: 'html',
        success: function (result) {
          pjaxcontainer.html(result);
          $('#search').val('').focus().val(lookfor);
        },
      });
    }
  });

  function updateControl(el, value, popup)
  {
    el.val(value);
    el.trigger('change');
    popup.modal('hide');
    el.focus();
  }
  ", \yii\web\View::POS_READY); ?>
<?php
Pjax::begin(['id'=>'pjax-container', 'enablePushState'=>false]);
?>
  <div class="container">
  <?= Html::beginForm(['rh-trab/lookup'], 'get', ['data-pjax'=>true]); ?>
  <div class="form-group">
      <div class="col-md-4">
        <?= Html::textInput('search', Yii::$app->request->get('search'), ['placeholder' => 'Texto de Búsqueda',  'title'=>'Buscar for ficha, nombre, apellido paterno, apodo, nombre corto', 'class'=>'form-control', 'id'=>'search']) ?>
      </div>
    <?= Html::submitButton('Buscar', ['class' => 'btn btn-default btn-md', 'id'=>'btnBuscar']); ?>
  </div>
  <?= Html::endForm(); ?>
<!--</div>
-->

<div id="container">
    <div class="col-md-5">
      <?php
      if (isset($dataProvider)) {
      ?>
      <?= ListView::widget([
           'dataProvider' => $dataProvider,
           'layout' => '{items}{summary}{pager}',
           'summary' => 'Se encontraron {totalCount} coincidencias',
           //'itemView' => '_view',
           'itemView' => function($model)
           {
               return '<div class="list-group">
<!--                           <a href="' . url::to(['rh-ausencia/create', 'id'=>$model['clave']])  . '" class="list-group-item">  -->
<!--                           <a href="javascript:void(0);" onclick="$(\'#clave_trab\').val(\'' . $model['clave'] . '\'); $(\'#clave_trab\').trigger(\'change\'); $(\'#clave_trab\').focus(); $(\'#popup1\').modal(\'hide\');" class="list-group-item"> -->
                                <a href="javascript:void(0);" onclick="updateControl($(\'#clave_trab\'), \'' . $model['clave'] . '\', $(\'#popup1\'));" class="list-group-item">
                               <span class="list-group-item-heading"><strong>' . $model['clave'] . '</strong></span>&nbsp;' .
                               '<span class="list-group-item-text">' . $model['fullName'] . '</span>' .
                           '</a>
                       </div>';
           }
       ]); ?>
     <?php
     }
      ?>
    </div>
  </div>
</div>
</div>
<?php
Pjax::end();
?>
