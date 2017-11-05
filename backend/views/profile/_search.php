<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Profile;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'nombre') ?>
    </div>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'apellidos') ?>
    </div>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
            'language' => 'es',
            'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
            'pluginOptions' => [
                'autoclose'=>true
            ]
        ]); ?>
    </div>

    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'gender_id')->dropDownList(Profile::getgenderList(), [ 'prompt' => 'Sexo' ]);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
