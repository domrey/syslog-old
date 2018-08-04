<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RhMovimiento;

/**
 * RhMovimientoSearch represents the model behind the search form of `app\models\RhMovimiento`.
 */
class RhMovimientoSearch extends RhMovimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'clave_trab', 'id_plaza', 'id_ausencia'], 'integer'],
            [['fec_inicio', 'fec_termino', 'tipo_mov', 'descr', 'docs', 'motivo', 'ref_motivo', 'ref_origen'], 'safe'],
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
        $query = RhMovimiento::find();

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
            'id' => $this->id,
            'clave_trab' => $this->clave_trab,
            'id_plaza' => $this->id_plaza,
            'id_ausencia' => $this->id_ausencia,
            'fec_inicio' => $this->fec_inicio,
            'fec_termino' => $this->fec_termino,
        ]);

        $query->andFilterWhere(['like', 'tipo_mov', $this->tipo_mov])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'motivo', $this->motivo])
            ->andFilterWhere(['like', 'ref_motivo', $this->ref_motivo])
            ->andFilterWhere(['like', 'ref_origen', $this->ref_origen]);

        return $dataProvider;
    }
}
