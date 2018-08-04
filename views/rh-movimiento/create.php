<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RhMovimiento */

$this->title = 'Registrar Movimiento';
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-movimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
