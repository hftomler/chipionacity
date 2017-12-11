<?php

namespace backend\models;

use Yii;
use common\models\User;

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
 * @property integer $estado_id
 *
 * @property LineasVenta[] $lineasVentas
 * @property EstadoVentas $estado
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
            [['usuario_id', 'importe', 'importe_iva', 'total_venta', 'total_comision', 'estado_id'], 'required'],
            [['usuario_id', 'estado_id'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['importe', 'descuento', 'importe_iva', 'total_venta', 'total_comision'], 'number'],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoVentas::className(), 'targetAttribute' => ['estado_id' => 'id']],
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
            'estado_id' => Yii::t('app', 'Status Id'),
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
    public function getEstado()
    {
        return $this->hasOne(EstadoVentas::className(), ['id' => 'estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}
