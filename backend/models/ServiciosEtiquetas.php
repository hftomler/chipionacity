<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "servicios_etiquetas".
 *
 * @property integer $id
 * @property integer $etiqueta_id
 * @property integer $servicio_id
 *
 * @property Etiquetas $etiqueta
 * @property Servicios $servicio
 */
class ServiciosEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicios_etiquetas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['etiqueta_id', 'servicio_id'], 'required'],
            [['etiqueta_id', 'servicio_id'], 'integer'],
            [['etiqueta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Etiquetas::className(), 'targetAttribute' => ['etiqueta_id' => 'id']],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'etiqueta_id' => Yii::t('app', 'Tag Id'),
            'servicio_id' => Yii::t('app', 'Service Id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiquetas::className(), ['id' => 'etiqueta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'servicio_id']);
    }
}
