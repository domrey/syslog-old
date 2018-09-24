<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */

$this->title = 'Modificar Ausencia <kbd>' . $model->id . '</kbd>';
$this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = ['label' => 'Ausencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="rh-ausencia-update">

    <h3><?= $this->title ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
