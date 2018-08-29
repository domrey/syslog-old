<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_jornada".
 *
 * @property int $clave Clave de Jornada
 * @property string $descr Descripción
 * @property string $clave_texto Clave como text
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
            'clave' => 'Clave de Jornada',
            'descr' => 'Descripción',
            'clave_texto' => 'Clave como text',
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
      return "J-" . $this->clave_texto;
    }
}
