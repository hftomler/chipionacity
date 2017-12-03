<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "imagen_servicio".
 *
 * @property integer $id
 * @property integer $servicio_id
 * @property integer $descripcion
 * @property string $url
 * @property string $urlthumb
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Servicios $servicio
 */
class ImagenServicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen_servicio';
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
            [['servicio_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
            [['urlthumb'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'servicio_id' => Yii::t('app', 'Service Id'),
            'descripcion' => Yii::t('app', 'Descripion'),
            'url' => Yii::t('app', 'Url'),
            'url' => Yii::t('app', 'Url Thumbnail'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'servicio_id']);
    }

    /**
     * @param int $servicio_id
     * @return \yii\db\ActiveQuery
     */
    private static function getId($servicio_id) {
        return ImagenServicio::find()->where(['servicio_id' => $servicio_id])->one();
    }

    /**
     * @param int $servicio_id
     * @return \yii\db\ActiveQuery
     */
    public static function getLastImg($servicio_id) {
        if (ImagenServicio::getId($servicio_id) !== null){
            return ImagenServicio::find()->where(['servicio_id' => $servicio_id])
                                         ->orderBy(['updated_at' => SORT_DESC])
                                         ->one()->url;
        } else {
            return 'imagenes/imgServ/noServImg.png';
        }
    }

    /**
     * @param int $servicio_id
     * @return \yii\db\ActiveQuery
     */
    public static function getLastImgThumb($servicio_id) {
        if (ImagenServicio::getId($servicio_id) !== null){
            return ImagenServicio::find()->where(['servicio_id' => $servicio_id])
                                         ->orderBy(['updated_at' => SORT_DESC])
                                         ->one()->urlthumb;
        } else {
            return 'imagenes/thumbs/noServImgThumb.jpg';
        }
    }

    /**
     * @param string $url
     * @param int $servicio_id
     * @return \yii\db\ActiveQuery
     */

    public function existsUrl($servicio_id, $url) {
        return ImagenServicio::find()->where(['servicio_id' => $servicio_id, 'url' => $url])->one();
    }
}
