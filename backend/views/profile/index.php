<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

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

            ['attribute'=>'profileIdLink', 'format'=>'raw'],
            //No funciona
            //['attribute'=>'userLink', 'format'=>'raw'],
            //'id', Ya aparece en el link de arriba
            'nombre',
            'apellidos',
            'fecha_nac',
            'genderName',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
