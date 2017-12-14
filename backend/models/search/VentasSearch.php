<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ventas;

/**
 * VentasSearch represents the model behind the search form about `backend\models\Ventas`.
 */
class VentasSearch extends Ventas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'estado_id'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['importe', 'descuento', 'importe_iva', 'total_venta', 'total_comision'], 'number'],
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
        $query = Ventas::find();

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
            'usuario_id' => $this->usuario_id,
            'fecha_venta' => $this->fecha_venta,
            'importe' => $this->importe,
            'descuento' => $this->descuento,
            'importe_iva' => $this->importe_iva,
            'total_venta' => $this->total_venta,
            'total_comision' => $this->total_comision,
            'estado_id' => $this->estado_id,
        ]);

        return $dataProvider;
    }
}
