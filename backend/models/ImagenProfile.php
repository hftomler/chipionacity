<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "imagen_profile".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $url
 *
 * @property Profile[] $profiles
 */
class Imagenprofile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen_profile';
    }

    /**
      * @inheritdoc
      */
     public function behaviors()
     {
         return [
             'timestamp' => [
                 'class' => 'yii\behaviors\TimestampBehavior',
                 'attributes' => [
                     ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                     ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                 ],
                 'value' => new Expression('NOW()'),
             ],
         ];
     }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'url' => Yii::t('app', 'Url'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    public function getProfile() {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    private static function getId($profile_id) {
        return Imagenprofile::find()->where(['profile_id' => $profile_id])->one();
    }

    public static function getLastImg($profile_id) {
        if (Imagenprofile::getId($profile_id) !== null){
            return Imagenprofile::find()->where(['profile_id' => $profile_id])->orderBy(['updated_at' => SORT_DESC])->one()->url;
        } else {
            return "imagenes/imgPerfil/sinPerfil.jpg";
        }
    }

    public function existsUrl($profile_id, $url) {
        return Imagenprofile::find()->where(['profile_id' => $profile_id, 'url' => $url])->one();
    }
}
