<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

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

    <?= $form->field($model, 'pais_id')->dropDownList($model->listaPaises,

            [
                'prompt' => 'País',
                'onchange' => '
                    $.post( "index.php?r=profile/listaprov&id='.'"+$(this).val(), function ( data ) {
                        $( "select#profile-provincia_id" ).html( data );
                    });'
            ]);?>

    <?= $form->field($model, 'provincia_id')->dropDownList($model->listaProvincias,

            [
                'prompt' => 'Provincia',
                'onchange' => '
                    $.post( "index.php?r=profile/listamuni&id='.'"+$(this).val(), function ( data ) {
                        $( "select#profile-municipio_id" ).html( data );
                    });'
            ]);?>

    <?= $form->field($model, 'municipio_id')->dropDownList($model->listaMunicipios, ['prompt' => 'Población' ]);?>

    <?= $form->field($model, 'cpostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
        'language' => 'es',
        'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
