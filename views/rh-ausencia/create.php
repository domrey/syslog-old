<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhAusencia */

$this->title = 'Create Rh Ausencia';
$this->params['breadcrumbs'][] = ['label' => 'Rh Ausencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-ausencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
