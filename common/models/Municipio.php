<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property integer $id
 * @property string $nombre_municipio
 * @property integer $provincia_id
 *
 * @property Provincia $provincia
 * @property User[] $users
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_municipio', 'provincia_id'], 'required'],
            [['provincia_id'], 'integer'],
            [['nombre_municipio'], 'string', 'max' => 50],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provincia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_municipio' => Yii::t('app', 'Nombre Municipio'),
            'provincia_id' => Yii::t('app', 'Provincia ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['municipio_id' => 'id']);
    }
}
