<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property integer $id
 * @property string $desc_provincia
 *
 * @property Municipios[] $municipios
 * @property User[] $users
 */
class Provincias extends \yii\db\ActiveRecord
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
            [['desc_provincia'], 'required'],
            [['desc_provincia'], 'string', 'max' => 25],
            [['desc_provincia'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc_provincia' => 'Desc Provincia',
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
