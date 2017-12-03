<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImagenServicio;
use common\models\User;

/**
 * ImagenServicioSearch represents the model behind the search form about `backend\models\ImagenServicio`.
 */
class ImagenServicioSearch extends ImagenServicio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicio_id'], 'integer'],
            [['descripcion', 'url', 'urlthumb', 'created_at', 'updated_at'], 'safe'],
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
        $isProv = User::isProveedor(Yii::$app->user->identity->id);
        ($isProv) ? $query = ImagenServicio::find()->joinWith('servicio')->where(['proveedor_id' => Yii::$app->user->identity->id]) :
                    $query = ImagenServicio::find();



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
            'servicio_id' => (!isset($serv_id)) ? $this->servicio_id : $serv_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'urlthumb', $this->urlthumb]);

        return $dataProvider;
    }
}
