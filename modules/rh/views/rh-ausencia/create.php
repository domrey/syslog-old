<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */

$this->title = 'Registrar Ausencia';
$this->params['breadcrumbs'][] = ['label' => 'Ausencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-tmp', [
        'model' => $model,
        'model_trab'=>$model_trab,
        'model_plaza' => $model_plaza,
        'model_motivo' => $model_motivo,
        //'jornada_descanso' => $jornada_descanso,
        'puesto' => $puesto,
        'jornada' => $jornada,
        'descanso' => $descanso,
        'nombreTrab' => $nombreTrab,
        'motivos' => $motivos,
        'status_cobertura'=>$status_cobertura,
        'plazas'=>$plazas,
        'plaza_actual'=>$plaza_actual,
    ]) ?>

</div>
