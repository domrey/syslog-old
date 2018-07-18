<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_trab".
 *
 * @property int $clave Ficha del trabajador
 * @property string $nombre Nombre del trabajador
 * @property string $ap_pat Apellido Paterno
 * @property string $ap_mat Apellido Materno
 * @property string $ncorto Nombre corto
 * @property string $apodo Sobrenombre
 * @property int $activo Activo
 * @property string $curp Clave Unica de Registro de Poblacion
 * @property string $rfc Registro Federal de Causantes
 * @property string $calle_no Calle y núm.
 * @property string $colonia Colonia
 * @property string $ciudad Ciudad/Municipio
 * @property string $estado Entidad Federativa
 * @property string $pais País
 * @property string $nacionalidad Nacionalidad
 * @property string $edo_civil Estado Civil
 * @property string $sexo Género
 * @property string $tel Teléfono(s)
 * @property string $email Correo electrónico
 * @property string $fec_cat Fecha firma en puesto actual
 * @property string $fec_depto Fecha adscripción al depto
 * @property string $fec_planta Fecha firma planta
 * @property string $fec_ingreso Fecha ingreso
 * @property string $fec_nac Fecha de nacimiento
 * @property string $reg_cont Régimen Contractual
 * @property string $reg_sind Régimen Sindical
 *
 * @property RhAusencia[] $rhAusencias
 */
class Trab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_trab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'nombre', 'ap_pat'], 'required'],
            [['clave', 'activo'], 'integer'],
            [['edo_civil', 'sexo', 'reg_cont', 'reg_sind'], 'string'],
            [['fec_cat', 'fec_depto', 'fec_planta', 'fec_ingreso'], 'safe'],
            [['fec_nac'], 'default', 'value'=>null],
            [['nombre', 'ap_pat', 'ap_mat'], 'string', 'max' => 40],
            [['ncorto', 'email'], 'string', 'max' => 80],
            [['apodo', 'calle_no', 'colonia'], 'string', 'max' => 35],
            [['curp'], 'string', 'max' => 18],
            [['rfc'], 'string', 'max' => 15],
            [['ciudad', 'estado', 'pais', 'nacionalidad', 'tel'], 'string', 'max' => 25],
            [['clave'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clave' => 'Ficha del trabajador',
            'nombre' => 'Nombre del trabajador',
            'ap_pat' => 'Apellido Paterno',
            'ap_mat' => 'Apellido Materno',
            'ncorto' => 'Nombre corto',
            'apodo' => 'Sobrenombre',
            'activo' => 'Activo',
            'curp' => 'Clave Unica de Registro de Poblacion',
            'rfc' => 'Registro Federal de Causantes',
            'calle_no' => 'Calle y núm.',
            'colonia' => 'Colonia',
            'ciudad' => 'Ciudad/Municipio',
            'estado' => 'Entidad Federativa',
            'pais' => 'País',
            'nacionalidad' => 'Nacionalidad',
            'edo_civil' => 'Estado Civil',
            'sexo' => 'Género',
            'tel' => 'Teléfono(s)',
            'email' => 'Correo electrónico',
            'fec_cat' => 'Fecha firma en puesto actual',
            'fec_depto' => 'Fecha adscripción al depto',
            'fec_planta' => 'Fecha firma planta',
            'fec_ingreso' => 'Fecha ingreso',
            'fec_nac' => 'Fecha de nacimiento',
            'reg_cont' => 'Régimen Contractual',
            'reg_sind' => 'Régimen Sindical',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhAusencias()
    {
        return $this->hasMany(RhAusencia::className(), ['clave_trab' => 'clave']);
    }
}
