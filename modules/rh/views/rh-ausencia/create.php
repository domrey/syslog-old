<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhAusencia */

$this->title = 'Registrar Una Ausencia del personal';
$this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = ['label' => 'Ausencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Registrar';
?>
<div class="rh-ausencia-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
