<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPuesto */

$this->title = 'Modificar Puesto: ' . $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clave, 'url' => ['view', 'id' => $model->clave]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rh-puesto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
