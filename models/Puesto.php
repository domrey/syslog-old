<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syslog.t01_puesto".
 *
 * @property int $clave
 * @property string $descr
 * @property string $nombre
 * @property string $puesto_stps
 * @property int $clave_stps
 * @property int $activo
 * @property int $id_rev
 * @property int $id_reg_cont
 * @property int $nivel
 * @property int $familia
 * @property int $labores
 * @property string $regimen
 * @property string $clasif
 */
class Puesto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'syslog.t01_puesto';
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
            'clave' => 'Clave',
            'descr' => 'Descr',
            'nombre' => 'Nombre',
            'puesto_stps' => 'Puesto Stps',
            'clave_stps' => 'Clave Stps',
            'activo' => 'Activo',
            'id_rev' => 'Id Rev',
            'id_reg_cont' => 'Id Reg Cont',
            'nivel' => 'Nivel',
            'familia' => 'Familia',
            'labores' => 'Labores',
            'regimen' => 'Regimen',
            'clasif' => 'Clasif',
        ];
    }
}
