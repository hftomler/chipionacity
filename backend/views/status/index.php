<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Statuses');
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');
?>
<div class="status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Status'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status_name',
            'status_value',

            ['class' => 'yii\grid\ActionColumn',
                             'visibleButtons' => [
                                 'update' => $show_this_nav,
                                 'delete' => $show_this_nav,
                             ],
            ],
        ],
    ]); ?>
</div>
