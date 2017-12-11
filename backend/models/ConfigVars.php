<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "config_vars".
 *
 * @property integer $id
 * @property boolean $includePromo
 * @property integer $numServIni1
 * @property integer $numServIni2
 * @property boolean $ordPunt
 * @property boolean $regUser
 */
class ConfigVars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config_vars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['includePromo', 'ordPunt', 'regUser'], 'boolean'],
            [['numServIni1', 'numServIni2'], 'required'],
            [['numServIni1', 'numServIni2'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'includePromo' => Yii::t('app', 'Include Promotion Service'),
            'numServIni1' => Yii::t('app', 'Services number 1'),
            'numServIni2' => Yii::t('app', 'Services number 2'),
            'ordPunt' => Yii::t('app', 'Order by Puntuation'),
            'regUser' => Yii::t('app', 'User Registration'),
        ];
    }
}
