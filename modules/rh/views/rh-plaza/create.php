<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhPlaza */

$this->title = 'Create Rh Plaza';
$this->params['breadcrumbs'][] = ['label' => 'Rh Plazas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-plaza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
