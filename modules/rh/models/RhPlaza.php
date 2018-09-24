<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_plaza".
 *
 * @property int $id
 * @property string $clave
 * @property string $descr
 * @property string $tipo
 * @property int $clave_puesto
 * @property int $activa
 * @property int $visible
 * @property int $depto
 * @property string $clave_descanso
 * @property int $clave_jornada
 * @property string $fec_creacion
 * @property string $residencia
 * @property string $localidad
 * @property string $taller
 * @property string $instalacion
 * @property string $funcion
 * @property string $actividad
 * @property string $grupo
 * @property int $sirhn
 * @property int $posfin
 * @property int $escalafon
 *
 * @property RhAusencia[] $rhAusencias
 * @property RhMovimiento[] $rhMovimientos
 * @property RhDescanso $claveDescanso
 * @property RhJornada $claveJornada
 * @property RhPuesto $clavePuesto
 */
class RhPlaza extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_plaza';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'clave_puesto', 'clave_descanso', 'clave_jornada'], 'required'],
            [['tipo'], 'string'],
            [['clave_puesto', 'activa', 'visible', 'depto', 'clave_jornada', 'sirhn', 'posfin', 'escalafon'], 'integer'],
            [['fec_creacion'], 'safe'],
            [['clave'], 'string', 'max' => 30],
            [['descr'], 'string', 'max' => 55],
            [['clave_descanso'], 'string', 'max' => 2],
            [['residencia', 'localidad', 'taller', 'instalacion', 'funcion', 'actividad'], 'string', 'max' => 60],
            [['grupo'], 'string', 'max' => 40],
            [['clave_descanso'], 'exist', 'skipOnError' => true, 'targetClass' => RhDescanso::className(), 'targetAttribute' => ['clave_descanso' => 'clave']],
            [['clave_jornada'], 'exist', 'skipOnError' => true, 'targetClass' => RhJornada::className(), 'targetAttribute' => ['clave_jornada' => 'clave']],
            [['clave_puesto'], 'exist', 'skipOnError' => true, 'targetClass' => RhPuesto::className(), 'targetAttribute' => ['clave_puesto' => 'clave']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'descr' => 'Descr',
            'tipo' => 'Tipo',
            'clave_puesto' => 'Clave Puesto',
            'activa' => 'Activa',
            'visible' => 'Visible',
            'depto' => 'Depto',
            'clave_descanso' => 'Clave Descanso',
            'clave_jornada' => 'Clave Jornada',
            'fec_creacion' => 'Fec Creacion',
            'residencia' => 'Residencia',
            'localidad' => 'Localidad',
            'taller' => 'Taller',
            'instalacion' => 'Instalacion',
            'funcion' => 'Funcion',
            'actividad' => 'Actividad',
            'grupo' => 'Grupo',
            'sirhn' => 'Sirhn',
            'posfin' => 'Posfin',
            'escalafon' => 'Escalafon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhAusencias()
    {
        return $this->hasMany(RhAusencia::className(), ['id_plaza' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhMovimientos()
    {
        return $this->hasMany(RhMovimiento::className(), ['id_plaza' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescanso()
    {
        return $this->hasOne(RhDescanso::className(), ['clave' => 'clave_descanso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJornada()
    {
        return $this->hasOne(RhJornada::className(), ['clave' => 'clave_jornada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuesto()
    {
        return $this->hasOne(RhPuesto::className(), ['clave' => 'clave_puesto']);
    }

    /**
     * {@inheritdoc}
     * @return RhPlazaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhPlazaQuery(get_called_class());
    }
}
