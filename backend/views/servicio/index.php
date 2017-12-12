<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PermissionHelpers;
use common\models\User;
use backend\models\ImagenServicio;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
$show_this = PermissionHelpers::requireMinRol('proveedor');
$isProveedor = User::isProveedor(Yii::$app->user->identity->id);
?>

<div class="servicios-index">
    <h1>
        <?= Html::encode($this->title) ?>
        <?php
            if ($show_this) {
                    echo Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view gvCenter'],
        'columns' => [
            'descripcion',
            'precio',
            ['attribute'=>(Yii::t('app', 'Service Provider')),
                            'value'=>function ($model, $key, $index, $column) {
                                return $model->proveedor->username;
                            },
                            'visible' => (!$isProveedor),
            ],
            ['attribute' => 'ultImg',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'label' => Yii::t('app', 'Profile Img.'),
                'format'=>'raw',
                'value' => function ($data, $model) {
                    $ball = ($model == 1) ?
                            '<div id="balloon1" class="opener box"
                                    data-addoverlay="false"
                                    data-css="balloon-large"
                                    data-highlight="false"
                                    data-overlaycolor="linear-gradient(135deg, #337ab7 0%, #ff7e00 100%)"
                                    data-overlayopacity=".10"
                                    data-bgcolor="#337ab7"
                                    data-forceposition="up"
                                    data-balloon= "Haz clic en la  imagen para acceder a las imágenes relacionadas de cada servicio."
                                    data-timer="6000"
                                    data-onlyonce="true"
                                    style="">
                            </div>' : '';
                    return $ball . '<div class="imgWrapServ-xs"><a href="index.php?ImagenServicioSearch[servicio_id]=' . $data->id . '&r=imgservicio%2Findex">'
                              . Html::img(ImagenServicio::getLastImgThumb($data['id']),
                                  ['class' => 'imgServicio-xs img-thumbnail']) .
                    '</a></div>';
                },
            ],
            ['attribute' => 'activo',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'value' => function ($data) {
                    $valor = '<i class="fa fa-check-square-o text-primary unoymedio"></i>';
                    if (!$data->activo) {
                        $valor = '<i class="fa fa-times-circle text-danger unoymedio"></i>';
                    }
                    return $valor;
                }
            ],
            // 'tipo_iva_id',
            // 'duracion',
            // 'duracion_unidad_id',
            // 'puntuacion',
            // 'num_votos',
            // 'media_punt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
