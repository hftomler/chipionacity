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
        <div id="balloon1" class="opener box"
                data-addoverlay="false"
                data-css="balloon-large"
                data-highlight="false"
                data-overlaycolor="linear-gradient(135deg, #337ab7 0%, #ff7e00 100%)"
                data-overlayopacity=".10"
                data-bgcolor="#337ab7"
                data-forceposition="up"
                data-balloon= "Haz clic en <i class='fa fa-user-circle-o' aria-hidden='true'></i>
                                         para cargar una imagen de perfil o seleccionar una de la galería"
                data-timer="6000"
                data-onlyonce="true"
                style="">
        </div>
        <?php $imgPerfil = ImagenProfile::getLastImg($model->id); ?>
        <?= Html::img($imgPerfil, [ 'id' => 'swImgPerfil',
                                            'class' => 'imgPerfil-md img-circle img-thumbnail',
                                            'title' => 'Avatar - Clic para cambiar',
                                            'alt' => 'Imagen de perfil'
                                        ]);
        ?>
        <div class="check-sm">
            <input id="checkAvatar" name="checkAvatar" class="check" type="checkbox" checked="cheked"> <?= Yii::t('app', 'Avatar List') ?>
            <input id="valueAvatar" name="valueAvatar" type="hidden" class="form-control" />
        </div>
        <div id="balloon2" class="opener box"
            data-addoverlay="false"
            data-css="balloon-large"
            data-highlight="false"
            data-overlaycolor="linear-gradient(135deg, #337ab7 0%, #ff7e00 100%)"
            data-overlayopacity=".10"
            data-bgcolor="#337ab7"
            data-forceposition="down"
            data-balloon= "Desmarque el <i class='fa fa-check-square-o' aria-hidden='true'></i>
            para seleccionar una imagen de su propio dispositivo"
            data-timer="6000"
            data-onlyonce="true"
            style="">
        </div>
        <?= $form->field($model, 'fichImage')->fileInput([
                                        'id' => 'btImgPerfil',
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
    <div class="clearfix"></div>
    <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
