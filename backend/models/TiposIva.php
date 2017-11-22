<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipos_iva".
 *
 * @property integer $id
 * @property string $descripcion_iva
 * @property string $porcentaje_iva
 *
 * @property Servicios[] $servicios
 */
class TiposIva extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_iva';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['porcentaje_iva'], 'number'],
            [['descripcion_iva'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion_iva' => Yii::t('app', 'VAT Description'),
            'porcentaje_iva' => Yii::t('app', 'VAT %'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicios::className(), ['tipo_iva_id' => 'id']);
    }
}
