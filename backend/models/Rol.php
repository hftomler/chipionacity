<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $rol_name
 * @property integer $rol_value
 *
 * @property User[] $users
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_name', 'rol_value'], 'required'],
            [['rol_value'], 'integer'],
            [['rol_name'], 'string', 'max' => 45],
            [['rol_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rol_name' => Yii::t('app', 'Rol Name'),
            'rol_value' => Yii::t('app', 'Rol Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'rol_value']);
    }
}
