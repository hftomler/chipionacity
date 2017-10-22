<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\PermissionHelpers;
use common\models\User;

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
            'items' => [
                [
                    'label' =>   Yii::t('app', 'Search'),
                    'encode' => true,
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

            ['attribute'=>'profileIdLink', 'format'=>'raw'],
            //No funciona
            //['attribute'=>'userLink', 'format'=>'raw'],
            //'id', Ya aparece en el link de arriba
            'nombre',
            'apellidos',
            ['attribute'=>'fecha_nac', 'format' => ['date', 'php:d-m-Y']
            ],
            'genderName',
            ['class' => 'yii\grid\ActionColumn',
                             'visibleButtons' => [
                                 'update' => $show_this_nav,
                                 'delete' => $show_this_nav,
                             ],
            ],
        ],
    ]); ?>
</div>
