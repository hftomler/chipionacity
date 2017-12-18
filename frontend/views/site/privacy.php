<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Privacy Matters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-privacy">
    <h1><?= Html::encode($this->title) ?></h1>

    <h3><?= Yii::t('app', 'Privacy matters but it can be confusing. This page explains our approach to privacy on our website and how it affects you.') ?></h3>
    <h3>
        <ul class="list-unstyled">
            <li>
                <i class="fa fa-pie-chart" aria-hidden="true"></i> <i class="fa fa-bar-chart" aria-hidden="true"></i> <?= Yii::t('app', 'We collect anonymous statistics about your visit, like which of our pages you viewed.') ?>
            </li>
            <li>
                <i class="fa fa-twitter" aria-hidden="true"></i> <i class="fa fa-facebook-official" aria-hidden="true"></i> <?= Yii::t('app', 'Some 3rd parties like Facebook and Twitter may know you visited this website, if you use their services. We can’t control them but we don’t believe this knowledge poses any threat to you.') ?>
            </li>
            <li>
                <i class="fa fa-lock" aria-hidden="true"></i> <i class="fa fa-shield" aria-hidden="true"></i> <?= Yii::t('app', 'If you sign up with us we take great care to keep your information safe and we’ll never share it with others without your express permission.') ?>
            </li>
            <li>
                <i class="fa fa-minus-circle" aria-hidden="true"></i> <i class="fa fa-share-alt" aria-hidden="true"></i> <?= Yii::t('app', 'We never share your data with 3rd parties except to help us deliver our own services.') ?>
            </li>
        </ul>
    </h3>
    <h3><?= Yii::t('app', 'These are just the key points. If you need detail, contact us') ?></h3>

</div>
