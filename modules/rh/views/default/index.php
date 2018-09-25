<?php
use yii\helpers\Html;
use app\modules\rh\models\RhTrabSearch;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;

// $this->params['breadcrumbs'][] = ['label' => 'Recursos Humanos', 'url' => ['/rh/default']];
$this->params['breadcrumbs'][] = 'Recursos Humanos';
?>

<div class="site-index">


    <div class="container">

      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Catálogos</div>
            <div class="panel-body">
                <p>&nbsp;<small>Tablas del sistema <hr /> Sólo administradores</small></p>
                <div class="list-group">
                  <a href="rh-trab" class="list-group-item">Trabajadores</a>
                  <a href="rh-plaza" class="list-group-item">Plazas</a>
                  <a href="rh-jornada" class="list-group-item">Jornadas</a>
                  <a href="rh-descanso" class="list-group-item">Descansos</a>
                  <a href="rh-puesto" class="list-group-item">Categorías</a>
                </div>
            </div>
          </div>
        </div>

        <div class="col-lg-9 col-md- col-sm-6">
            <h2>Módulo de Recursos Humanos<br />
            <small>Operaciones relacionadas con la rotación y movimientos del personal</small>
            </h2>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="row">
                <h3><?= Html::a('Ausencias', ['rh-ausencia/index']) ?></h3>
                <h4><?= Html::a('Comisiones', ['rh-movimiento/index']) ?></h4>
                <h4><?= Html::a('Vacaciones', ['rh-movimiento/index']) ?></h4>
                <h4><?= Html::a('Permisos', ['rh-movimiento/index']) ?></h4>
                <h3><?= Html::a('Movimientos', ['rh-movimiento/index']) ?></h3>
                <h3><?= Html::a('Iniciacion de labores', ['rh-movimiento/index']) ?></h3>
                <h3><?= Html::a('Lista de Asistencia', ['rh-movimiento/index']) ?></h3>
                <h3><?= Html::a('Reporte de Ausencias', ['rh-movimiento/index']) ?></h3>
                <hr />
                <h4><?= Html::a('Fichero', ['rh-trab/list']) ?></h4>
                <h4><?= Html::a('Cumpleaños', ['rh-movimiento/index']) ?></h4>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              Aquí van unas estadísticas<br />
              Y otros datos
            </div>
        </div>
      </div>


    </div>

</div>
