<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="jumbotron">
        <h3><?= Yii::t('app', 'We\'re sorry but the user registration is not currently activated. Try again later.') ?></h3>
        <div class="exclError"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
    </div>

</div>
