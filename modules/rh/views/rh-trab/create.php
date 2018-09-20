<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrab */

$this->title = 'Create Rh Trab';
$this->params['breadcrumbs'][] = ['label' => 'Rh Trabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
