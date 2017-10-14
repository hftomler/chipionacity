<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = "Perfil de " . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?php
            if (PermissionHelpers::userMustBeOwner('profile', $model->id)) {
                Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            }
            Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'user.username',
            'nombre',
            'apellidos',
            'gender.gender_name',
            'direccion',
            'pais_id',
            'municipio_id',
            'cpostal',
            'provincia_id',
            'fecha_nac',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
