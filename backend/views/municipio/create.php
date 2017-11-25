<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Municipio */

$this->title = Yii::t('app', 'Create Municipio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Municipios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
