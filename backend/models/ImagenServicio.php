<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "imagen_servicio".
 *
 * @property integer $id
 * @property integer $servicio_id
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Servicios $servicio
 */
class ImagenServicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen_servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicio_id', 'url', 'created_at', 'updated_at'], 'required'],
            [['servicio_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['url'], 'string', 'max' => 255],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'servicio_id' => Yii::t('app', 'Service Id'),
            'url' => Yii::t('app', 'Url'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'servicio_id']);
    }
}
