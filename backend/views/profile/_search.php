<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Profile;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellidos') ?>

    <?= $form->field($model, 'fecha_nac') ?>
    
    <?= $form->field($model, 'gender_id')->dropDownList(Profile::getgenderList(), [ 'prompt' => 'Sexo' ]);?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'pais_id') ?>

    <?php // echo $form->field($model, 'municipio_id') ?>

    <?php // echo $form->field($model, 'cpostal') ?>

    <?php // echo $form->field($model, 'provincia_id') ?>

    <?php // echo $form->field($model, 'fecha_nac') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
