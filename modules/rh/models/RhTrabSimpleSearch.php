<?php

namespace app\modules\rh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rh\models\RhTrab;

/**
 * RhTrabSearch represents the model behind the search form of `app\modules\rh\models\RhTrab`.
 */
class RhTrabSimpleSearch extends RhTrab
{
    /**
     * {@inheritdoc}
     */
    // para la búsqueda y filtrado del nlargo a través de varios criterios (nombre, apodo, apellido)
    public $nlargo;

    public function rules()
    {
        return [
            [['clave', 'activo'], 'integer'],
            [['nombre', 'ap_pat', 'ap_mat', 'ncorto', 'apodo', 'nlargo', 'curp', 'rfc', 'reg_cont', 'reg_sind'], 'safe'],
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


    public function lookup($params)
    {

      $query = RhTrab::find()->where(['clave'=> $params]);
      //$query->orFilterWhere(['LIKE', 'nombre', $params . '%', false])
      //  ->orFilterWhere(['LIKE', 'ap_pat', $params . '%', false])
      //  ->orFilterWhere(['LIKE', 'ncorto', $params . '%', false])
      //  ->orFilterWhere(['LIKE', 'apodo',  $params . '%', false])
      //  ->all();
      //$query->orWhere(['LIKE', 'nombre', $params . '%', false])
      //  ->orWhere(['LIKE', 'ap_pat', $params . '%', false])
      //  ->orWhere(['LIKE', 'ncorto', $params . '%', false])
      //  ->orWhere(['LIKE', 'apodo',  $params . '%', false])
      //  ->all();
      $query->orFilterWhere(['or',
          ['LIKE', 'nombre', $params . '%', false],
          ['LIKE', 'ap_pat', $params . '%', false],
          ['LIKE', 'ncorto', $params . '%', false],
          ['LIKE', 'apodo',  $params . '%', false],
      ])
      ->all();
      //  $query->orWhere(['or like', ['nombre', 'ap_pat', 'ncorto', 'apodo'], $params . '%', false])
      //  ->all();
      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => ['pageSize' => 5]
      ]);
      return $dataProvider;
    }


    public function lookupOriginal($params)
    {

      if ($params !== null) {
        $query = RhTrab::find()->where(['clave'=> $params]);
        //$query->orFilterWhere(['LIKE', 'nombre', $params . '%', false])
        //  ->orFilterWhere(['LIKE', 'ap_pat', $params . '%', false])
        //  ->orFilterWhere(['LIKE', 'ncorto', $params . '%', false])
        //  ->orFilterWhere(['LIKE', 'apodo',  $params . '%', false])
        //  ->all();
        //$query->orWhere(['LIKE', 'nombre', $params . '%', false])
        //  ->orWhere(['LIKE', 'ap_pat', $params . '%', false])
        //  ->orWhere(['LIKE', 'ncorto', $params . '%', false])
        //  ->orWhere(['LIKE', 'apodo',  $params . '%', false])
        //  ->all();
          $query->orFilterWhere(['or',
            ['LIKE', 'nombre', $params . '%', false],
            ['LIKE', 'ap_pat', $params . '%', false],
            ['LIKE', 'ncorto', $params . '%', false],
            ['LIKE', 'apodo',  $params . '%', false],
          ])
          ->all();
        //  $query->orWhere(['or like', ['nombre', 'ap_pat', 'ncorto', 'apodo'], $params . '%', false])
        //  ->all();
          $dataProvider = new ActiveDataProvider([
              'query' => $query,
              'pagination' => ['pageSize' => 5]
          ]);
        }
        else {
          //$query = RhTrab::find();
          $dataProvider= new ActiveDataProvider([
              'query' => null,
          ]);
          //return;
        }
      return $dataProvider;
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
        ]);

        $dataProvider->sort->attributes['nlargo']= [
          'asc'=>['nombre'=>SORT_ASC, 'ap_pat'=>SORT_ASC, 'ap_mat'=>SORT_ASC],
          'desc'=>['nombre'=>SORT_DESC, 'ap_pat'=>SORT_DESC, 'ap_mat'=>SORT_DESC],
        ];
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
            ->andFilterWhere(['or',
                              ['like', 'nombre', $this->nlargo],
                              ['like', 'ap_pat', $this->nlargo],
                              ['like', 'apodo', $this->nlargo],
                              ['like', 'ncorto', $this->nlargo],
                            ])
            ->andFilterWhere(['like', 'apodo', $this->apodo])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'reg_cont', $this->reg_cont])
            ->andFilterWhere(['like', 'reg_sind', $this->reg_sind]);

        return $dataProvider;
    }
}
