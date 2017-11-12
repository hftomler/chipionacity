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
            echo Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
        'template' => '<tr><th class="col-xs-3">{label}</th><td class="col-xs-9">{value}</td></tr>',
        'attributes' => [
            'fullName:html:Full Name (username)',
            'fullAdress',
            'gender.gender_name',
            ['attribute'=>'fecha_nac', 'format' => ['date', 'php:d-m-Y']
            ],
            ['attribute'=>'created_at', 'format' => ['date', 'php:d-m-Y']
            ],
            ['attribute'=>'updated_at', 'format' => ['date', 'php:d-m-Y']
            ],
            ['attribute' => 'avatar',
                //'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'label' => 'Imágenes perfil',
                'value' => $imgs,
            ],
        ],
    ])?>
</div>
