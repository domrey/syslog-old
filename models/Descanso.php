<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syslog.t01_descanso".
 *
 * @property string $clave
 * @property string $descr
 * @property int $valor
 * @property string $abrevn
 */
class Descanso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'syslog.t01_descanso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'valor'], 'required'],
            [['valor'], 'integer'],
            [['clave'], 'string', 'max' => 2],
            [['descr'], 'string', 'max' => 45],
            [['abrevn'], 'string', 'max' => 10],
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
            'valor' => 'Valor',
            'abrevn' => 'Abrevn',
        ];
    }
}
