<?php

namespace app\modules\rh\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use nepstor\validators\DateTimeCompareValidator;

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
 * @property RhAusenciaMotivo $motivo
 */
class RhAusencia extends \yii\db\ActiveRecord
{
    public $fec1;
    public $fec2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh_ausencia';
    }

    public function getInicio()
    {
      return Yii::$app->formatter->asDate($this->fec_inicio);
    }

    public function getTermino()
    {
      return Yii::$app->formatter->asDate($this->fec_termino, Yii::$app->formatter->dateFormat);
    }

    public function getTrabName()
    {
      return $this->trab->nlargo;
    }

    public function getMotivoCobertura()
    {
      return $this->motivo->descr;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave_trab', 'id_plaza', 'clave_plaza', 'id_motivo', 'fec_inicio', 'fec_termino'], 'required', 'message'=>'Dato obligatorio'],
            [['clave_trab', 'id_plaza', 'id_motivo', 'req_cobertura'], 'integer'],
            [['fec_reanuda'], 'default', 'value'=>null],
            [['fec_inicio', 'fec_termino', 'fec_reanuda'], 'safe'],
            //[['fec_inicio', 'fec_termino', 'fec_reanuda'], 'date', 'format'=>'php:d-M-Y', 'locale'=>'es-MX'],
            //['fec_inicio', 'nepstor\validators\DateTimeCompareValidator::className()', 'compareAttribute'=>'fec_termino', 'format'=>'php:d-M-Y', 'operator'=>'>='],
            //[['fec_inicio', 'fec_termino', 'fec_reanuda'], 'date', 'message'=>'Formato inválido'],
            //['fec_inicio', 'date', 'format'=>Yii::$app->formatter->dateFormat, 'timestampAttribute'=>'fec1'],
            //['fec_termino', 'date', 'format'=>Yii::$app->formatter->dateFormat, 'timestampAttribute'=>'fec2'],
            //['fec_inicio', 'compare', 'compareAttribute'=>'fec_termino', 'operator'=>'<=', 'enableClientValidation'=>false],
            ['fec_inicio', 'compare', 'compareValue'=>date('Y-m-d'), 'operator'=>'>=', 'message'=>'Solo fechas recientes'],
            ['fec_termino', 'compare', 'compareAttribute'=>'fec_inicio', 'operator'=>'>=', 'message'=>'Debe ser igual o mayor al inicio'],
            [['doc', 'referencia'], 'string'],
            [['clave_plaza'], 'string', 'max' => 20],
            [['clave_motivo'], 'string', 'max' => 3],
            [['clave_trab'], 'exist', 'skipOnError' => true, 'targetClass' => RhTrab::className(), 'targetAttribute' => ['clave_trab' => 'clave']],
            [['id_plaza'], 'exist', 'skipOnError' => true, 'targetClass' => RhPlaza::className(), 'targetAttribute' => ['id_plaza' => 'id']],
            [['id_motivo'], 'exist', 'skipOnError' => true, 'targetClass' => RhAusenciaMotivo::className(), 'targetAttribute' => ['id_motivo' => 'id']],
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
            'trabName'=>'Nombre del Trabajador',
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
        return $this->hasOne(RhAusenciaMotivo::className(), ['id' => 'id_motivo']);
    }

    public function listaIdsCobertura()
    {
      $data = RhAusenciaMotivo::find()->select(['id AS id', 'CONCAT(descr,"-",clave) AS item'])->orderBy('orden ASC')->asArray()->all();
      $options = ArrayHelper::map($data, 'id', 'item');
      return $options;
    }

    public function ListaMotivosCobertura()
    {
      $data = RhAusenciaMotivo::find()->select(['clave AS clave', 'CONCAT(descr,"-",clave) AS item'])->orderBy('orden ASC')->asArray()->all();
      $options = ArrayHelper::map($data, 'clave', 'item');
      return $options;
    }


    /**
    ** Método estático para regresar un objeto ausencia
    ** para una plaza especificada
    **/
    public static function GetVigenteForPlaza($plaza)
    {
      return RhAusencia::find()
      ->where(['id_plaza'=>$plaza->id])
      ->andWhere(['>=', 'fec_termino', new Expression('NOW()')])
      ->one();
    }


    public static function ListaVigentes()
    {
      // $data = RhAusencia::find()->joinWith('trab')
      // ->select('id as id, rh_ausencia.clave_trab as ficha, rh_trab.ap_pat as trab')
      // ->orderBy('fec_termino DESC')
      // ->asArray()
      // ->all();
      // $options = ArrayHelper::map($data, 'id', 'ficha');
      // return $options;
      $sql = 'SELECT a.id AS id, ';
      $sql .= 'CONCAT(\'F-\', a.clave_trab, \' \', b.nombre,\' \', b.ap_pat, \' \', \' \', c.descr, \' [\', a.clave_plaza, \']\') AS item ';
      // $sql .= 'a.clave_plaza AS Plaza, c.descr AS Motivo, a.descr AS Descr ';
      $sql .= 'FROM rh_ausencia a LEFT JOIN rh_trab b ON a.clave_trab=b.clave ';
      $sql .= 'LEFT JOIN rh_ausencia_motivo c ON a.id_motivo=c.id ';
      $sql .= 'WHERE a.fec_termino >= NOW() ';
      $sql .= 'ORDER BY a.fec_inicio DESC';

      // $data=['results'=>['IdTrab'=>'', 'NombreTrab'=>'', 'FecNac'=>'']];
      // $data['results'] = Yii::$app->db->createCommand($sql)->queryAll();
      $data = Yii::$app->db->createCommand($sql)->queryAll();
      $options=ArrayHelper::map($data, 'id', 'item');
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
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
