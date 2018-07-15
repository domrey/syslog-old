<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trab */

$this->title = 'Update Trab: ' . $model->clave;
$this->params['breadcrumbs'][] = ['label' => 'Trabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clave, 'url' => ['view', 'id' => $model->clave]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
