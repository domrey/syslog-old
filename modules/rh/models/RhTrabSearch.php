<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhTrab;

/**
 * RhTrabSearch represents the model behind the search form of `app\modules\rh\models\RhTrab`.
 */
class RhTrabSearch extends RhTrab
{
    /**
     * {@inheritdoc}
     */

     // atributo que representa el nombre completo del trabajador
     public $trabajador;

    public function rules()
    {
        return [
            [['clave', 'activo'], 'integer'],
            [['nombre', 'ap_pat', 'ap_mat', 'ncorto', 'trabajador', 'apodo', 'curp', 'rfc', 'calle_no', 'colonia', 'ciudad', 'estado', 'pais', 'nacionalidad', 'edo_civil', 'sexo', 'tel', 'email', 'fec_cat', 'fec_depto', 'fec_planta', 'fec_ingreso', 'fec_nac', 'reg_cont', 'reg_sind'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RhTrab::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['trabajador']= [
          'asc'=>['nombre'=>SORT_ASC, 'ap_pat'=>SORT_ASC, 'ap_mat'=>SORT_ASC],
          'desc'=>['nombre'=>SORT_DESC, 'ap_pat'=>SORT_DESC, 'ap_mat'=>SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'clave' => $this->clave,
            'activo' => $this->activo,
            'fec_cat' => $this->fec_cat,
            'fec_depto' => $this->fec_depto,
            'fec_planta' => $this->fec_planta,
            'fec_ingreso' => $this->fec_ingreso,
            'fec_nac' => $this->fec_nac,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'ap_pat', $this->ap_pat])
            ->andFilterWhere(['like', 'ap_mat', $this->ap_mat])
            ->andFilterWhere(['like', 'ncorto', $this->ncorto])
            ->andFilterWhere(['or',
                              ['like', 'nombre', $this->trabajador],
                              ['like', 'ap_pat', $this->trabajador],
                              ['like', 'apodo', $this->trabajador],
                              ['like', 'ncorto', $this->trabajador],
                            ])
            ->andFilterWhere(['like', 'apodo', $this->apodo])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'calle_no', $this->calle_no])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['like', 'edo_civil', $this->edo_civil])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'reg_cont', $this->reg_cont])
            ->andFilterWhere(['like', 'reg_sind', $this->reg_sind]);

        return $dataProvider;
    }

    public static function getNextBirthdays()
    {
      $daysInterval=7;
      $query = RhTrab::find()->select('clave, concat(nombre,  ap_pat) as trab, fec_nac')
        ->from('rh_trab')
        ->where('CONCAT(IF(CONCAT( YEAR(CURDATE()),substring(fec_nac, 5, length(fec_nac))) < CURDATE(), YEAR(CURDATE()) + 1, YEAR(CURDATE()) ), substring(fec_nac, 5, length(fec_nac))) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)')
        ->all();
      $dataProvider = new ActiveDataProvider([
        'query'=>$query,
      ]);
      return $dataProvider;
    }
}
