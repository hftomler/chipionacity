<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = $model->username;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Yii::t('app', 'Profile:') ?><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && $show_this_nav) {
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'userLink', 'format'=>'raw'],
            'nombre',
            'apellidos',
            'fecha_nac',
            'gender.gender_name',
            'created_at',
            'updated_at',
            'id',
        ],
    ]) ?>

</div>
