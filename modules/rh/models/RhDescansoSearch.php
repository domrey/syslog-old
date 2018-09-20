<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhDescanso;

/**
 * RhDescansoSearch represents the model behind the search form of `app\modules\rh\models\RhDescanso`.
 */
class RhDescansoSearch extends RhDescanso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'abrevn'], 'safe'],
            [['valor'], 'integer'],
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
        $query = RhDescanso::find();

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
            'valor' => $this->valor,
        ]);

        $query->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'abrevn', $this->abrevn]);

        return $dataProvider;
    }
}
