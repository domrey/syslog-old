<?php
use yii\helpers\Html;

$this->title='RH';
$this->params['breadcumbs'][]=$this->title;
?>

<div class="container">
    <div class="jumbotron">
    <h2>Módulo de Recursos Humanos</h2>
    <p>Operaciones relacionadas con los trabajadores</p>

    <div class="row">
        <div class="col-lg-2">
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
        <div class="col-lg-3">
            <div class="panel panel-info">
            <!-- default panel contents -->
                <div class="panel-heading">Rotación del Personal</div>
                <div class="panel-body">
                    <p><small>Contrataciones, ausencias, ascensos, permisos, etc.</small></p>
                </div>

                <!-- ast group -->
                <div class="list-group">
                    <a href="rh-trab/lookup" class="list-group-item">Dummy</a>
                    <a href="rh-ausencia" class="list-group-item">Ausencias</a>
                    <a href="rh-movimiento" class="list-group-item">Movimientos</a>
                    <a href="#" class="list-group-item">Permisos</a>
                    <a href="#" class="list-group-item">Comisiones</a>
                    <a href="#" class="list-group-item">Iniciación de labores</a>
                </div>

            </div>

        </div>


    </div>

    </div>
</div>
