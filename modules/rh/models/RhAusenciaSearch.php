<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhAusencia;

/**
 * RhAusenciaSearch represents the model behind the search form of `app\modules\rh\models\RhAusencia`.
 */
class RhAusenciaSearch extends RhAusencia
{
    /**
     * {@inheritdoc}
     */

     public $trabName;



    public function rules()
    {
        return [
            [['id', 'clave_trab', 'id_plaza', 'id_motivo', 'req_cobertura'], 'integer'],
            [['clave_plaza', 'clave_motivo', 'trabName', 'apodo', 'fec_inicio', 'fec_termino', 'fec_reanuda', 'doc', 'descr'], 'safe'],
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
        $query = RhAusencia::find()->joinWith('trab');
        $query->orderBy('fec_inicio DESC, fec_termino DESC');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['trabName']= [
          'asc'=>['rh_trab.nlargo'=>SORT_ASC],
          'desc'=>['rh_trab.nlargo'=>SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_plaza' => $this->id_plaza,
            'id_motivo' => $this->id_motivo,
            'fec_inicio' => $this->fec_inicio,
            'fec_termino' => $this->fec_termino,
            'fec_reanuda' => $this->fec_reanuda,
            'req_cobertura' => $this->req_cobertura,
        ]);

        $query->andFilterWhere(['like', 'clave_plaza', $this->clave_plaza])
            ->andFilterWhere(['like', 'clave_motivo', $this->clave_motivo])
            ->andFilterWhere(['like', 'doc', $this->doc])
            ->andFilterWhere(['or',
                      ['like', 'rh_trab.nombre', $this->trabName],
                      ['like', 'rh_trab.ap_pat', $this->trabName],
                      ['like', 'rh_trab.apodo', $this->trabName],
                      ['like', 'rh_trab.ncorto', $this->trabName],
                    ])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
