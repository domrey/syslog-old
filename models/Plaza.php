<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syslog.t01_plaza".
 *
 * @property string $clave
 * @property string $descr
 * @property string $tipo
 * @property int $clave_puesto
 * @property int $activa
 * @property int $depto
 * @property string $clave_descanso
 * @property int $clave_jornada
 * @property string $fec_creacion
 * @property string $residencia
 * @property string $localidad
 * @property string $taller
 * @property string $instalacion
 * @property string $funcion
 * @property string $grupo
 * @property int $sirhn
 * @property int $posfin
 */
class Plaza extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'syslog.t01_plaza';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'tipo', 'clave_puesto', 'clave_descanso', 'clave_jornada'], 'required'],
            [['tipo'], 'string'],
            [['clave_puesto', 'activa', 'depto', 'clave_jornada', 'sirhn', 'posfin'], 'integer'],
            [['fec_creacion'], 'safe'],
            [['clave'], 'string', 'max' => 25],
            [['descr'], 'string', 'max' => 55],
            [['clave_descanso'], 'string', 'max' => 2],
            [['residencia', 'localidad', 'taller', 'instalacion', 'funcion'], 'string', 'max' => 60],
            [['grupo'], 'string', 'max' => 40],
            [['clave'], 'unique'],
            [['clave_descanso'], 'exist', 'skipOnError' => true, 'targetClass' => Descanso::className(), 'targetAttribute' => ['clave_descanso' => 'clave']],
            [['clave_jornada'], 'exist', 'skipOnError' => true, 'targetClass' => Jornada::className(), 'targetAttribute' => ['clave_jornada' => 'clave']],
            [['clave_puesto'], 'exist', 'skipOnError' => true, 'targetClass' => Puesto::className(), 'targetAttribute' => ['clave_puesto' => 'clave']],
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
            'tipo' => 'Tipo',
            'clave_puesto' => 'Clave Puesto',
            'activa' => 'Activa',
            'depto' => 'Depto',
            'clave_descanso' => 'Clave Descanso',
            'clave_jornada' => 'Clave Jornada',
            'fec_creacion' => 'Fec Creacion',
            'residencia' => 'Residencia',
            'localidad' => 'Localidad',
            'taller' => 'Taller',
            'instalacion' => 'Instalacion',
            'funcion' => 'Funcion',
            'grupo' => 'Grupo',
            'sirhn' => 'Sirhn',
            'posfin' => 'Posfin',
        ];
    }
}
