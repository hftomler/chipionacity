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
        'options' => ['class' => 'grid-view gvCenter'],
        /*'rowOptions' => function ($model, $key, $index, $grid) {
                                        return PermissionHelpers::userMustBeOwner('servicios', $key) ?
                                                    ['class' => 'miPerfil'] :
                                                    '';
                                    },*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'descripcion',
            'precio',
            ['attribute'=>(Yii::t('app', 'Supplier')),
                            'value'=>function ($model, $key, $index, $column) {
                                return $model->proveedor->username;
                            },
                            'visible' => (!$isProveedor),
            ],
            ['attribute' => 'ultImg',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'label' => Yii::t('app', 'Profile Img.'),
                'value' => function ($data) {
                    return Html::img(ImagenServicio::getLastImg($data['id']),
                        ['class' => 'imgServicio-xs img-thumbnail']);
                },
            ],
            'activo:boolean',
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
