<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use backend\models\ImagenProfile;


/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'well', 'enctype' => 'multipart/form-data']]); ?>

    <div class="col-xs-10">
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?>
        </div>
        <div class="col-xs-12 col-sm-8">
            <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 45]) ?>
        </div>
        <div class="col-xs-8">
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'gender_id')->dropDownList($model->genderList, ['prompt' => 'Género' ]);?>
        </div>
    </div>
    <div class="col-xs-2 text-center">
        <?php $imgPerfil = ImagenProfile::getLastImg($model->id) ?  ImagenProfile::getLastImg($model->id) :
                                    "imagenes/imgPerfil/sinPerfil.jpg"; ?>
        <?= Html::img($imgPerfil, [ 'id' => 'swImgPerfil',
                                            'class' => 'imgPerfil-md img-circle img-thumbnail',
                                            'title' => 'Avatar - Clic para cambiar',
                                            'alt' => 'Imagen de perfil'
                                        ]);
        ?>
        <?= $form->field($model, 'fichImage')->fileInput([
                                        'id' => 'btImgPerfil',
                                        'value' => 'Género',
                                        'style' =>'display:none'
                                    ])->label(''); ?>
    </div>

    <div class="col-xs-12">
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'pais_id')->widget(Select2::classname(), [
                        'data' => $model->listaPaises,
                        'options' => ['placeholder' => 'País ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'provincia_id')->widget(Select2::classname(), [
                        'data' => $model->listaProvincias,
                        'options' => ['placeholder' => 'Provincia ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'municipio_id')->dropDownList($model->listaMunicipios, ['prompt' => 'Población' ]);?>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="col-xs-6">
            <?= $form->field($model, 'cpostal')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
                        'language' => 'es',
                        'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'dd/mm/yyyy'
                        ]
                    ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
