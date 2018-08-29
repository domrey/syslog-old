<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rh\models\RhTrab */

$this->title = 'Dummy Page: ';
$this->params['breadcrumbs'][] = ['label' => 'Dummy', 'url' => ['index']];

?>
<div class="rh-trab-dummy">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_lookup', [
        'model' => $model,
    ]) ?>

</div>
