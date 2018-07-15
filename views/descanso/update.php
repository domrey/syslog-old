<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Descanso */

$this->title = 'Update Descanso: ' . $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Descansos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clave, 'url' => ['view', 'id' => $model->clave]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="descanso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
