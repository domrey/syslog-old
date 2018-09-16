<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_puesto".
 *
 * @property int $clave Clave de Puesto
 * @property string $descr Descripción del Puesto
 * @property string $nombre Puesto Corto
 * @property string $puesto_stps Puesto según STPS
 * @property int $clave_stps Clave según STPS
 * @property int $activo Activo
 * @property int $id_rev ID de Revisión Contractual
 * @property int $id_reg_cont
 * @property int $nivel Nivel
 * @property int $familia familia
 * @property int $labores Labores
 * @property string $regimen Régimen del Puesto
 * @property string $clasif Clasificación
 *
 * @property RhPlaza[] $rhPlazas
 */
class RhPuesto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_puesto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'id_rev', 'id_reg_cont', 'nivel', 'familia', 'labores', 'regimen', 'clasif'], 'required'],
            [['clave', 'clave_stps', 'activo', 'id_rev', 'id_reg_cont', 'nivel', 'familia', 'labores'], 'integer'],
            [['descr', 'nombre', 'puesto_stps'], 'string', 'max' => 55],
            [['regimen'], 'string', 'max' => 1],
            [['clasif'], 'string', 'max' => 8],
            [['clave'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clave' => 'Clave de Puesto',
            'descr' => 'Descripción del Puesto',
            'nombre' => 'Puesto Corto',
            'puesto_stps' => 'Puesto según STPS',
            'clave_stps' => 'Clave según STPS',
            'activo' => 'Activo',
            'id_rev' => 'ID de Revisión Contractual',
            'id_reg_cont' => 'Id Reg Cont',
            'nivel' => 'Nivel',
            'familia' => 'familia',
            'labores' => 'Labores',
            'regimen' => 'Régimen del Puesto',
            'clasif' => 'Clasificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhPlazas()
    {
        return $this->hasMany(RhPlaza::className(), ['clave_puesto' => 'clave']);
    }

    public function StrPuesto()
    {
        return $this->descr;
    }

    public function StrClasif()
    {
      return $this->clasif;
    }
}
