<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Servicios;
use common\models\User;

/**
 * ServicioSearch represents the model behind the search form about `backend\models\Servicios`.
 */
class ServicioSearch extends Servicios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'tipo_iva_id', 'duracion', 'duracion_unidad_id', 'puntuacion', 'num_votos'], 'integer'],
            [['descripcion'], 'safe'],
            [['precio', 'media_punt'], 'number'],
            [['activo'], 'boolean'],
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
        $query = Servicios::find();

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
            'precio' => $this->precio,
            'proveedor_id' =>(User::isProveedor(Yii::$app->user->identity->id)) ? Yii::$app->user->identity->id : $this->proveedor_id,
            'activo' => $this->activo,
            'tipo_iva_id' => $this->tipo_iva_id,
            'duracion' => $this->duracion,
            'duracion_unidad_id' => $this->duracion_unidad_id,
            'puntuacion' => $this->puntuacion,
            'num_votos' => $this->num_votos,
            'media_punt' => $this->media_punt,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
