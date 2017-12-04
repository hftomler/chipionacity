<?php


use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servicios;
use yii\web\JsExpression;
use yii\helpers\Url;
/* @var $this yii\web\View */


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <img id="logoInicio" src="imagenes/logoInicio.png" class="col-xs-5 col-xs-offset-1" alt="logo">
        <p class="col-xs-5 titular">Experiencias inolvidables <i class="fa fa-heart" aria-hidden="true"></i>,
            en el lugar ideal <i class="fa fa-star" aria-hidden="true"></i><br/>
            a un <i class="fa fa-eur" aria-hidden="true"></i> espectacular <i class="fa fa-arrow-down" aria-hidden="true"></i></p>
    </div>

    <div class="body-content">
        <div class="col-xs-12"><?php $form = ActiveForm::begin(['options'=> ['enctype' => 'multipart/form-data']]); ?>
            <div class="col-xs-8 col-xs-offset-2">

            <?php
                $model = new Servicios();
                echo $form->field($model, 'id')->widget(Select2::classname(), [
                    'initValueText' => "hola esto es una prueba con imágenes", // set the initial display text
                    'options' => ['placeholder' => '¿Estás buscando algo que hacer ...?'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => Url::to('index.php?r=servicio/listaservicios'),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(results) {
                                                                img = "<img class=\'imgServicio-xs img-thumbnail\' src=\'" + results.url + "\'/>" + results.text;
                                                                return img;
                                                            }'),
                        'templateSelection' => new JsExpression('function (results) { return results.text; }'),
                    ],
                ]);?>
            </div>
        <?php ActiveForm::end(); ?></div>
    </div>
</div>
