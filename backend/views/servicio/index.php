<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
$show_this = PermissionHelpers::requireMinRol('proveedor');
?>

<div class="servicios-index">
    <?= var_dump(Yii::$app->user->identity->id) ?>

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcion',
            'precio',
            'proveedor_id',
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
