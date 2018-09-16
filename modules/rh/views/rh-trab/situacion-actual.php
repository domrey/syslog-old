<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrab */

//$this->title = 'F-' . $model->clave . ' ' . $model->nombre . ' ' . $model->ap_pat;
$this->title = 'Situaciń Actual del Trabajador';
$this->params['breadcrumbs'][] = ['label' => 'Trabajadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $datos['ficha'];
?>
<div class="rh-trab-view">

    <h3><?= Html::encode($datos['nombre']) ?></h3>
    <p><em>Plaza: </em><?= $datos['plaza'] ?> </p>
    <p><em>Puesto: </em><?= $datos['puesto'] ?> </p>
    <p><em>Jornada: </em><?= $datos['jornada'] ?> </p>
    <p><em>Descanso: </em><?= $datos['descanso'] ?> </p>
</div>
