<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ConfigVars */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-vars-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'well']]); ?>

    <div class="col-xs-12 text-center">
        <div class="col-xs-3">
            <?= $form->field($model, 'includePromo')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'ordPunt')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'regUser')->checkbox() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'offline')->checkbox() ?>
        </div>
    </div>

    <div class="col-xs-12 text-center">
        <div class="col-xs-3">
            <?= $form->field($model, 'numServIni1')->textInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'numServIni2')->textInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'classBloq1')->textInput() ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'classBloq2')->textInput() ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'logoHomeft')->textInput() ?>
        </div>
        <div class="col-xs-6">
            <?php $imgPerfil = $model->logoHomeft; ?>
            <?= Html::img($imgPerfil, [ 'id' => 'swLogoHomeft',
                                                'title' => 'Logo: - ' . Yii::t('app', 'Click to change'),
                                                'class' => 'swLogoHomeft',
                                                'alt' => Yii::t('app', 'Logo Home Page')
                                            ]);
            ?>
            <input id="valueLogo" name="valueLogo" type="hidden" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
