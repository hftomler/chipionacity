<?php


use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servicios;
use yii\web\JsExpression;
use yii\helpers\Url;
use backend\models\ImagenPubli;
use backend\models\ConfigVars;
/* @var $this yii\web\View */


$this->title = 'My Yii Application';
$model = new Servicios();
$big = "col-md-6";
$small = "col-md-4";
$xsmall = "col-md-3";
$confVars = ConfigVars::find()->one();
?>

<div class="site-index">

    <div class="jumbotron">
        <img id="logoInicio" src="imagenes/logohome.png" class="col-xs-5 col-xs-offset-1" alt="logo">
        <p class="col-xs-5 titular"><?= Yii::t('app', 'Unforgettable experiences <i class = "fa fa-heart" aria-hidden = "true"> </ i>,
            in the ideal place <i class = "fa fa-star" aria-hidden = "true"> </ i>
            to a spectacular price <i class = "fa fa-arrow-down" aria-hidden = "true"> </ i> <i class = "fa fa-eur" aria-hidden = "true"> </ i>') ?></p>
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
                    'addon' => [
                        'prepend' => [
                            'content' => Html::icon('lightbulb-o', ['class' => 'unoymedio', 'id' => 'tenerSuerte'], 'fa fa-')
                        ],
                        'append' => [
                            'content' => Html::icon('search', ['class' => 'unoymedio'], 'fa fa-')
                        ]
                    ],
                ])->label('');?>
            </div>
        </div>
        <?php ActiveForm::end(); ?></div>
    </div>

        <div class="clearfix"></div>
        <div id="top1" class="container">
            <div id='servDetalle' class="well col-xs-12"></div>
            <div class="well well-sm col-xs-12">
                <div class="pull-right">
                    <a href="#container" class="btn btn-default btn-sm listServ">
                        <i class="fa fa-th-list text-primary" aria-hidden="true" title="<?= Yii::t('app', 'List') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm bigServ">
                        <i class="fa fa-th-large text-primary" aria-hidden="true" title="<?= Yii::t('app', 'Big Photos') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm gridServ">
                        <i class="fa fa-th text-primary" aria-hidden="true" title="<?= Yii::t('app', 'Medium Photos') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm gridSmallServ">
                        <i class="fa fa-braille text-primary" aria-hidden="true" title="<?= Yii::t('app', 'Big Photos') ?>"></i>
                    </a>
                </div>
                <div class="titUpdateBig"><i class="fa fa-picture-o" aria-hidden="true"></i> <?= Yii::t('app', 'Discover our latest services') ?></div>
            </div>
            <div class="row list-group products">
                <?= $model->getImagenTop($confVars->numServIni1, $xsmall, $confVars->includePromo, $confVars->ordPunt); // Muestra los que NO tienen promo y ordenados por puntuacion?>
            </div>
        </div>
        <div id="publi1hz" class="col-xs-6"><?= ImagenPubli::getImagenPubli(true, false) ?></div>
        <div id="publi2hz" class="col-xs-6"><?= ImagenPubli::getImagenPubli(true, false) ?></div>
        <div id="top2" class="container">
            <div class="well well-sm col-xs-12">
                <div class="pull-right">
                    <a href="#container" class="btn btn-default btn-sm listServ">
                        <i class="fa fa-th-list" aria-hidden="true" title="<?= Yii::t('app', 'List') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm bigServ">
                        <i class="fa fa-th-large" aria-hidden="true" title="<?= Yii::t('app', 'Big Photos') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm gridServ">
                        <i class="fa fa-th" aria-hidden="true" title="<?= Yii::t('app', 'Medium Photos') ?>"></i>
                    </a>
                    <a href="#container" class="btn btn-default btn-sm gridSmallServ">
                        <i class="fa fa-th" aria-hidden="true" title="<?= Yii::t('app', 'Medium Photos') ?>"></i>
                    </a>
                </div>
                <div class="titUpdateBig"><i class="fa fa-picture-o" aria-hidden="true"></i> <?= Yii::t('app', 'Our most rated services ') ?></div>
            </div>
            <div class="row list-group products">
                <?= $model->getImagenTop($confVars->numServIni2, $big, false, true); // Muestra los que NO tienen promo y los más nuevos?>
            </div>
            <div id="publi2" class="col-xs-4"><?= ImagenPubli::getImagenPubli(true, true) ?></div>
            <div class="weather col-xs-4">Cádiz</div>
            <div id="publi3" class="col-xs-4"><?= ImagenPubli::getImagenPubli(true, true) ?></div>
        </div>

</div>
