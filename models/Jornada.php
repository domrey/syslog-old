<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syslog.t01_jornada".
 *
 * @property int $clave
 * @property string $descr
 * @property string $clave_texto
 */
class Jornada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'syslog.t01_jornada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'clave_texto'], 'required'],
            [['clave'], 'integer'],
            [['descr'], 'string', 'max' => 20],
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
            'clave' => 'Clave',
            'descr' => 'Descr',
            'clave_texto' => 'Clave Texto',
        ];
    }
}
