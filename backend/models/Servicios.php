<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\helpers\Html;
use common\models\PermissionHelpers;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "servicios".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $precio
 * @property integer $proveedor_id
 * @property integer $tipo_iva_id
 * @property integer $duracion
 * @property integer $duracion_unidad_id
 * @property integer $puntuacion
 * @property integer $num_votos
 * @property string $media_punt
 * @property boolean $activo
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

    /**
     * Almacén para las imágenes subidas
     * @var array $fichImage;
     */
    public $fichImage;

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
            [['tipo_iva_id'], 'in', 'range'=>array_keys($this->getIvaList())],
            [['tipo_iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposIva::className(), 'targetAttribute' => ['tipo_iva_id' => 'id']],
            [['duracion_unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadesTiempo::className(), 'targetAttribute' => ['duracion_unidad_id' => 'id']],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['proveedor_id' => 'id']],
            ['fichImage', 'file', 'maxFiles' => 5],
            ['fichImage', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 640, 'maxWidth' => 800,
                'minHeight' => 480, 'maxHeight' => 600,
                'maxFiles' => 5
            ],
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
     * Obtener el listado de ivas para Dropdown
    */
    public static function getIvaList() {
        $droptions = TiposIva::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'descripcion_iva');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionUnidad()
    {
        return $this->hasOne(UnidadesTiempo::className(), ['id' => 'duracion_unidad_id']);
    }

    /**
     * Obtener el listado de unidades de tiempo para Dropdown
    */
    public static function getDuracionList() {
        $droptions = UnidadesTiempo::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'singular');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(User::className(), ['id' => 'proveedor_id']);
    }

    /**
     * Obtener el listado de unidades de tiempo para Dropdown
    */
    public static function getProveedorList() {
        $droptions = User::find()->asArray()->where(['proveedor' => true])->all();
        return ArrayHelper::map($droptions, 'id', 'username');
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

    /**
     * @param int $id
     * @return $htmlResul
     */
    public function getImagenServicio($id) {
        $imgs = ImagenServicio::findAll(['servicio_id' => $id]);
        $formatter = \Yii::$app->formatter;

        $strImgs = array();
            foreach ($imgs as $key) {
                $strImgs[] = '<div class="imgWrapServ">
                <i name="u' .$key->id . '" class="fa fa-eye tickImgServ invisible" aria-hidden="true" title="' . Yii::t('app', 'View Service Image: ') . $this->descripcion . '"></i>'
                . '<span class="fa fa-calendar fecha" aria-hidden="true"> ' . $formatter->asDate($key->created_at, 'short') .'</span>'
                . Html::img($key->url,
                                    ['class' => 'imgServicio-sm img-thumbnail imgServ-thumbnail'])
                . '<i name="d' .$key->id . '" class="fa fa-trash closeImgServ invisible" aria-hidden="true" title="' . Yii::t('app', 'Delete Service Image: ') . $this->descripcion . '"></i>
                </div>';
            }
            $htmlResul = implode($strImgs);
        return $htmlResul;
    }

}
