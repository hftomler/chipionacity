<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Types');
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');
?>
<div class="user-type-index">

    <h1>
        <?= Html::encode($this->title) ?>
        <?php
            if ($show_this_nav) {
                    echo Html::a(Yii::t('app', 'Create User Type'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_type_name',
            'user_type_value',

            ['class' => 'yii\grid\ActionColumn',
                             'visibleButtons' => [
                                 'update' => $show_this_nav,
                                 'delete' => $show_this_nav,
                             ],
            ],
        ],
    ]); ?>
</div>
