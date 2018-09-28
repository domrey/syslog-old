<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhMovimiento;

/**
 * RhMovimientoSearch represents the model behind the search form of `app\modules\rh\models\RhMovimiento`.
 */
class RhMovimientoSearch extends RhMovimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'clave_trab', 'id_plaza', 'id_ausencia', 'id_mov_padre', 'term_ant'], 'integer'],
            [['clave_plaza', 'fec_inicio', 'fec_termino', 'descr', 'doc_num', 'doc_form', 'ref_motivo', 'ref_origen', 'tipo', 'term_descr', 'term_motivo'], 'safe'],
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
        $query = RhMovimiento::find()->orderBy('fec_inicio DESC, fec_termino DESC');

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
            'id_mov_padre' => $this->id_mov_padre,
            'fec_inicio' => $this->fec_inicio,
            'fec_termino' => $this->fec_termino,
            'term_ant' => $this->term_ant,
        ]);

        $query->andFilterWhere(['like', 'clave_plaza', $this->clave_plaza])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'doc_num', $this->doc_num])
            ->andFilterWhere(['like', 'doc_form', $this->doc_form])
            ->andFilterWhere(['like', 'ref_motivo', $this->ref_motivo])
            ->andFilterWhere(['like', 'ref_origen', $this->ref_origen])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'term_descr', $this->term_descr])
            ->andFilterWhere(['like', 'term_motivo', $this->term_motivo]);

        return $dataProvider;
    }
}
