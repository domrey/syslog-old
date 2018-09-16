<?php

namespace app\modules\rh\models;

use Yii;
use yii\db\Expression;
//use app\modules\models\RhTrab;
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
 * @property string $doc
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
            [['fec_inicio', 'fec_termino'], 'safe'],
            [['descr', 'doc', 'ref_motivo', 'ref_origen'], 'string'],
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
            'clave_trab' => 'CLAVE DE TRABAJADOR',
            'id_plaza' => 'ID DE PLAZA',
            'clave_plaza' => 'CLAVE DE PLAZA',
            'id_ausencia' => 'ID DE AUSENCIA',
            'fec_inicio' => 'FECHA INICIO',
            'fec_termino' => 'FECHA TERMINO',
            'descr' => 'DESCRIPCION',
            'doc' => 'DOCUMENTO',
            'ref_motivo' => 'REF. MOTIVO',
            'ref_origen' => 'REF. ORIGEN',
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
  * Obtiene los movimientos de un trabajador determinado
  * @param string $claveTrab - Clave del trabajador del cual se quieren los RhMovimientos
  * @return \yii\db\ActiveQuery - Registros de movimientos correspondientes
  */
      public function getMovimientosTrab($claveTrab)
      {
        $movimientos = RhMovimiento::find()->with('claveTrab')->where(['clave_trab'=>$claveTrab])
          ->orderBy('fec_inicio DESC')->all();
        if ($movimientos === null) {

        }
        else {
          return $movimientos;
        }
      }

  /****
  * Obtiene el movimiento más reciente del Trabajador
  * @param number $claveTrab - Clave del trabajador dle cual se quiere el Movimiento más reciente
  * @return \modules\model\RhMovimiento - Movimiento más reciente
  ****/
  public static function UltimoMovimientoTrab($trab)
  {
    $movimiento = RhMovimiento::find()->where(['clave_trab'=>$trab->clave])
      ->andWhere(['>=', 'fec_termino', new Expression('NOW()')])->orderBy('fec_inicio DESC')->one();
      return $movimiento;
  }

}
