<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_jornada".
 *
 * @property int $clave
 * @property string $descr
 * @property string $clave_texto
 *
 * @property RhPlaza[] $rhPlazas
 */
class RhJornada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_jornada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'clave_texto'], 'required'],
            [['clave'], 'integer'],
            [['descr'], 'string', 'max' => 40],
            [['clave_texto'], 'string', 'max' => 2],
            [['clave'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clave' => 'CLAVE',
            'descr' => 'DESCRIPCION',
            'clave_texto' => 'CLAVE DE TEXTO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhPlazas()
    {
        return $this->hasMany(RhPlaza::className(), ['clave_jornada' => 'clave']);
    }

    public function StrJornada()
    {
      return $this->clave_texto;
    }
    /**
     * {@inheritdoc}
     * @return RhJornadaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhJornadaQuery(get_called_class());
    }
}
