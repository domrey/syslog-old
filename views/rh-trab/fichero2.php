<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RhTrabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichero';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-trab-list">

    <h1><?= Html::encode($this->title) ?></h1>
   <?= ListView::widget([
        'dataProvider' => $provider,
        //'itemView' => '_view',
        'itemView' => function($model)
        {
            return '<div class="list-group">
                        <a href="#" class="list-group-item active">
                            <h4 class="list-group-item-heading">' . $model['clave'] . '</h4>
                            <p class="list-group-item-text">' . $model['trab'] . '</p>
                        </a>
                    </div>';
        }
    ]); ?>
</div>
