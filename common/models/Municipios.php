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
 * @property Provincias $provincia
 * @property User[] $users
 */
class Municipios extends \yii\db\ActiveRecord
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
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::className(), 'targetAttribute' => ['provincia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_municipio' => 'Nombre Municipio',
            'provincia_id' => 'Provincia ID',
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
