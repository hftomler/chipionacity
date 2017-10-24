<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$url = ($model->img_perfil) ? $model->img_perfil : 'imagenes/imgPerfil/sinPerfil.jpg';
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(['options'=> ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-xs-10 col-sm-8">
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>
    </div>
    <div class="col-xs-2 col-sm-4">
        <?= Html::img($url, [ 'id' => 'swImgPerfil',
                                            'class' => 'img-circle',
                                            'title' => 'Imagen de perfil',
                                            'alt' => 'Funky Looking Image'
                                        ]);
        ?>
        <?= $form->field($model, 'fichImage')->fileInput([
                                        'id' => 'btImgPerfil',
                                        'value' => 'Género',
                                        'style' =>'display:none'
                                    ])->label(''); ?>
    </div>

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
