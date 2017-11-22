<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $precio
 * @property integer $proveedor_id
 * @property boolean $activo
 * @property integer $tipo_iva_id
 * @property integer $duracion
 * @property integer $duracion_unidad_id
 * @property integer $puntuacion
 * @property integer $num_votos
 * @property string $media_punt
 *
 * @property Comentarios[] $comentarios
 * @property ImagenServicio[] $imagenServicios
 * @property LineasVenta[] $lineasVentas
 * @property TiposIva $tipoIva
 * @property UnidadesTiempo $duracionUnidad
 * @property User $proveedor
 * @property ServiciosCategorias[] $serviciosCategorias
 * @property ServiciosEtiquetas[] $serviciosEtiquetas
 * @property Votaciones[] $votaciones
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'precio', 'proveedor_id'], 'required'],
            [['precio', 'media_punt'], 'number'],
            [['proveedor_id', 'tipo_iva_id', 'duracion', 'duracion_unidad_id', 'puntuacion', 'num_votos'], 'integer'],
            [['activo'], 'boolean'],
            [['descripcion'], 'string', 'max' => 255],
            [['tipo_iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposIva::className(), 'targetAttribute' => ['tipo_iva_id' => 'id']],
            [['duracion_unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadesTiempo::className(), 'targetAttribute' => ['duracion_unidad_id' => 'id']],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['proveedor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Description'),
            'precio' => Yii::t('app', 'Price'),
            'proveedor_id' => Yii::t('app', 'Supplier Id'),
            'activo' => Yii::t('app', 'Active'),
            'tipo_iva_id' => Yii::t('app', 'VAT Type Id'),
            'duracion' => Yii::t('app', 'Duration'),
            'duracion_unidad_id' => Yii::t('app', 'Duration Unit Id'),
            'puntuacion' => Yii::t('app', 'Score'),
            'num_votos' => Yii::t('app', 'Votes'),
            'media_punt' => Yii::t('app', 'Score Average'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['servicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagenServicios()
    {
        return $this->hasMany(ImagenServicio::className(), ['servicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineasVentas()
    {
        return $this->hasMany(LineasVenta::className(), ['servicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIva()
    {
        return $this->hasOne(TiposIva::className(), ['id' => 'tipo_iva_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionUnidad()
    {
        return $this->hasOne(UnidadesTiempo::className(), ['id' => 'duracion_unidad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(User::className(), ['id' => 'proveedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosCategorias()
    {
        return $this->hasMany(ServiciosCategorias::className(), ['servicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosEtiquetas()
    {
        return $this->hasMany(ServiciosEtiquetas::className(), ['servicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotaciones()
    {
        return $this->hasMany(Votaciones::className(), ['servicio_id' => 'id']);
    }
}
