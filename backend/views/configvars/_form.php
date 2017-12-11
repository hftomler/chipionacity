<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ConfigVars */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-vars-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12 text-center">
        <div class="col-xs-4 btn-success">
            <?= $form->field($model, 'includePromo')->checkbox() ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'ordPunt')->checkbox() ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'regUser')->checkbox() ?>
        </div>
    </div>


    <?= $form->field($model, 'numServIni1')->textInput() ?>

    <?= $form->field($model, 'numServIni2')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
