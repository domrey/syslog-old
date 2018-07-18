<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhDescanso */

$this->title = 'Create Rh Descanso';
$this->params['breadcrumbs'][] = ['label' => 'Rh Descansos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-descanso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
