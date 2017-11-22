<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "unidades_tiempo".
 *
 * @property integer $id
 * @property string $plural
 * @property string $singular
 *
 * @property Servicios[] $servicios
 */
class UnidadesTiempo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidades_tiempo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plural', 'singular'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plural' => Yii::t('app', 'Plural'),
            'singular' => Yii::t('app', 'Singular'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicios::className(), ['duracion_unidad_id' => 'id']);
    }
}
