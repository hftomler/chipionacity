<?php


use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servicios;
use yii\web\JsExpression;
use yii\helpers\Url;
/* @var $this yii\web\View */


$this->title = 'My Yii Application';
$model = new Servicios();
var_dump($model->getImagenServicioUrl(1));

?>
<div class="site-index">

    <div class="jumbotron">
        <img id="logoInicio" src="imagenes/logohome.png" class="col-xs-5 col-xs-offset-1" alt="logo">
        <p class="col-xs-5 titular">Experiencias inolvidables <i class="fa fa-heart" aria-hidden="true"></i>,
            en el lugar ideal <i class="fa fa-star" aria-hidden="true"></i><br/>
            a un <i class="fa fa-eur" aria-hidden="true"></i> espectacular <i class="fa fa-arrow-down" aria-hidden="true"></i></p>
    </div>

    <div class="body-content">
        <div class="col-xs-12"><?php $form = ActiveForm::begin(['options'=> ['enctype' => 'multipart/form-data']]); ?>
            <div class="col-xs-8 col-xs-offset-2">

            <?php
                echo $form->field($model, 'id')->widget(Select2::classname(), [
                    'initValueText' => "", // set the initial display text
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
                                                                img = "<div class=\'imgWrapServ-xs\'>" +
                                                                           "<img class=\'imgServicio-xs img-thumbnail\' src=\'" + results.url + "\'/>" +
                                                                       "</div>" + results.text + "<i class=\'pull-right\'>" + results.precio + "</i>";
                                                                return img;
                                                            }'),
                        'templateSelection' => new JsExpression('function (results) { return results.text; }'),
                    ],
                ])->label('');?>
            </div>
        <?php ActiveForm::end(); ?></div>
    </div>

        <div class="clearfix"></div>
        <div name="container" class="container">
            <div class="well well-sm">
                <strong>Display</strong>
                <div class="btn-group">
                    <a href="#container" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
                    <a href="#container" id="big" class="btn btn-default btn-sm"><i class="fa fa-th-large" aria-hidden="true"></i> Big</a>
                    <a href="#container" id="grid" class="btn btn-default btn-sm"><i class="fa fa-th" aria-hidden="true"></i> Medium</a>
                </div>
            </div>
            <div id="products" class="row list-group">
                <?= $model->getImagenTop(20); ?>
            </div>
        </div>

</div>
