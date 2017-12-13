<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\PermissionHelpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');
?>
<div class="user-index">

    <h1>
        <?= Html::encode($this->title) ?>
        <?php
            if ($show_this_nav) {
                    echo Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>
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
                            'template' => '{view} {update} {delete} {mail}',
                            'buttons' => [
                                'mail' => function ($url) {
                                    return Html::a(
                                        '<i class="fa fa-envelope unoycuarto" aria-hidden="true"></i>',
                                        Url::to($url, true),
                                        [
                                            'title' => Yii::t('app', 'Mail this user'),
                                            'id'=>'modalMail',
                                        ]
                                    );
                                },
                            ],
                             'visibleButtons' => [
                                 'update' => $show_this_nav,
                                 'delete' => $show_this_nav,
                             ],
            ],
        ],
    ]); ?>
</div>
