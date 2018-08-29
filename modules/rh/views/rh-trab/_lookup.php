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
  //$('[data-toggle=\"tooltip\"]').tooltip();

  $('#btnBuscar').click(function(e) {
    var lookfor=$('#search').val();
    if (lookfor.length>0) {
      var minchars=0;
      var form=$('#lookform');
      var formdata=form.serialize();
      var pjaxcontainer=$('#pjax-container');
      var url='" . Url::to(['rh-trab/lookup']) . "';
      $.ajax ( {
        type: 'GET',
        url: url,
        data: formdata,
        dataType: 'html',
        success: function (result) {
          pjaxcontainer.html(result);
        },
      });
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
      //alert ('Los datos son: ' + formdata.search);
      var pjaxcontainer=$('#pjax-container');
      var url='" . Url::to(['rh-trab/lookup']) . "'+'?search='+lookfor;
      //alert ('Url='+url);
      $.ajax ( {
        type: 'GET',
        url: url,
        data: formdata,
        dataType: 'html',
        success: function (result) {
          pjaxcontainer.html(result);
        },
      });
      $('#search').focus();
    }
  });
  ", \yii\web\View::POS_READY); ?>
<?php
Pjax::begin(['id'=>'pjax-container']);
?>
  <div class="container">
  <?= Html::beginForm(['rh-trab/lookup'], 'get', ['data-pjax'=>true]); ?>
  <div class="form-group">
      <div class="col-md-4">
        <?= Html::textInput('search', Yii::$app->request->get('search'), ['placeholder' => 'Texto de Búsqueda', 'data-toggle' => 'tooltip', 'title'=>'Buscar for ficha, nombre, apellido paterno, apodo, nombre corto', 'class'=>'form-control', 'id'=>'search']); ?>
      </div>
    <?= Html::submitButton('Buscar', ['class' => 'btn btn-default btn-md', 'id'=>'btnBuscar']); ?>
  </div>
  <?= Html::endForm(); ?>
<!--</div>
-->

<div id="container">
    <div class="col-md-5">
      <?= ListView::widget([
           'dataProvider' => $dataProvider,
           'layout' => '{items}{summary}{pager}',
           'summary' => 'Se encontraron {totalCount} coincidencias',
           //'itemView' => '_view',
           'itemView' => function($model)
           {
               return '<div class="list-group">
                           <a href="#" class="list-group-item">
                               <span class="list-group-item-heading"><strong>' . $model['clave'] . '</strong></span>&nbsp;' .
                               '<span class="list-group-item-text">' . $model['fullName'] . '</span>' .
                           '</a>
                       </div>';
           }
       ]); ?>
    </div>
  </div>
</div>
</div>
<?php
Pjax::end();
?>
