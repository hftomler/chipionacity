<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;

/**
 * This is the model class for table "servicios".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $descripcion_lg
 * @property string $precio
 * @property integer $proveedor_id
 * @property integer $tipo_iva_id
 * @property integer $duracion
 * @property integer $duracion_unidad_id
 * @property integer $puntuacion
 * @property integer $num_votos
 * @property string $media_punt
 * @property boolean $activo
 * @property string $created_at
 * @property string $updated_at
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
     * Almacén para las imágenes subidas
     * @var array $fichImage
     */
    public $fichImage;

    public static function tableName()
    {
        return 'servicios';
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
            [['descripcion', 'descripcion_lg', 'precio', 'proveedor_id'], 'required'],
            [['precio', 'media_punt'], 'number'],
            [['proveedor_id', 'tipo_iva_id', 'duracion', 'duracion_unidad_id', 'puntuacion', 'num_votos'], 'integer'],
            [['activo'], 'boolean'],
            [['descripcion'], 'string', 'max' => 60],
            [['descripcion_lg'], 'string', 'max' => 200],
            [['tipo_iva_id'], 'in', 'range'=>array_keys($this->getIvaList())],
            [['tipo_iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposIva::className(), 'targetAttribute' => ['tipo_iva_id' => 'id']],
            [['duracion_unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadesTiempo::className(), 'targetAttribute' => ['duracion_unidad_id' => 'id']],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['proveedor_id' => 'id']],
            ['fichImage', 'file', 'maxFiles' => 80],
            ['fichImage', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 80, 'maxWidth' => 800,
                'minHeight' => 60, 'maxHeight' => 600,
                'maxFiles' => 80
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
            'descripcion' => Yii::t('app', 'Large Description'),
            'precio' => Yii::t('app', 'Price'),
            'proveedor_id' => Yii::t('app', 'Service Provider Id'),
            'activo' => Yii::t('app', 'Active'),
            'tipo_iva_id' => Yii::t('app', 'VAT Type Id'),
            'duracion' => Yii::t('app', 'Duration'),
            'duracion_unidad_id' => Yii::t('app', 'Duration Unit Id'),
            'puntuacion' => Yii::t('app', 'Score'),
            'num_votos' => Yii::t('app', 'Votes'),
            'media_punt' => Yii::t('app', 'Score Average'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
                <i name="vs' .$key->id . '" class="fa fa-eye tickImgServ invisible" aria-hidden="true" title="' . Yii::t('app', 'View Service Image: ') . $this->descripcion . '"></i>'
                . '<span class="fa fa-calendar fecha" aria-hidden="true"> ' .
                        $formatter->asDate($key->created_at, 'short') .'</span>'
                . Html::img($key->urlthumb,
                                    ['class' => 'imgServicio-sm imgServ-thumbnail'])
                                    . '<i name="ds' .$key->id . '"
                                    class="fa fa-trash closeImgServ invisible" aria-hidden="true"
                                    alt="' . $this->descripcion . '"
                                    title="' . Yii::t('app', 'Delete Service Image: ')
                                    . $this->descripcion . '"></i>
                </div>';
            }
            $htmlResul = implode($strImgs);
        return $htmlResul;
    }

    /**
     * @param int $id
     * @return $htmlResul
     */
    public static function getImagenesServicioUrl($id) {
        $imgs = ImagenServicio::findAll(['servicio_id' => $id]);
        $urls = [];
        foreach($imgs as $key) {
            $urls[] = ['url' => $key->url, 'descripcion' =>$key->descripcion];
        }
        return $urls;
    }

    /**
     * @param int $id
     * @return $htmlResul
     */
    public function getImagenesServicioUrlThumb($id) {
        $imgs = ImagenServicio::findAll(['servicio_id' => $id]);
        return ArrayHelper::map($imgs, 'id', 'urlthumb');
    }

    /**
     * @param int $id Id del servicio del que se quiere ver las imágenes relacionadas
     * @return $htmlResult
     */
    public function creaPanelImgServ($id) {

        $str =  '<div id="infoImagenes" class="col-xs-12 well">
                <div class="col-xs-12">' .
                Collapse::widget([
                    'class' => 'btn-primary',
                    'encodeLabels' => false,
                    'items' => [
                        [
                            'label' =>   '<i class="fa fa-info-circle tbn" aria-hidden="true"> ' . Yii::t('app', 'About Service Images') . '</i> ',
                            'content' =>
                            '<p>'
                                . Yii::t('app', 'The images shown below are the ones that are currently saved and linked to the service ')
                                . '<span class="text-primary">' . $this->descripcion . '</span>.<br />'
                                . Yii::t('app', 'When placed on them, two icons will appear:')
                                . '<br/><i class="fa fa-eye text-success indented"> </i> '
                                . Yii::t('app', 'This is used to view the image and set it as a highlighted image.')
                                . '</br/><i class="fa fa-trash text-danger indented"> </i> '
                                .  Yii::t('app', 'This removes the image from the database and also from the server, so it is completely deleted.')
                                . '</br/><i class="fa fa-download text-danger indented"> </i> '
                                . Yii::t('app', 'Download a copy of the image if you want to keep it.')
                                . '</br/>
                            </p>'
                            // Descomentar lo siguiente si quiero que aparezca abierto por defecto
                            //'contentOptions' => ['class' => 'in'],
                        ],
                    ]
                ]) .
                '<div class="col-xs-12">' .
                $this->getImagenServicio($this->id) .
                '</div></div>';
        return $str;

    }

    /**
     * Obtener el listado de servicios para el Select2 de Inicio
    */
    public static function getListadescripciones() {
        $droptions = self::find()->orderBy('descripcion')->all();
        foreach($droptions as $key) {
            $imagen = '<img src="' . ImagenServicio::getLastImgThumb($key->id) . '" alt="' . $key->descripcion . '" />';
            $key->descripcion = '<span class="title">' . $key->descripcion . '</span>' . $imagen;
        }
        return ArrayHelper::map($droptions, 'id', 'descripcion');
    }

    /**
     * @param int $limit Número de servicios a mostrar
     * @return array
     */
    public function isTop($limit) {
        return $this->find()->select(['id', 'descripcion'])->orderBy(['puntuacion'=>SORT_DESC])->limit($limit)->indexBy('id')->all();
    }

    /** Devuelve un servicio aleatorio
     * @param bool $promo Si se devuelve un servicio con promoción o no
     * @return array
     */
    public static function getAleatServ($promo) {
        $id = "";
        if ($promo == "true") {
            $count = count(self::find()->where(['promocion' => true, 'activo' => true])->all());
            $pos = rand(1, $count);
            return Servicios::find()->select(['id'])->where(['promocion' => true, 'activo' => true])->offset($pos-1)->one();
        }  else {
            $count = count(self::find()->where(['activo' => true])->all());
            $pos = rand(1, $count);
            return Servicios::find()->select(['id'])->where(['activo' => true])->offset($pos-1)->one();
        }
    }

    /**
     * @param int $limit Número de servicios a mostrar
     * @return array
     */
    public function isNew($limit) {
        return $this->find()->select(['id', 'descripcion'])->orderBy(['updated_at' => SORT_DESC])->limit($limit)->indexBy('id')->all();
    }

    /**
     * @param int $num Número de servicios a mostrar
     * @param string $grid Tipo de display: col-xs-4 muestra 3 imgs, col-xs-6 muestra solo 2
     * @param bool $promo Indica si se muestran primero los servicios promocionados
     * @param bool $nuevos Indica si mostrar los servicios más actualizados o los más puntuados.
     * @return $htmlResul
     */
    public function getImagenTop($num, $grid, $promo = true, $nuevos = false) {
        $configVar = ConfigVars::find()->one();
        $servsNew = $this->isNew($configVar->cuantosNew);
        $servsTop = $this->isNew($configVar->cuantosTop);
        if ($promo) {
            if ($nuevos) {
                $imgs = self::find()->orderBy(['promocion' => SORT_DESC, 'updated_at' => SORT_DESC])->limit($num)->all();
            } else {
                $imgs = self::find()->orderBy(['promocion' => SORT_DESC, 'num_votos' => SORT_DESC])->limit($num)->all();
            }
        } else {
            if ($nuevos) {
                $imgs = self::find()->orderBy(['updated_at' => SORT_DESC])->limit($num)->all();
            } else {
                $imgs = self::find()->orderBy(['num_votos' => SORT_DESC])->limit($num)->all();
            }
        }
        $strImgs = array();
        foreach ($imgs as $key) {
            $url = ImagenServicio::getLastImg($key->id);
            $title = Yii::t('app', ImagenServicio::existsUrl($key->id, $url)->descripcion);
            $strImgs[] = '<div class="item col-xs-12 col-sm-6 ' . $grid . '">
                            <div class="thumbnail col-xs-12">'
                            . (array_key_exists($key->id, $servsTop) ? '<img src="imagenes/iconos/5star.png" alt="star" class="imgStar" />' : '')
                            . '<figure class="snip1295">'
                            . Html::img($url,
                            [
                                'class' => 'group list-group-image',
                                'alt' => $title,
                                'title' => $title,
                                'id' => "serv" . $key->id,
                            ])
                            . '<div class="border one">
                              <div></div>
                            </div>
                            <div class="border two" title="' . $title . '">
                              <div></div>'
                              . (($key->promocion && $promo) ? '<span class="promo">Anuncio</span>' : '')
                            . '</div>'
                            //. (self::isInTop($key->id,6) ? '<div class="ribete ribete-top-right"><span><i class="fa fa-star" aria-hidden="true"></i> Top</span></div>' : "")
                            . (array_key_exists($key->id, $servsNew) ? '<div class="ribete ribete-top-left"><span><i class="fa fa-fire" aria-hidden="true"></i> New</span></div>' : '')
                            . '</figure>
                            <div class="caption">
                              <h4 class="group inner list-group-item-heading">'
                            . $key->descripcion
                            . '</h4>
                              <p class="group inner list-group-item-text">'
                            . $key->descripcion_lg
                            . '</p>
                              <div class="row col-xs-12 text-center">'
                            . Html::a($key->precio .  " € <i class='fa fa-cart-plus unoycuarto' aria-hidden='true'> </i>", ["ventas/addcart", "id_servicio" => $key->id], ["class" => "btn btn-success unoycuarto", "title" => "Añadir al pedido" ])
                            . '</div>
                            </div>
                            </div>
                            </div>';
            }
        $htmlResul = implode($strImgs);
        return $htmlResul;
    }
}
