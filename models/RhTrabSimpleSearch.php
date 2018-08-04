<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RhTrab;

/**
 * RhTrabSearch represents the model behind the search form of `app\models\RhTrab`.
 */
class RhTrabSimpleSearch extends RhTrab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'activo'], 'integer'],
            [['nombre', 'ap_pat', 'ap_mat', 'ncorto', 'apodo', 'curp'], 'safe'],
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
            'pagination' => ['pageSize' => 8]
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
       
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'ap_pat', $this->ap_pat])
            ->andFilterWhere(['like', 'ap_mat', $this->ap_mat])
            ->andFilterWhere(['like', 'ncorto', $this->ncorto])
            ->andFilterWhere(['like', 'apodo', $this->apodo])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'rfc', $this->rfc]
           );

        return $dataProvider;
    }
}
