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
                    echo Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Imagen Servicio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'servicio_id',
            'descripcion',
            'url:url',
            'urlthumb:url',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
