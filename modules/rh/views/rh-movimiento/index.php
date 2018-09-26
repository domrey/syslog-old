<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\rh\models\RhMovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rh Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rh-movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rh Movimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
      $actionCol = [
          'class'=>'yii\Grid\ActionGrid',
          'header'=>'Operaciones',
          'headerOptions'=>['style'=>'color: #337a7b;'],
          'template'=>'{view}{update}{delete}{terminate}',
          'buttons'=>[
              'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                          ]);
                },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                ]);
              },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'lead-delete'),
                ]);
            }

          ],
          'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url ='index.php?r=client-login/lead-view&id='.$model->id;
                return $url;
            }

            if ($action === 'update') {
                $url ='index.php?r=client-login/lead-update&id='.$model->id;
                return $url;
            }
            if ($action === 'delete') {
                $url ='index.php?r=client-login/lead-delete&id='.$model->id;
                return $url;
            }

          }

        ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clave_trab',
            'clave_plaza',
            'id_plaza',
            // 'id_ausencia',
            //'id_mov_padre',
            'fec_inicio',
            'fec_termino',
            //'descr',
            'doc_form',
            'doc_num',
            //'ref_motivo',
            //'ref_origen',
            //'tipo',
            //'term_ant',
            //'term_descr',
            //'term_motivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
