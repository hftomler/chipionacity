<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "paises".
 *
 * @property integer $id
 * @property string $nombre_pais
 *
 * @property User[] $users
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paises';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_pais'], 'required'],
            [['nombre_pais'], 'string', 'max' => 255],
            [['nombre_pais'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_pais' => Yii::t('app', 'Nombre Pais'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['pais_id' => 'id']);
    }
}
