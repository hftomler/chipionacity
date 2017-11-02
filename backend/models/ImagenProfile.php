<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "imagen_profile".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $url
 *
 * @property Profile[] $profiles
 */
class ImagenProfile extends \yii\db\ActiveRecord
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
        ];
    }

    private function getId($profile_id) {
        return ImagenProfile::find()->where(['profile_id' => $profile_id])->one();
    }

    public function getLastImg($profile_id) {
        if (ImagenProfile::getId($profile_id) !== null){
            return ImagenProfile::find()->where(['profile_id' => $profile_id])->orderBy(['id' => SORT_DESC])->one()->url;
        } else {
            return "imagenes/imgPerfil/sinPerfil.jpg";
        }
    }

    public function existsUrl($profile_id, $url) {
        return ImagenProfile::find()->where(['profile_id' => $profile_id, 'url' => $url])->one();
    }

    public function getAllImg($profile_id) {

    }

}
