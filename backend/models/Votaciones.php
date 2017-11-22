<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "votaciones".
 *
 * @property integer $id
 * @property integer $servicio_id
 * @property integer $profile_id
 * @property integer $puntuacion
 * @property string $created_at
 *
 * @property Profile $profile
 * @property Servicios $servicio
 */
class Votaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicio_id', 'profile_id', 'created_at'], 'required'],
            [['servicio_id', 'profile_id', 'puntuacion'], 'integer'],
            [['created_at'], 'safe'],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
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
            'servicio_id' => Yii::t('app', 'Service Id'),
            'profile_id' => Yii::t('app', 'Profile Id'),
            'puntuacion' => Yii::t('app', 'Score'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'servicio_id']);
    }
}
