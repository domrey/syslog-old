<?php

namespace app\modules\rh\models;

use Yii;
use app\modules\rh\models\RhAusenciaTipo;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "rh_ausencia".
 *
 * @property int $id
 * @property int $clave_trab
 * @property int $id_plaza
 * @property string $clave_tipo
 * @property string $fec_inicio
 * @property string $fec_termino
 * @property string $fec_reanuda
 * @property int $req_cobertura
 * @property string $docs
 * @property string $obs
 *
 * @property RhAusenciaTipo $claveTipo
 * @property RhTrab $claveTrab
 * @property RhPlaza $plaza
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
            [['clave_trab', 'id_plaza', 'clave_tipo', 'fec_inicio', 'fec_termino'], 'required'],
            [['clave_trab', 'id_plaza', 'req_cobertura'], 'integer'],
            [['fec_inicio', 'fec_termino', 'fec_reanuda'], 'safe'],
            [['docs', 'obs'], 'string'],
            [['clave_tipo'], 'string', 'max' => 3],
            [['clave_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => RhAusenciaTipo::className(), 'targetAttribute' => ['clave_tipo' => 'clave']],
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
            'id_plaza' => 'Id Plaza',
            'clave_tipo' => 'Clave Tipo',
            'fec_inicio' => 'Fec Inicio',
            'fec_termino' => 'Fec Termino',
            'fec_reanuda' => 'Fec Reanuda',
            'req_cobertura' => 'Req Cobertura',
            'docs' => 'Docs',
            'obs' => 'Obs',
        ];
    }

/**
  ** A continuación una serie de métodos auxiliares para el despliegue del modelo en pantalla
*/
    public function getStatusCobertura()
    {
      switch($this->req_cobertura) {
        case 1:
          return 'Con Cobertura';
          break;
        case 0:
          return 'Sin Cobertura';
          break;
        default:
          return 'Indefinida';
          break;
      }
    }

    public static function ListaStatusCobertura()
    {
      return [
        '0' => 'Sin Cobertura',
        '1' => 'Con Cobertura',
      ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(RhAusenciaTipo::className(), ['clave' => 'clave_tipo']);
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


    public function getTrabName()
    {
      return $this->trab->getFullName();
    }

    public function getTipoCobertura()
    {
      return $this->tipo->getNombreTipoAusencia();
    }

    public function ListaTiposCobertura()
    {
      $data = RhAusenciaTipo::find()->orderBy('descr ASC')->all();
      $options = ArrayHelper::map($data, 'clave', 'descr');
      return $options;

    }
}
