<?php
use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'SYSLOG';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Sistema de Información</h1>

        <p class="lead">Servicios Logísticos a la Operación Terrestre</p>

        <p><a class="btn btn-lg btn-success" href="">Ver Dashboard</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h3>Recursos Humanos</h3>

                <p>Acceso a módulos de personal y su rotación, así como plazas, jornadas de trabajo, categorías, etc.</p>

                <p><?= Html::a('Personal', ['rh/default'], ['class' => 'btn btn-primary']); ?></p>

            </div>
            <div class="col-lg-4">
                <h3>Parque Vehicular</h3>

                <p>Gestión de los vehículos pertenecientes al departamento.</p>

                <p><?= Html::a('Vehículos', ['vehiculos/index'], ['class' => 'btn btn-primary']); ?></p>
            </div>
            <div class="col-lg-4">
                <h3>Servicios Logísticos</h3>

                <p>Registro de los servicios realizados con los recursos del departamento.</p>

                <p><?= Html::a('Actividades', ['actividades/index'], ['class' => 'btn btn-primary']); ?></p>
            </div>
            <div class="col-lg-4">
                <h3>Programa Operacional</h3>
                <p>Programa Operacional Anual, metas físicas e informes de actividades.</p>
                <p><?= Html::a('Métricos', ['metricos/index'], ['class' => 'btn btn-primary']); ?></p>
            </div>

            <div class="col-lg-4">
                <h3>Disciplina Operativa</h3>
                <p>Seguimiento a los requerimentos</p>
                <p><?= Html::a('Cumplimiento', ['do/index'], ['class' => 'btn btn-primary']); ?></p>
            </div>
            <div class="col-lg-4">
                <h3>Enlaces rápidos</h3>
                <?= Html::a('Lista de Asistencia', [''], ['class' => 'btn btn-link']); ?>
                <?= Html::a('Fichero', ['rh/rh-trab/list'], ['class' => 'btn btn-link']); ?>
                <?= Html::a('Escalafón', [''], ['class' => 'btn btn-link']); ?>
                <?= Html::a('Cumpleaños', [''], ['class' => 'btn btn-link']); ?>
                <?= Html::a('Orden de Taller', [''], ['class' => 'btn btn-link']); ?>
                <?= Html::a('Pase de Salida', [''], ['class' => 'btn btn-link']); ?>
            </div>
        </div>

    </div>
</div>
