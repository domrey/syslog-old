<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrabSimpleSearch */
/* @var $dataProvider app\db\
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
  $('[data-toggle=\"tooltip\"]').tooltip();
  ", \yii\web\View::POS_READY); ?>

<?php
Pjax::begin();
?>
<div class="container">
  <?= Html::beginForm(['lookup'], 'get'); ?>
  <div class="form-group">
      <div class="col-md-4">
        <?= Html::textInput('search', '', ['placeholder' => 'Texto de Búsqueda', 'data-toggle' => 'tooltip', 'title'=>'Buscar for ficha, nombre, apellido paterno, apodo, nombre corto', 'class'=>'form-control']); ?>
      </div>
    <?= Html::submitButton('Buscar', ['class' => 'btn btn-default btn-md', 'id'=>'btnBuscar']); ?>
  </div>
  <?= Html::endForm(); ?>
</div>


<div class="container">
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
<?php
Pjax::end();
?>
