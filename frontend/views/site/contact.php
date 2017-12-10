<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('app', 'Please leave your questions or comments. We will get in touch with you as soon as possible.') ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="col-xs-5">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($model, 'subject') ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ])->label("") ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($model, 'proveedor')->checkbox()->label(Yii::t('app', ''))?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
