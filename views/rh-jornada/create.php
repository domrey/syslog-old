<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhJornada */

$this->title = 'Create Rh Jornada';
$this->params['breadcrumbs'][] = ['label' => 'Rh Jornadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-jornada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
