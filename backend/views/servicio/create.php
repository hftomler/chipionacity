<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */

$this->title = Yii::t('app', 'Create Servicios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
