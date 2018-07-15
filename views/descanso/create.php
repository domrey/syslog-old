<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Descanso */

$this->title = 'Create Descanso';
$this->params['breadcrumbs'][] = ['label' => 'Descansos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="descanso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
