<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * This is the model class for table "imagen_publi".
 *
 * @property integer $id
 * @property integer $etiqueta_id
 * @property string $descripcion
 * @property string $urlvt
 * @property string $urlhz
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Etiquetas $etiqueta
 */
class ImagenPubli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen_publi';
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
            [['etiqueta_id', 'descripcion', 'urlvt', 'urlhz'], 'required'],
            [['etiqueta_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 50],
            [['urlvt', 'urlhz'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'etiqueta_id' => Yii::t('app', 'Etiqueta ID'),
            'descripcion' => Yii::t('app', 'Description'),
            'urlvt' => Yii::t('app', 'Urlvt'),
            'urlhz' => Yii::t('app', 'Urlhz'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiquetas::className(), ['id' => 'etiqueta_id']);
    }

    /**
     * @param bool $rand Determina si se toma la imagen más nueva o random
     * @param bool $orientacion true=vertical, false=horizontal
     * @return string $htmlResult
    */
   public static function getImagenPubli($rand = true, $orientacion = true) {
       $id = rand(1, count(self::find()->all()));
       if ($rand) {
           $reg = self::find()->where(['id' => $id])->one();
       } else {
           $reg = self::find()->orderBy(['updated_at' => SORT_DESC])->one();
       }
       if ($orientacion) {
           $htmlResult = '<a href="' . $reg->link . '"><img class="publiVt" src="' . $reg->urlvt . '" title="' . $reg->descripcion . '" alt="' . $reg->descripcion . '" /><span class="promoVt">Anuncio</span></a>';
       } else {
           $htmlResult = '<a href="' . $reg->link . '"><img class="publiHz" src="' . $reg->urlhz . '" title="' . $reg->descripcion . '" alt="' . $reg->descripcion . '" /><span class="promoHz">Anuncio</span></a>';
       }
       return $htmlResult;
   }
}
