<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhPuesto;

/**
 * RhPuestoSearch represents the model behind the search form of `app\modules\rh\models\RhPuesto`.
 */
class RhPuestoSearch extends RhPuesto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'clave_stps', 'activo', 'id_rev', 'id_reg_cont', 'nivel', 'familia', 'labores'], 'integer'],
            [['descr', 'nombre', 'puesto_stps', 'regimen', 'clasif'], 'safe'],
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
        $query = RhPuesto::find();

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
            'clave_stps' => $this->clave_stps,
            'activo' => $this->activo,
            'id_rev' => $this->id_rev,
            'id_reg_cont' => $this->id_reg_cont,
            'nivel' => $this->nivel,
            'familia' => $this->familia,
            'labores' => $this->labores,
        ]);

        $query->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'puesto_stps', $this->puesto_stps])
            ->andFilterWhere(['like', 'regimen', $this->regimen])
            ->andFilterWhere(['like', 'clasif', $this->clasif]);

        return $dataProvider;
    }
}
