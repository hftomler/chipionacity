<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Provincia;

/**
 * ProvinciaSearch represents the model behind the search form about `common\models\Provincia`.
 */
class ProvinciaSearch extends Provincia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pais_id'], 'integer'],
            [['nombre_provincia'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Provincia::find();

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
            'pais_id' => $this->pais_id,
        ]);

        $query->andFilterWhere(['like', 'nombre_provincia', $this->nombre_provincia]);

        return $dataProvider;
    }
}