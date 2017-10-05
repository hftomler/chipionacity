<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pais;
use common\models\Provincia;
use kartik\date\DatePicker;

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('frontend','Please fill out the following fields to signup:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableAjaxValidation' => true]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <a href="#adic" class="pull-right" data-toggle="collapse">Datos adic...</a>

                <div id="adic" class="collapse">

                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'pais_id')->dropDownList(
                            ArrayHelper::map(Pais::find()->orderBy('desc_pais')->all(),'id', 'desc_pais'),
                            ['prompt'=>'Selecciona País']
                    ) ?>

                    <?= $form->field($model, 'provincia_id')->dropDownList(
                            ArrayHelper::map(Provincia::find()->orderBy('desc_provincia')->all(),'id', 'desc_provincia'),
                            ['prompt'=>'Selecciona Provincia']
                    ) ?>

                    <?= $form->field($model, 'provincia_id')->textInput() ?>

                    <?= $form->field($model, 'municipio_id')->textInput() ?>

                    <?= $form->field($model, 'cpostal')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'fecha_nac')->widget(kartik\date\DatePicker::className(), [
                                                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                                                        'removeButton' => false,
                                                                                        'pluginOptions' => [
                                                                                            'todayHighlight' => true,
                                                                                            'todayBtn' => true,
                                                                                            'autoclose'=>true,
                                                                                            'format' => 'dd-mm-yyyy'
                                                                                        ]
                                                                                    ]);
                    ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
