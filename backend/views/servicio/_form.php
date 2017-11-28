<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'well', 'enctype' => 'multipart/form-data']]); ?>

    <div class="col-xs-12">
        <div class="col-xs-12 col-sm-8">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'proveedor_id')->dropDownList($model->proveedorList, ['prompt' => Yii::t('app', 'Supplier Id') ]);?>
        </div>
        <div class="col-xs-6 col-md-3">
            <?= $form->field($model, 'precio')->textInput() ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <?= $form->field($model, 'tipo_iva_id')->dropDownList($model->ivaList, ['prompt' => Yii::t('app', 'Vat %') ]);?>
        </div>
        <div class="col-xs-6 col-md-3">
            <?= $form->field($model, 'duracion')->textInput() ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <?= $form->field($model, 'duracion_unidad_id')->dropDownList($model->duracionList, ['prompt' => Yii::t('app', 'Time Unit') ]);?>
        </div>
        <div class="col-xs-12 col-sm-12">
            <?= $form->field($model, 'activo')->checkbox() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
