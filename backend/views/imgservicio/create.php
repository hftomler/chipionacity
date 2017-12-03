<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImagenServicio */

$this->title = Yii::t('app', 'Create Imagen Servicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imagen Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagen-servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
