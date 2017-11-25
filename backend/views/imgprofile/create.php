<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImagenProfile */

$this->title = Yii::t('app', 'Create Imagen Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imagen Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagen-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
