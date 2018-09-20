<?php

namespace app\modules\rh\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rh_ausencia".
 *
 * @property int $id
 * @property int $clave_trab
 * @property int $id_plaza
 * @property string $clave_plaza
 * @property int $id_motivo
 * @property string $clave_motivo
 * @property string $fec_inicio
 * @property string $fec_termino
 * @property string $fec_reanuda
 * @property int $req_cobertura
 * @property string $doc
 * @property string $obs
 *
 * @property RhTrab $claveTrab
 * @property RhPlaza $plaza
 * @property RhAusenciaTipo $motivo
 */
class RhAusencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_ausencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave_trab', 'id_plaza', 'clave_plaza', 'id_motivo', 'fec_inicio', 'fec_termino'], 'required'],
            [['clave_trab', 'id_plaza', 'id_motivo', 'req_cobertura'], 'integer'],
            [['fec_inicio', 'fec_termino', 'fec_reanuda'], 'safe'],
            [['doc', 'obs'], 'string'],
            [['clave_plaza'], 'string', 'max' => 20],
            [['clave_motivo'], 'string', 'max' => 3],
            [['clave_trab'], 'exist', 'skipOnError' => true, 'targetClass' => RhTrab::className(), 'targetAttribute' => ['clave_trab' => 'clave']],
            [['id_plaza'], 'exist', 'skipOnError' => true, 'targetClass' => RhPlaza::className(), 'targetAttribute' => ['id_plaza' => 'id']],
            [['id_motivo'], 'exist', 'skipOnError' => true, 'targetClass' => RhAusenciaTipo::className(), 'targetAttribute' => ['id_motivo' => 'id']],
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
            'id_plaza' => 'Id Plaza',
            'clave_plaza' => 'Clave Plaza',
            'id_motivo' => 'Id Motivo',
            'clave_motivo' => 'Clave Motivo',
            'fec_inicio' => 'Fec Inicio',
            'fec_termino' => 'Fec Termino',
            'fec_reanuda' => 'Fec Reanuda',
            'req_cobertura' => 'Req Cobertura',
            'doc' => 'Documento',
            'obs' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrab()
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
     * @return \yii\db\ActiveQuery
     */
    public function getMotivo()
    {
        return $this->hasOne(RhAusenciaTipo::className(), ['id' => 'id_motivo']);
    }

    public function listaIdsCobertura()
    {
      $data = RhAusenciaTipo::find()->select(['id AS id', 'CONCAT(descr,"-",clave) AS item'])->orderBy('orden ASC')->asArray()->all();
      $options = ArrayHelper::map($data, 'id', 'item');
      return $options;
    }

    /**
     * {@inheritdoc}
     * @return RhAusenciaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhAusenciaQuery(get_called_class());
    }
}
