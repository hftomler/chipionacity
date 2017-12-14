<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Ventas */

$this->title = Yii::t('app', 'Create Ventas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
