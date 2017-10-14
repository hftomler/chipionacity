<?php

namespace frontend\models;

use Yii;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\models\Municipio;
use common\models\Pais;
use common\models\Provincia;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $nombre
 * @property string $apellidos
 * @property integer $gender_id
 * @property string $direccion
 * @property integer $pais_id
 * @property integer $municipio_id
 * @property string $cpostal
 * @property integer $provincia_id
 * @property string $fecha_nac
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Gender $gender
 * @property Municipios $municipio
 * @property Paises $pais
 * @property Provincias $provincia
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
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
            [['user_id', 'gender_id', 'pais_id', 'municipio_id', 'provincia_id'], 'integer'],
            [['fecha_nac'], 'safe'],
            [['gender_id'], 'in', 'range'=>array_keys($this->getGenderList())],
            [['nombre', 'apellidos', 'direccion'], 'string', 'max' => 255],
            [['cpostal'], 'string', 'max' => 5],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipio_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_id' => 'id']],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provincia_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'nombre' => Yii::t('frontend', 'Nombre'),
            'apellidos' => Yii::t('frontend', 'Apellidos'),
            'gender_id' => Yii::t('frontend', 'Orientación Sexual'),
            'direccion' => Yii::t('frontend', 'Direccion'),
            'pais_id' => Yii::t('frontend', 'Pais ID'),
            'municipio_id' => Yii::t('frontend', 'Municipio ID'),
            'cpostal' => Yii::t('frontend', 'Cpostal'),
            'provincia_id' => Yii::t('frontend', 'Provincia ID'),
            'fecha_nac' => Yii::t('frontend', 'Fecha Nac'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
            'genderName' => Yii::t('app', 'Gender'),
            'userLink' => Yii::t('app', 'User'),
            'profileIdLink' => Yii::t('app', 'Profile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    /**
     *
    */
    public function getGenderName() {
        return $this->gender->gender_name;
    }

    /**
     * Obtener el listado de géneros para Dropdown
    */
    public static function getGenderList() {
        $droptions = Gender::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'gender_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipios::className(), ['id' => 'municipio_id']);
    }

    /**
     * Obtener el nombre del Municipio
    */
    public function getNombreMunicipio() {
        return $this->municipio->nombre_municipio;
    }

    /**
     * Obtener el listado de municipios para Dropdown
    */
    public static function getListaMunicipios() {
        $droptions = Municipio::find()->orderBy('nombre_municipio')->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre_municipio');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id']);
    }

    /**
     * Obtener el nombre del Provincia
    */
    public function getNombreProvincia() {
        return $this->provincia->nombre_provincia;
    }

    /**
     * Obtener el listado de provincias para Dropdown
    */
    public static function getListaProvincias() {
        $droptions = Provincia::find()->orderBy('nombre_provincia')->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre_provincia');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Paises::className(), ['id' => 'pais_id']);
    }

    /**
     * Obtener el nombre del Pais
    */
    public function getNombrePais() {
        return $this->pais->nombre_pais;
    }

    /**
     * Obtener el listado de paises para Dropdown
    */
    public static function getListaPaises() {
        $droptions = Pais::find()->orderBy('nombre_pais')->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre_pais');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Obtener nombre de Usuario
    */
    public function getUsername() {
        return $this->user->username;
    }

    /**
     * @getUserId
     */ 
    public function getUserId() {
        return $this->user ? $this->user->id : 'Ninguno';
    }

    /**
     * @getUserLink
     */
    public function getUserLink() {
        $url = Url::to(['user/view', 'id'=>$this->UserId]);
        $options = [];
        return Html::a($this->getUserName(), $url, $options);
    }

    /**
     * @getProfileIdLink()
     */
    public function getProfileIdLink() {
        $url = Url::to(['profile/update', 'id'=>$this->id]);
        $options = [];
        return Html::a($this->getUserName(), $url, $options);
    }

    public function beforeValidate() {
        if ($this->fecha_nac != null) {
            $new_date_format = date('d-m-Y', strtotime($this->fecha_nac));
            $this->fecha_nac = $new_date_format;
        }
            return parent::beforeValidate();
        }
    }
