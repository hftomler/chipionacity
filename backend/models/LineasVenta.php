<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lineas_venta".
 *
 * @property integer $id
 * @property integer $venta_id
 * @property integer $servicio_id
 * @property integer $cantidad
 * @property string $precio_unit
 * @property string $descuento_linea
 * @property string $total_linea
 * @property string $total_comision_linea
 *
 * @property Servicios $servicio
 * @property Ventas $venta
 */
class LineasVenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lineas_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venta_id', 'servicio_id', 'cantidad', 'precio_unit', 'total_linea', 'total_comision_linea'], 'required'],
            [['venta_id', 'servicio_id', 'cantidad'], 'integer'],
            [['precio_unit', 'descuento_linea', 'total_linea', 'total_comision_linea'], 'number'],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicio_id' => 'id']],
            [['venta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ventas::className(), 'targetAttribute' => ['venta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'venta_id' => Yii::t('app', 'Sale Id'),
            'servicio_id' => Yii::t('app', 'Service Id'),
            'cantidad' => Yii::t('app', 'Quantity'),
            'precio_unit' => Yii::t('app', 'Unit Price'),
            'descuento_linea' => Yii::t('app', 'Line Discount'),
            'total_linea' => Yii::t('app', 'Total line'),
            'total_comision_linea' => Yii::t('app', 'Total Commission Line'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'servicio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenta()
    {
        return $this->hasOne(Ventas::className(), ['id' => 'venta_id']);
    }
}