<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_movimiento".
 *
 * @property int $id
 * @property int $clave_trab
 * @property int $id_plaza
 * @property int $id_ausencia
 * @property string $fec_inicio
 * @property string $fec_termino
 * @property string $tipo_mov
 * @property string $descr
 * @property string $docs
 * @property string $motivo
 * @property string $ref_motivo
 * @property string $ref_origen
 *
 * @property RhTrab $claveTrab
 * @property RhPlaza $plaza
 */
class RhMovimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_movimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave_trab', 'id_plaza', 'fec_inicio', 'fec_termino'], 'required'],
            [['clave_trab', 'id_plaza', 'id_ausencia'], 'integer'],
            [['fec_inicio', 'fec_termino'], 'date'],
            [['tipo_mov', 'descr', 'docs', 'motivo', 'ref_motivo', 'ref_origen'], 'string'],
            [['clave_trab'], 'exist', 'skipOnError' => true, 'targetClass' => RhTrab::className(), 'targetAttribute' => ['clave_trab' => 'clave']],
            [['id_plaza'], 'exist', 'skipOnError' => true, 'targetClass' => RhPlaza::className(), 'targetAttribute' => ['id_plaza' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave_trab' => 'Ficha del Trabajador',
            'id_plaza' => 'Id Plaza',
            'id_ausencia' => 'Id Ausencia',
            'fec_inicio' => 'Fecha Inicio del movimiento',
            'fec_termino' => 'Fecha Termino del movimiento',
            'tipo_mov' => 'Tipo Movimiento',
            'descr' => 'Descripción',
            'docs' => 'Documento(s)',
            'motivo' => 'Motivo',
            'ref_motivo' => 'Ref. Motivo',
            'ref_origen' => 'Ref. Origen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaveTrab()
    {
        return $this->hasOne(RhTrab::className(), ['clave' => 'clave_trab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaza()
    {
        return $this->hasOne(RhPlaza::className(), ['id' => 'id_plaza']);
    }
}
