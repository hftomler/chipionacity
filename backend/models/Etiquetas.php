<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "etiquetas".
 *
 * @property integer $id
 * @property string $descripcion_tag
 *
 * @property ServiciosEtiquetas[] $serviciosEtiquetas
 */
class Etiquetas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion_tag'], 'required'],
            [['descripcion_tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion_tag' => Yii::t('app', 'Tag Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosEtiquetas()
    {
        return $this->hasMany(ServiciosEtiquetas::className(), ['etiqueta_id' => 'id']);
    }
}
