<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Plaza;

/**
 * PlazaSearch represents the model behind the search form of `app\models\Plaza`.
 */
class PlazaSearch extends Plaza
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'descr', 'tipo', 'clave_descanso', 'fec_creacion', 'residencia', 'localidad', 'taller', 'instalacion', 'funcion', 'grupo'], 'safe'],
            [['clave_puesto', 'activa', 'depto', 'clave_jornada', 'sirhn', 'posfin'], 'integer'],
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
        $query = Plaza::find();

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
            'clave_puesto' => $this->clave_puesto,
            'activa' => $this->activa,
            'depto' => $this->depto,
            'clave_jornada' => $this->clave_jornada,
            'fec_creacion' => $this->fec_creacion,
            'sirhn' => $this->sirhn,
            'posfin' => $this->posfin,
        ]);

        $query->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'clave_descanso', $this->clave_descanso])
            ->andFilterWhere(['like', 'residencia', $this->residencia])
            ->andFilterWhere(['like', 'localidad', $this->localidad])
            ->andFilterWhere(['like', 'taller', $this->taller])
            ->andFilterWhere(['like', 'instalacion', $this->instalacion])
            ->andFilterWhere(['like', 'funcion', $this->funcion])
            ->andFilterWhere(['like', 'grupo', $this->grupo]);

        return $dataProvider;
    }
}
