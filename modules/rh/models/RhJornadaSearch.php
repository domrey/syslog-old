<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhJornada;

/**
 * RhJornadaSearch represents the model behind the search form of `app\modules\rh\models\RhJornada`.
 */
class RhJornadaSearch extends RhJornada
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave'], 'integer'],
            [['descr', 'clave_texto'], 'safe'],
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
        $query = RhJornada::find();

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
        ]);

        $query->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'clave_texto', $this->clave_texto]);

        return $dataProvider;
    }
}
