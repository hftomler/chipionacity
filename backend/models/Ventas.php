<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ventas".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property string $fecha_venta
 * @property string $importe
 * @property string $descuento
 * @property string $importe_iva
 * @property string $total_venta
 * @property string $total_comision
 *
 * @property LineasVenta[] $lineasVentas
 * @property User $usuario
 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'importe', 'importe_iva', 'total_venta', 'total_comision'], 'required'],
            [['usuario_id'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['importe', 'descuento', 'importe_iva', 'total_venta', 'total_comision'], 'number'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'User Id'),
            'fecha_venta' => Yii::t('app', 'Date'),
            'importe' => Yii::t('app', 'Amount'),
            'descuento' => Yii::t('app', 'Discount'),
            'importe_iva' => Yii::t('app', 'Vat amount'),
            'total_venta' => Yii::t('app', 'Total Sale'),
            'total_comision' => Yii::t('app', 'Total Commission'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineasVentas()
    {
        return $this->hasMany(LineasVenta::className(), ['venta_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}
