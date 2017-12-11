<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ConfigVars */

$this->title = Yii::t('app', 'Create Config Vars');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Config Vars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-vars-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
