<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php // Recuperamos todas las imágenes de perfil que ha tenido el usuario.?>
    <?php $imgs = $model->getImagenServicio($model->id); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descripcion',
            'precio',
            'proveedor_id',
            'activo:boolean',
            ['attribute' => 'foto',
                //'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'label' => 'Imágenes perfil',
                'value' => $imgs,
            ],
            'tipo_iva_id',
            'duracion',
            'duracion_unidad_id',
            'puntuacion',
            'num_votos',
            'media_punt',
        ],
    ]) ?>

</div>
