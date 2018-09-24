<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_ausencia_clase".
 *
 * @property string $clave
 * @property string $nombre
 * @property string $descr
 * @property int $id_vacancia
 *
 * @property RhVacancia $vacancia
 * @property RhAusenciaTipo[] $rhAusenciaTipos
 */
class RhAusenciaClase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_ausencia_clase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'nombre', 'id_vacancia'], 'required'],
            [['id_vacancia'], 'integer'],
            [['clave'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 50],
            [['descr'], 'string', 'max' => 100],
            [['clave'], 'unique'],
            [['id_vacancia'], 'exist', 'skipOnError' => true, 'targetClass' => RhVacancia::className(), 'targetAttribute' => ['id_vacancia' => 'id']],
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
            'descr' => 'Descr',
            'id_vacancia' => 'Id Vacancia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancia()
    {
        return $this->hasOne(RhVacancia::className(), ['id' => 'id_vacancia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhAusenciaTipos()
    {
        return $this->hasMany(RhAusenciaTipo::className(), ['clave_clase' => 'clave']);
    }

    /**
     * {@inheritdoc}
     * @return RhAusenciaClaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhAusenciaClaseQuery(get_called_class());
    }
}
