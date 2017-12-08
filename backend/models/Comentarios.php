<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use frontend\models\Profile;
/**
 * This is the model class for table "comentarios".
 *
 * @property integer $id
 * @property integer $servicio_id
 * @property integer $profile_id
 * @property integer $padre_id
 * @property string $comentario
 * @property string $created_at
 *
 * @property Comentarios $padre
 * @property Comentarios[] $comentarios
 * @property Profile $profile
 * @property Servicios $servicio
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentarios';
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
                     ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['servicio_id', 'profile_id', 'comentario', 'created_at'], 'required'],
            [['servicio_id', 'profile_id', 'padre_id'], 'integer'],
            [['created_at'], 'safe'],
            [['comentario'], 'string', 'max' => 255],
            [['padre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::className(), 'targetAttribute' => ['padre_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['servicio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'servicio_id' => Yii::t('app', 'Service Id'),
            'profile_id' => Yii::t('app', 'Profile Id'),
            'padre_id' => Yii::t('app', 'Parent Id'),
            'comentario' => Yii::t('app', 'Review'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(Comentarios::className(), ['id' => 'padre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['padre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
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
        return self::find()->where(['servicio_id' => $servicio_id])->one();
    }

    /**
     * @param int $servicio_id
     * @return \yii\db\ActiveQuery
     */
    public static function getLastCom($servicio_id) {
        if (self::getId($servicio_id) !== null){
            return self::find()->where(['servicio_id' => $servicio_id])
                                         ->orderBy(['created_at' => SORT_DESC])
                                         ->one()->comentario;
        } else {
            return 'Aún no hay ningún comentario sobre este servicio';
        }
    }
}
