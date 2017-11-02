<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\PermissionHelpers;
use common\models\User;
use backend\models\ImagenProfile;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinRol('superAdmin');
$usuario = new User();
$usuario->id = Yii::$app->user->identity->id;
$tp = $usuario->getProfileId();
?>

<div class="profile-index">
    <h1>
        <?= Html::encode($this->title) ?>
        <?php
            if ($tp == 'ninguno') {
                    echo Html::a(Yii::t('app', 'Create Profile'), ['create'], ['class' => 'pull-right btn btn-success']);
            }
        ?>
    </h1>
    <?php echo Collapse::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' =>   '<i  class="fa fa-search" aria-hidden="true"></i> ' . Yii::t('app', 'Search'),
                    'content' => $this->render('_search', ['model' => $searchModel]),
                    // Descomentar lo siguiente si quiero que aparezca abierto por defecto
                    //'contentOptions' => ['class' => 'in'],
                ],
            ]
        ]);

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view gvCenter'],
        'rowOptions' => function ($model, $key, $index, $grid) {
                                        return PermissionHelpers::userMustBeOwner('profile', $key) ?
                                                    ['class' => 'miPerfil'] :
                                                    '';
                                    },
        'columns' => [
            //['attribute'=>'profileIdLink', 'format'=>'raw'],
            'id',
            'nombre',
            'apellidos',
            ['attribute'=>'fecha_nac', 'format' => ['date', 'php:d-m-Y'],
            'contentOptions' => ['class' => 'text-center'],
            ],
            ['attribute' => 'avatar',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'label' => 'ImgPerfil',
                'value' => function ($data) {
                    return Html::img(ImagenProfile::getLastImg($data['id']),
                        ['height' => '40px',
                         'class' => 'imgPerfil-xs img-circle']);
                },
            ],
            ['attribute' => 'genderName',
                'contentOptions' => ['class' => 'text-center'],
            ],
            ['attribute' => 'nombrePais',
                'contentOptions' => ['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                             'visibleButtons' => [
                                 'update' => function ($data, $key, $show_this_nav) {
                                                        return $show_this_nav && PermissionHelpers::userMustBeOwner('profile', $key);
                                                    },
                                 'delete' => function ($data, $key, $show_this_nav) {
                                                        return $show_this_nav && PermissionHelpers::userMustBeOwner('profile', $key);
                                                    },
                             ],
            ],
        ],
    ]); ?>
</div>
