<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusenciaClase */

$this->title = 'Create Rh Ausencia Clase';
$this->params['breadcrumbs'][] = ['label' => 'Rh Ausencia Clases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-clase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
