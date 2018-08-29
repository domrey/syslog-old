<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhVacancia */

$this->title = 'Create Rh Vacancia';
$this->params['breadcrumbs'][] = ['label' => 'Rh Vacancias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-vacancia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
