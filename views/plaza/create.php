<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Plaza */

$this->title = 'Create Plaza';
$this->params['breadcrumbs'][] = ['label' => 'Plazas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plaza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
