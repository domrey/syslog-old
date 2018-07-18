<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_vacancia".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descr
 *
 * @property RhAusenciaClase[] $rhAusenciaClases
 */
class RhVacancia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_vacancia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descr'], 'required'],
            [['nombre'], 'string', 'max' => 15],
            [['descr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descr' => 'Descr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhAusenciaClases()
    {
        return $this->hasMany(RhAusenciaClase::className(), ['id_vacancia' => 'id']);
    }
}
