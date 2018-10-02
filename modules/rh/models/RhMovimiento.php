<?php

namespace app\modules\rh\models;
use yii\web\JsExpression;
use yii\db\Expression;
use Yii;

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

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

  const SCENARIO_REGISTRAR = 'registrar';

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
            [['clave_plaza'], 'validatePlaza', 'on'=>RhMovimiento::SCENARIO_REGISTRAR],
            [['clave_trab', 'clave_plaza', 'id_plaza', 'fec_inicio', 'fec_termino'], 'required'],
            [['clave_trab', 'id_plaza', 'id_ausencia', 'id_mov_padre', 'term_ant'], 'integer'],
            [['fec_inicio', 'fec_termino'], 'safe'],
            [['tipo', 'term_motivo'], 'string'],
            [['tipo'], 'in', 'range'=>['DEFINITIVO', 'TEMPORAL']],
            [['clave_plaza'], 'string', 'max' => 30],
            [['descr'], 'string', 'max' => 200],
            [['doc_num', 'doc_form'], 'string', 'max' => 20],
            [['ref_motivo', 'ref_origen'], 'string', 'max' => 100],
            [['term_descr'], 'string', 'max' => 255],
            [['doc_num', 'doc_form', 'descr', 'id_mov_padre', 'id_ausencia'], 'default', 'value'=>NULL],
            ['term_ant', 'default', 'value'=>0],
            [['ref_motivo', 'ref_origen', 'term_descr', 'term_motivo'], 'default', 'value'=>NULL],
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

    public function getTrabName()
    {
        return $this->claveTrab->getFullName();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaza()
    {
        return $this->hasOne(RhPlaza::className(), ['id' => 'id_plaza']);
    }

    /***
    ** método estático
    ** devuelve un objeto RhMovimiento, dado un id de movimiento
    **
    **/

    public static function GetVigenteForPlaza($plaza)
    {
      return RhMovimiento::find()
      ->where(['id_plaza'=>$plaza->id])
      ->andWhere(['>=', 'fec_termino', new Expression('NOW()')])
      ->orderBy('fec_inicio DESC')
      ->one();
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

    /****
    ** Validar el campo plaza en la creacion de un nuevo movimiento
    **
    ***/
    public function validatePlaza($attribute, $param)
    {
      if (!$this->hasErrors()) {
        $plaza = $this->plaza; // Esta es la plaza del movimiento que se está registrando
        // $this->console_log($plaza);
        if (!$plaza || !$plaza->activa || ($plaza->clave != $this->$attribute)) {
          $this->addError($attribute, 'Esta plaza es incorrecta o no se encuentra ACTIVA!');
        }
        else {
          // $this->addError('id_plaza', 'Plaza válida ' .$plaza->id);
          // Plaza válida, checar que si está ocupada y hasta cuando
          $vigente=RhMovimiento::GetVigenteForPlaza($plaza);
          // $this->addError('id_plaza', '$vigente->id = ' .$vigente->id);
          if ($vigente) {
            // La plaza tiene un movimiento vigente,
            // Determinar si esta plaza se haya actualmente en una ausencia
            // $this->addError('id_plaza', 'Plaza tiene un movimiento vigente: ' .$vigente->id);
            $posibleAusencia = RhAusencia::GetVigenteForPlaza($plaza);

            // $this->addError('id_plaza', 'Posible ausencia de la plaza: ' . (($posibleAusencia)?$posibleAusencia->id:'(no hay posibles ausencias)'));
            if ($posibleAusencia) {
              // $this->addError('id_plaza', 'Plaza tiene un movimiento vigente: ' .$vigente->id);
              // Si hay una ausencia de esa plaza, checar la vigencia
              if ($this->fec_inicio >= $posibleAusencia->fec_inicio &&
                  $this->fec_termino <= $posibleAusencia->fec_termino) {
                    //todo ok si se puede registrar el movmiento
                    $this->ref_origen=$posibleAusencia->referencia;
              }
              else {
                  // no es posible regitrar el movimiento, no coinciden los rangos de fechas
                  $this->addError('fec_inicio', 'Debe ajustar el periodo del movimiento al de la ausencia en la plaza que desea realizar el movimiento.');
              }
            }
            else {
              // $this->addError('id_plaza', 'Plaza no tiene una ausencia: ');
              // la plaza solicitada no está en una ausencia
              // ¿el trabajador que ocupa actualmente la plaza se haya en otro movimiento en el período?
              $trabMovimiento = RhMovimiento::UltimoMovimientoTrab($vigente->claveTrab);
              // $this->addError('id_plaza', 'Checando si el trabajador '. $vigente->id . ' tiene un movimiento vigente');
              if (!$trabMovimiento) {
                // no tiene un movimiento el Trabajador
                // no se puede realizar el nuevo movimiento
                // $this->addError('clave_plaza', 'Plaza ocupada. No es posible registrar otro movimiento en la misma!.');
                $this->addError('clave_plaza', 'Error al intentar ubicar al trabajador que ocupa actualmente la plaza.');
              }
              else { // verificar si el trabajador obtenido aquí tiene otro movimiento vigente
                // Comparar las plazas, deben ser diferentes para que sea otro movimiento
                if ($trabMovimiento->id_plaza != $this->id_plaza) {
                  // Si es un movimiento diferente
                    // $this->addError('id_plaza', 'Trabajador ' . $trabMovimiento->clave_trab . ' si tiene un movimiento vigente, verificar fechas...');
                    // coinciden los periodos del movimiento del trabajador con el del nuevo movimiento?
                    // $this->addError('id_plaza', 'Comparar fechas: ' . $this->fec_inicio . ' con ' . $trabMovimiento->fec_inicio . '. Y ' . ' movimiento id=' . $trabMovimiento->id);
                    if ($this->fec_inicio >= $trabMovimiento->fec_inicio &&
                        $this->fec_termino<=$trabMovimiento->fec_termino) {
                          // si es posible registrar el movimiento
                          $this->id_mov_padre=$trabMovimiento->id;
                          $this->ref_origen=$trabMovimiento->ref_origen;
                        }
                    else {
                          $this->addError('clave_plaza', 'Debe ajustar las fechas para que coincidan con el movimiento del trabajador.');
                    }
                }
                else {
                  // No es un movimiento diferente, la plaza está ocupada entonces
                  // y no procede el movimiento requerido
                  $this->addError('id_plaza', 'Plaza ocupada - no es posible registrar el movimiento.');
                }
              }
            }
          }
          else {
            // la plaza no está ocupada actualmente, seguramente por una terminación anticipada (renuncia)
            // O la vigencia de la misma venció
            // si se puede registrar el nuevo movimiento
            $this->id_mov_padre=NULL;
            // buscar la terminación más reciente de este movimiento, y asignar el motivo
            // a la referencia del nuevo movimiento
            // $this->addError('clave_plaza', 'Plaza libre, checar la terminación má reciente y asignarla como motivo');
            $movTerminado=RhMovimiento::find()
            ->where(['id_plaza'=>$this->id_plaza])
            // ->andWhere(['term_ant'=>1])
            ->orderBy('fec_termino DESC')
            ->one();
            if ($movTerminado) {
              // checar si fue terminacion anticipada
              if ($movTerminado->term_ant=1) {
                $this->ref_origen=$movTerminado->term_motivo . ' F-' . $movTerminado->clave_trab;
              }
              // o simplemente venció la vigencia de la plaza
              else {
                $this->ref_origen = "OBRA DETERMINADA" ;
              }
              // $this->ref_origen=$movTerminado->term_motivo . ' F-' . $movTerminado->clave_trab;
            }
            else {
              $this->ref_origen='';
            }
          }
        }
      }
    }

}
