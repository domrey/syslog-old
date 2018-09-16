<?php

namespace app\modules\rh\models;

use Yii;

public $plaza_trab;
public $nombre_trab;
public $jornada_trab;
public $categoria_trab;
public $descanso_trab;

class RhTrabActivo extends app\modules\rh\models\RhTrab
{
    public function __construct($id_trab)
    {
      // Checar que sea un id válido
      if (isset($id_trab)) {
          
      }
    }


    public function rules()
    {
        return [
            [['clave', 'nombre', 'ap_pat', 'ncorto'], 'required'],
            [['clave', 'activo'], 'integer'],
            [['edo_civil', 'sexo', 'reg_cont', 'reg_sind'], 'string'],
            [['fec_cat', 'fec_depto', 'fec_planta', 'fec_ingreso', 'fec_nac'], 'safe'],
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
            'clave' => 'Ficha',
            'nombre' => 'Nombre del trabajador',
            'ap_pat' => 'Apellido Paterno',
            'ap_mat' => 'Apellido Materno',
            'ncorto' => 'Nombre Corto',
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
            'fec_planta' => 'Fecha Firma Planta',
            'fec_ingreso' => 'Fecha Ingreso',
            'fec_nac' => 'Fecha de Nacimiento',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhMovimientos()
    {
        return $this->hasMany(RhMovimiento::className(), ['clave_trab' => 'clave']);
    }

    public function getFullName()
    {
      return $this->nombre . ' ' . $this->ap_pat . ' ' . $this->ap_mat;
    }


    public function getDisplayClave()
    {
      return 'F-' . $this->clave;
    }


     public function getDisplayName()
     {
       return $this->getDisplayClave() . ' ' . $this->getFullName();
     }
}
