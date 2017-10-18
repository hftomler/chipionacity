<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellidos') ?>

    <?= $form->field($model, 'gender_id') ?>

    <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
        'language' => 'es',
        'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
