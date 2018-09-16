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
 * @property string $clave_plaza
 * @property string $clave_motivo
 * @property int $id_motivo
 * @property string $fec_inicio
 * @property string $fec_termino
 * @property string $fec_reanuda
 * @property int $req_cobertura
 * @property string $doc
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
            [['clave_trab', 'id_plaza', 'id_motivo', 'clave_plaza', 'clave_motivo', 'fec_inicio', 'fec_termino'], 'required', 'message'=>'La {attribute} es un dato obligatorio!'],
            [['clave_trab', 'id_plaza', 'id_motivo', 'req_cobertura'], 'integer'],
            [['fec_inicio', 'fec_termino', 'fec_reanuda'], 'safe'],
            [['doc', 'obs'], 'string'],
            [['clave_motivo'], 'string', 'max' => 3],
            [['id_motivo'], 'exist', 'skipOnError' => true, 'targetClass' => RhAusenciaTipo::className(), 'targetAttribute' => ['id_motivo' => 'id']],
            [['clave_trab'], 'exist', 'skipOnError' => true, 'targetClass' => RhTrab::className(), 'targetAttribute' => ['clave_trab' => 'clave']],
            [['id_plaza'], 'exist', 'skipOnError' => true, 'targetClass' => RhPlaza::className(), 'targetAttribute' => ['id_plaza' => 'id']],
            [['clave_plaza'], 'exist', 'skipOnError' => true, 'targetClass' => RhPlaza::className(), 'targetAttribute' => ['clave_plaza' => 'clave']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave_trab' => 'FICHA DEL TRABJADOR',
            'id_plaza' => 'ID DE PLAZA',
            'clave_plaza' => 'CLAVE DE LA PLAZA',
            'id_motivo' => 'ID MOTIVO AUSENCIA',
            'clave_motivo' => 'MOTIVO DE AUSENCIA',
            'fec_inicio' => 'FECHA DE INICIO',
            'fec_termino' => 'FECHA DE TERMINO',
            'fec_reanuda' => 'FECHA DE REANUDACION',
            'req_cobertura' => 'COBERTURA',
            'doc' => 'INFORMACION DOCUMENTOS',
            'obs' => 'INFORMACION ADICIONAL',
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
        return $this->hasOne(RhAusenciaTipo::className(), ['clave' => 'clave_motivo']);
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
      $data = RhAusenciaTipo::find()->orderBy('orden ASC')->all();
      $options = ArrayHelper::map($data, 'clave', 'descr');
      return $options;

    }


  public function listaIdsCobertura()

    {
      $data = RhAusenciaTipo::find()->select(['id AS id', 'CONCAT(descr,"-",clave) AS item'])->orderBy('orden ASC')->asArray()->all();
      $options = ArrayHelper::map($data, 'id', 'item');
      return $options;

    }
}
