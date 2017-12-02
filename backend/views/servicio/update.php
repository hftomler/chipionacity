<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Servicios',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descripcion, 'url' => ['view', 'id' => $model->id]];
?>
<div class="servicios-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
