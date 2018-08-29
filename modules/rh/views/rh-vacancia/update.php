<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhVacancia */

$this->title = 'Update Rh Vacancia: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rh Vacancias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rh-vacancia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
