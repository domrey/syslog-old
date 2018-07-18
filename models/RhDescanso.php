<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_descanso".
 *
 * @property string $clave Código Descanso
 * @property string $descr Descripción
 * @property int $valor Valor
 * @property string $abrevn Código como Número
 *
 * @property RhPlaza[] $rhPlazas
 */
class RhDescanso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_descanso';
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
            'clave' => 'Código Descanso',
            'descr' => 'Descripción',
            'valor' => 'Valor',
            'abrevn' => 'Código como Número',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhPlazas()
    {
        return $this->hasMany(RhPlaza::className(), ['clave_descanso' => 'clave']);
    }
}
