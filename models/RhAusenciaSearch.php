<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RhAusencia;

/**
 * RhAusenciaSearch represents the model behind the search form of `app\models\RhAusencia`.
 */
class RhAusenciaSearch extends RhAusencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'clave_trab', 'id_plaza', 'req_cobertura'], 'integer'],
            [['clave_tipo', 'fec_inicio', 'fec_termino', 'fec_reanuda', 'docs', 'obs'], 'safe'],
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
        $query = RhAusencia::find();

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
            'fec_inicio' => $this->fec_inicio,
            'fec_termino' => $this->fec_termino,
            'fec_reanuda' => $this->fec_reanuda,
            'req_cobertura' => $this->req_cobertura,
        ]);

        $query->andFilterWhere(['like', 'clave_tipo', $this->clave_tipo])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'obs', $this->obs]);

        return $dataProvider;
    }
}
