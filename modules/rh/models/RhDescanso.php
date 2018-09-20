<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_descanso".
 *
 * @property string $clave
 * @property string $descr
 * @property int $valor
 * @property string $abrevn
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
            'clave' => 'DESCANSO',
            'descr' => 'DESCRIPCION',
            'valor' => 'VALOR',
            'abrevn' => 'ABREVIACION',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRhPlazas()
    {
        return $this->hasMany(RhPlaza::className(), ['clave_descanso' => 'clave']);
    }

    public function StrDescanso()
    {
      return $this->descr;
    }

    /**
     * {@inheritdoc}
     * @return RhDescansoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhDescansoQuery(get_called_class());
    }
}
