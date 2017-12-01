<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\User;
use yii\bootstrap\Collapse;

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

    <div class="col-xs-12 well">
        <div class="col-xs-12 col-sm-6">
            <?= $model->getImagenServicio($model->id); ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?php echo Collapse::widget([
                'class' => 'btn-primary',
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' =>   '<i class="fa fa-info-circle tbn" aria-hidden="true"> ' . Yii::t('app', 'About Service Images') . '</i> ',
                        'content' =>
                            '<p>
                                Las imágenes que se muestran a su izquierda son las que actualmente están guardadas y enlazadas con el servicio <span class="text-primary">
                                ' . $model->descripcion . '</span>.<br />
                                Al situarse sobre ellas, aparecerán dos iconos:<br/>
                                     <i class="fa fa-eye text-success indented"></i> Este sirve para establecer la imagen como predeterminada, actualizando el campo updated_at.</br/>
                                     <i class="fa fa-trash text-danger indented"></i> Este elimina la imagen de la base de datos y también del servidor, por lo que se borra completamente.</br/>
                            </p>
                            '
                        // Descomentar lo siguiente si quiero que aparezca abierto por defecto
                        //'contentOptions' => ['class' => 'in'],
                    ],
                ]
            ]);

            ?>
        </div>
    </div>

</div>
