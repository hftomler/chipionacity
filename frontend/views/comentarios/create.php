<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Comentarios */

$this->title = Yii::t('app', 'Create Comentarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
