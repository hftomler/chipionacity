<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Search'),
                    'content' => $this->render('_search', ['model' => $searchModel]),
                    // Descomentar lo siguiente si quiero que aparezca abierto por defecto
                    // 'contentOptions' => ['class' => 'in']
                ],
            ]
        ]);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'userIdLink', 'format'=>'raw'],
            ['attribute'=>'userLink', 'format'=>'raw'],
            ['attribute'=>'profileLink', 'format'=>'raw'],
            'email:email',
            'rolName',
            'userTypeName',
            'statusName',
            'created_at',
            // 'email:email',
            // 'status_id',
            // 'created_at',
            // 'updated_at',
            // 'rol_id',
            // 'user_type_id',
            // 'proveedor:boolean',

            ['class' => 'yii\grid\ActionColumn',
                             'visibleButtons' => [
                                 'update' => $show_this_nav,
                                 'delete' => $show_this_nav,
                             ],
            ],
        ],
    ]); ?>
</div>
