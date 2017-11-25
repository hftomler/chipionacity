<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'precio') ?>

    <?= $form->field($model, 'proveedor_id') ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <?php // echo $form->field($model, 'tipo_iva_id') ?>

    <?php // echo $form->field($model, 'duracion') ?>

    <?php // echo $form->field($model, 'duracion_unidad_id') ?>

    <?php // echo $form->field($model, 'puntuacion') ?>

    <?php // echo $form->field($model, 'num_votos') ?>

    <?php // echo $form->field($model, 'media_punt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
