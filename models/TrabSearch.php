<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trab;

/**
 * TrabSearch represents the model behind the search form of `app\models\Trab`.
 */
class TrabSearch extends Trab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'activo'], 'integer'],
            [['nombre', 'ap_pat', 'ap_mat', 'ncorto', 'apodo', 'curp', 'rfc', 'calle_no', 'colonia', 'ciudad', 'estado', 'pais', 'nacionalidad', 'edo_civil', 'sexo', 'tel', 'email', 'fec_cat', 'fec_depto', 'fec_planta', 'fec_ingreso', 'fec_nac', 'reg_cont', 'reg_sind'], 'safe'],
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
        $query = Trab::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
}
