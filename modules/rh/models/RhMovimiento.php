<?php

namespace app\modules\rh\models;

use Yii;

/**
 * This is the model class for table "rh_movimiento".
 *
 * @property int $id
 * @property int $clave_trab
 * @property string $clave_plaza
 * @property int $id_plaza
 * @property int $id_ausencia
 * @property int $id_mov_padre
 * @property string $fec_inicio
 * @property string $fec_termino
 * @property string $descr
 * @property string $doc_num
 * @property string $doc_form
 * @property string $ref_motivo
 * @property string $ref_origen
 * @property string $tipo
 * @property int $term_ant
 * @property string $term_descr
 * @property string $term_motivo
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
            [['clave_trab', 'clave_plaza', 'id_plaza', 'fec_inicio', 'fec_termino'], 'required'],
            [['clave_trab', 'id_plaza', 'id_ausencia', 'id_mov_padre', 'term_ant'], 'integer'],
            [['fec_inicio', 'fec_termino'], 'safe'],
            [['tipo', 'term_motivo'], 'string'],
            [['clave_plaza'], 'string', 'max' => 30],
            [['descr'], 'string', 'max' => 200],
            [['doc_num', 'doc_form'], 'string', 'max' => 20],
            [['ref_motivo', 'ref_origen'], 'string', 'max' => 100],
            [['term_descr'], 'string', 'max' => 255],
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
            'clave_trab' => 'Clave Trab',
            'clave_plaza' => 'Clave Plaza',
            'id_plaza' => 'Id Plaza',
            'id_ausencia' => 'Id Ausencia',
            'id_mov_padre' => 'Id Mov Padre',
            'fec_inicio' => 'Fec Inicio',
            'fec_termino' => 'Fec Termino',
            'descr' => 'Descr',
            'doc_num' => 'Doc Num',
            'doc_form' => 'Doc Form',
            'ref_motivo' => 'Ref Motivo',
            'ref_origen' => 'Ref Origen',
            'tipo' => 'Tipo',
            'term_ant' => 'Term Ant',
            'term_descr' => 'Term Descr',
            'term_motivo' => 'Term Motivo',
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


    /**
    * Obtiene los movimientos de un trabajador especificado
    * @param string $claveTrab - clave del trabajador del cual se quieren los movimientos
    * @return \yii\db\ActiveQuery - Registros de movimientos correspondientes
    */
    public function getRhMovimientosTrab($claveTrab)
    {
      $movimientos = RhMovimiento::find()->with('claveTrab')->where(['clave_trab'=>$claveTrab])
      ->orderBy('fec_inicio DESC')->all();
      if($movimientos===null) {

      }
      else {
        return $movimientos;
      }

    }

    /****
    * Obtiene el movimiento más reciente del TRABAJADOR
    * @param number $claveTrab - Clave del trabajador del cual se quiere el movimiento más reciente
    * @return \modules\model\RhMovimiento - Movimiento solicitado
    */
    public static function UltimoMovimientoTrab($trab)
    {
      $movimiento = RhMovimiento::find()->where(['clave_trab'=>$trab->clave])
      ->andWhere(['>=', 'fec_termino', new Expression('NOW()')])->orderBy('fec_inicio DESC')->one();
      return $movimiento;
    }

}
