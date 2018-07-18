<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhPuesto */

$this->title = 'Create Rh Puesto';
$this->params['breadcrumbs'][] = ['label' => 'Rh Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-puesto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
