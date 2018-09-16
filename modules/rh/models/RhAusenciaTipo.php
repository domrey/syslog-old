<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_ausencia_tipo".
 *
 * @property int $id
 * @property string $clave
 * @property string $nombre
 * @property string $descr
 * @property string $clave_clase
 * @property int $orden
 *
 * @property RhAusencia[] $rhAusencias
 * @property RhAusenciaClase $claveClase
 */
class RhAusenciaTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_ausencia_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'nombre', 'descr', 'clave_clase'], 'required'],
            [['orden'], 'integer'],
            [['clave'], 'string', 'max' => 3],
            [['nombre'], 'string', 'max' => 50],
            [['descr'], 'string', 'max' => 100],
            [['clave_clase'], 'string', 'max' => 2],
            [['clave_clase'], 'exist', 'skipOnError' => true, 'targetClass' => RhAusenciaClase::className(), 'targetAttribute' => ['clave_clase' => 'clave']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'CLAVE',
            'nombre' => 'NOMBRE',
            'descr' => 'DESCRIPCION',
            'orden' => 'ORDEN',
            'clave_clase' => 'CLAVE CLASE',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhAusencias()
    {
        return $this->hasMany(RhAusencia::className(), ['clave_tipo' => 'clave']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaveClase()
    {
        return $this->hasOne(RhAusenciaClase::className(), ['clave' => 'clave_clase']);
    }

    public function getNombreTipoAusencia()
    {
      return $this->nombre;
    }

    public static function ListaTiposAusencias()
    {
      $data = RhAusenciaTipo::find()->orderBy('orden ASC')->all();
      $options = ArrayHelper::map($data, 'clave', 'descr');
      return $options;

    }

}
