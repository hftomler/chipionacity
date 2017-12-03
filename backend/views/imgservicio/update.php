<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImagenServicio */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Imagen Servicio',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imagen Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="imagen-servicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>