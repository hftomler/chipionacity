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

?>
<div class="site-index">

    <div class="jumbotron">
        <img id="logoInicio" src="imagenes/logohome.png" class="col-xs-5 col-xs-offset-1" alt="logo">
        <p class="col-xs-5 titular"><?= Yii::t('app', 'Unforgettable experiences <i class = "fa fa-heart" aria-hidden = "true"> </ i>,
            in the ideal place <i class = "fa fa-star" aria-hidden = "true"> </ i> <br/>
            to a spectacular <i class = "fa fa-arrow-down" aria-hidden = "true"> </ i> <i class = "fa fa-eur" aria-hidden = "true"> </ i>') ?></p>
    </div>

    <div class="body-content">
        <div class="col-xs-12"><?php $form = ActiveForm::begin(['options'=> ['enctype' => 'multipart/form-data']]); ?>
            <div class="col-xs-8 col-xs-offset-2">

            <?php
                $waiting = "function () { return '" . Yii::t('app', 'Waiting results...') . "'; }";
                echo $form->field($model, 'id')->widget(Select2::classname(), [
                    'initValueText' => "", // set the initial display text
                    'options' => ['placeholder' => Yii::t('app', 'Are you looking for something to do ...?')],
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
            <div class="well well-sm col-xs-12">
                <div class="pull-right">
                    <a href="#container" id="list" class="btn btn-default btn-sm">
                        <i class="fa fa-th-list" aria-hidden="true" title="<?= Yii::t('app', 'List') ?>"></i>
                    </a>
                    <a href="#container" id="big" class="btn btn-default btn-sm">
                        <i class="fa fa-th-large" aria-hidden="true" title="<?= Yii::t('app', 'Big Photos') ?>"></i>
                    </a>
                    <a href="#container" id="grid" class="btn btn-default btn-sm">
                        <i class="fa fa-th" aria-hidden="true" title="<?= Yii::t('app', 'Medium Photos') ?>"></i>
                    </a>
                </div>
                <div class="text-center"><h4><?= Yii::t('app', 'Descubre nuestros servicios más recientes') ?></h4></div>
            </div>
            <div id="products" class="row list-group">
                <?= $model->getImagenTop(20, true); ?>
            </div>
        </div>

</div>
