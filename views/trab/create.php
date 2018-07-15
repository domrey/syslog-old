<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Trab */

$this->title = 'Create Trab';
$this->params['breadcrumbs'][] = ['label' => 'Trabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
