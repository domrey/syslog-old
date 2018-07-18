<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RhDescanso */

$this->title = 'Update Rh Descanso: ' . $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Rh Descansos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clave, 'url' => ['view', 'id' => $model->clave]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rh-descanso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
