<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_trab".
 *
 * @property int $clave
 * @property string $nombre
 * @property string $ap_pat
 * @property string $ap_mat
 * @property string $ncorto
 * @property string $apodo
 * @property int $activo
 * @property string $curp
 * @property string $rfc
 * @property string $calle_no
 * @property string $colonia
 * @property string $ciudad
 * @property string $estado
 * @property string $pais
 * @property string $nacionalidad
 * @property string $edo_civil
 * @property string $sexo
 * @property string $tel
 * @property string $email
 * @property string $fec_cat
 * @property string $fec_depto
 * @property string $fec_planta
 * @property string $fec_ingreso
 * @property string $fec_nac
 * @property string $reg_cont
 * @property string $reg_sind
 *
 * @property RhAusencia[] $rhAusencias
 * @property RhMovimiento[] $rhMovimientos
 */
class RhTrab extends \yii\db\ActiveRecord
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
            'clave' => 'Clave',
            'nombre' => 'Nombre',
            'ap_pat' => 'Ap. Paterno',
            'ap_mat' => 'Ap, Materno',
            'ncorto' => 'Nombre Corto',
            'apodo' => 'Apodo',
            'nlargo'=> 'Nombre Completo',
            'activo' => 'Activo',
            'curp' => 'CURP',
            'rfc' => 'RFC',
            'calle_no' => 'Calle No',
            'colonia' => 'Colonia',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
            'pais' => 'Pais',
            'nacionalidad' => 'Nacionalidad',
            'edo_civil' => 'Edo. Civil',
            'sexo' => 'Sexo',
            'tel' => 'Tel.',
            'email' => 'Email',
            'fec_cat' => 'Fec. Categoria',
            'fec_depto' => 'Fec. Depto',
            'fec_planta' => 'Fec. Planta',
            'fec_ingreso' => 'Fec. Ingreso',
            'fec_nac' => 'Fec. Nacimiento',
            'reg_cont' => 'Reg. Cont',
            'reg_sind' => 'Reg. Sind',
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

    /**
     * {@inheritdoc}
     * @return RhTrabQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhTrabQuery(get_called_class());
    }

    /**
    * Regresa el nombre completo del TRABAJADOR
    * @return string el nombre + ape pat + ape mat
    */
    public function getFullName()
    {
      return $this->nombre . ' ' . $this->ap_pat . ' ' . $this->ap_mat;
    }

    public function getNlargo()
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
