<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && $show_this_nav) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                    'method' => 'post',
           ],
        ]);
        }?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'profileLink', 'format'=>'raw'],
            'id',
            //'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'statusName',
            'rolName',
            ['attribute'=>'created_at', 'format' => ['date', 'php:d-m-Y'],
            'label' => Yii::t('app', 'Created at'),
            ],
            ['attribute'=>'updated_at', 'format' => ['date', 'php:d-m-Y'],
            'label' => Yii::t('app', 'Updated at'),
            ],
            //'rol_id',
            //'user_type_id',
            //'proveedor:boolean',
        ],
    ]) ?>

</div>
