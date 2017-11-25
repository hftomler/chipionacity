<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'proveedor_id')->textInput() ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <?= $form->field($model, 'tipo_iva_id')->textInput() ?>

    <?= $form->field($model, 'duracion')->textInput() ?>

    <?= $form->field($model, 'duracion_unidad_id')->textInput() ?>

    <?= $form->field($model, 'puntuacion')->textInput() ?>

    <?= $form->field($model, 'num_votos')->textInput() ?>

    <?= $form->field($model, 'media_punt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
