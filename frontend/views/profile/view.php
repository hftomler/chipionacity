<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */



$this->title = $model->user->username;
$owner = PermissionHelpers::userMustBeOwner('profile', $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Yii::t('app', 'Profile:') ?><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($owner){
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);
        }?>
    </p>

    <?php // Recuperamos todas las imágenes de perfil que ha tenido el usuario.?>
    <?php $imgs = $model->getImagenProfile($model->id); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'userLink', 'format'=>'raw'],
            'nombre',
            'apellidos',
            'gender.gender_name',
            ['attribute' => 'avatar',
                //'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'label' => 'Imágenes perfil',
                'value' => $imgs,
            ],
            ['attribute'=>'fecha_nac', 'format' => ['date', 'php:d-m-Y']
            ],
            ['attribute'=>'created_at', 'format' => ['date', 'php:d-m-Y']
            ],
            ['attribute'=>'updated_at', 'format' => ['date', 'php:d-m-Y']
            ],
        ],
    ])?>
</div>
