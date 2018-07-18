<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhJornadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jornadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-jornada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nueva Jornada de Trabajo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->clave), ['view', 'id' => $model->clave]);
        },
    ]) ?>
</div>
