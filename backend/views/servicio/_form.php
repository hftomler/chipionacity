<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\User;
use yii\bootstrap\Collapse;
//use yii\base\View;

/* @var $this yii\web\View */
/* @var $model backend\models\Servicios */
/* @var $form yii\widgets\ActiveForm */
$isProv = User::isProveedor(Yii::$app->user->identity->id);
($isProv)? $model->proveedor_id = Yii::$app->user->identity->id : "";
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'well', 'enctype' => 'multipart/form-data']]); ?>

    <div class="col-xs-12">
        <div class="col-xs-12 col-sm-8">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-xs-12 col-sm-4">
            <?php
                if (!$isProv) {
                        echo $form->field($model, 'proveedor_id')->dropDownList($model->proveedorList, ['prompt' => Yii::t('app', 'Supplier Id') ]);
                } else {
                        echo Html::activeTextInput($model, 'proveedor_id', ['value'=> Yii::$app->user->identity->id, 'style' => 'display:none']);
                        echo Html::beginTag('div', ['class' => 'form-group field-servicios-proveedor_id required']);
                            echo '<label class="control-label" for=servicios-proveedor_id" >' . Yii::t('app', 'Supplier Id') . '</label>';
                            echo Html::textInput('prov',
                                                 Yii::$app->user->identity->id . ': ' . Yii::$app->user->identity->username,
                                                 ['class' => 'form-control', 'disabled' => true ]);
                            echo Html::tag('div', '', ['class' => 'help-block']);
                        echo Html::endTag('div');
                }
            ?>
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
    <div class="col-xs-12">
        <?= $form->field($model, 'fichImage[]')->widget(FileInput::classname(), [
            'options'=>[
                'accept'=>'image/*', 'multiple'=>true
            ]
            /*'pluginOptions'=>[
                'previewClass' => 'col-xs-12',
                'frameClass' => 'col-xs-6 col-sm-4 col-md-3 krajee-default'
            ]*/
            ]);
        ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $iNR = $model->isNewRecord ? '1' : '0' ?>
    <div id="infoImagenes" data-inr="<?= $iNR ?>" class="col-xs-12 well">
        <div class="col-xs-12">
            <?php echo Collapse::widget([
                'class' => 'btn-primary',
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' =>   '<i class="fa fa-info-circle tbn" aria-hidden="true"> ' . Yii::t('app', 'About Service Images') . '</i> ',
                        'content' =>
                        '<p>'
                            . Yii::t('app', 'The images shown below are the ones that are currently saved and linked to the service ')
                            . '<span class="text-primary">' . $model->descripcion . '</span>.<br />'
                            . Yii::t('app', 'When placed on them, two icons will appear:')
                            . '<br/><i class="fa fa-eye text-success indented"> </i> '
                            . Yii::t('app', 'This is used to view the image and set it as a highlighted image.')
                            . '</br/><i class="fa fa-trash text-danger indented"> </i> '
                            .  Yii::t('app', 'This removes the image from the database and also from the server, so it is completely deleted.')
                            . '</br/><i class="fa fa-download text-danger indented"> </i> '
                            . Yii::t('app', 'Download a copy of the image if you want to keep it.')
                            . '</br/>
                        </p>'
                        // Descomentar lo siguiente si quiero que aparezca abierto por defecto
                        //'contentOptions' => ['class' => 'in'],
                    ],
                ]
            ]);

            ?>
        </div>
        <div class="col-xs-12">
            <?= $model->getImagenServicio($model->id); ?>
        </div>
    </div>

</div>
