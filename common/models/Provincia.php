<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property integer $id
 * @property string $nombre_provincia
 *
 * @property Municipios[] $municipios
 * @property User[] $users
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_provincia'], 'required'],
            [['nombre_provincia'], 'string', 'max' => 25],
            [['nombre_provincia'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_provincia' => Yii::t('app', 'Nombre Provincia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipios::className(), ['provincia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['provincia_id' => 'id']);
    }
}
