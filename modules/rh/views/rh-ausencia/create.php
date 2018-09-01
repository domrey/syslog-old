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

    <?= $this->render('_form-wip', [
        'model' => $model,
    ]) ?>

</div>
