<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PermissionHelpers;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ImagenServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Images');
$this->params['breadcrumbs'][] = $this->title;
$show_this = PermissionHelpers::requireMinRol('proveedor');
$isProveedor = User::isProveedor(Yii::$app->user->identity->id);
?>

<div class="imagen-servicio-index">

    <h1>
        <?= Html::encode($this->title) ?>
        <?php
            if ($show_this) {
                    echo Html::a(Yii::t('app', 'Create Service Image'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view gvCenter'],
        'columns' => [
            ['attribute'=>'servicioLink', 'format'=>'raw'],
            ['attribute' => 'descripcion',
                'format' => 'html',
                'label' =>  Yii::t('app', 'Description'),
                'format'=>'raw',
                'value' => function ($data) {
                    return '<input class="form-control" name="ced' . $data->id . '" value="' . $data->descripcion . '" />';
                }
            ],
            ['attribute' => 'ultImg',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'label' => Yii::t('app', 'Profile Img.'),
                'value' => function ($data) {
                    return '<div class="imgWrapServ-xs">'
                              . Html::img($data['urlthumb'],
                                  ['class' => 'imgServicio-xs img-thumbnail',
                                   'title' => $data['descripcion']
                                  ]) .
                    '</div>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
