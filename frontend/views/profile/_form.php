<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'gender_id')->dropDownList($model->genderList, ['prompt' => 'Género' ]);?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais_id')->widget(Select2::classname(), [
                'data' => $model->listaPaises,
                'options' => ['placeholder' => 'País ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>

    <?= $form->field($model, 'provincia_id')->widget(Select2::classname(), [
                'data' => $model->listaProvincias,
                'options' => ['placeholder' => 'Provincia ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>

    <?= $form->field($model, 'municipio_id')->dropDownList($model->listaMunicipios, ['prompt' => 'Población' ]);?>

    <?= $form->field($model, 'cpostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
        'language' => 'es',
        'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd/mm/yyyy'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
