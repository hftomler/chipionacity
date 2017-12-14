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
 * @property integer $classBloq1
 * @property integer $classBloq2
 * @property boolean $ordPunt
 * @property boolean $regUser
 * @property boolean $offline
 * @property boolean $logoHomeft
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
            [['includePromo', 'ordPunt', 'regUser', 'offline'], 'boolean'],
            [['numServIni1', 'numServIni2'], 'required'],
            [['numServIni1', 'numServIni2', 'classBloq1', 'classBloq2'], 'integer'],
            [['logoHomeft'], 'string']
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
            'numServIni1' => Yii::t('app', '# Imgs Services main block'),
            'numServIni2' => Yii::t('app', '# Imgs Services secondary block'),
            'classBloq1' => Yii::t('app', '# Imgs per line main block'),
            'classBloq2' => Yii::t('app', '# Imgs secondary block'),
            'ordPunt' => Yii::t('app', 'Order by Puntuation'),
            'regUser' => Yii::t('app', 'User Registration'),
            'offline' => Yii::t('app', 'System offline'),
        ];
    }
}
