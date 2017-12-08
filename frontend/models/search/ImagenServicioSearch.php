<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Comentarios;

/**
 * ImagenServicioSearch represents the model behind the search form about `backend\models\Comentarios`.
 */
class ImagenServicioSearch extends Comentarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicio_id', 'profile_id', 'padre_id'], 'integer'],
            [['comentario', 'created_at'], 'safe'],
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
        $query = Comentarios::find();

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
            'servicio_id' => $this->servicio_id,
            'profile_id' => $this->profile_id,
            'padre_id' => $this->padre_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
