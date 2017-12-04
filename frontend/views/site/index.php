<?php


use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servicios;
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
                <?php $model = new Servicios(); ?>
                <?= $form->field($model, 'id')->widget(Select2::classname(), [
                            'data' => $model->listaDescripciones,
                            'options' => ['placeholder' => '¿Qué buscas  ...?'],
                            'size' => Select2::LARGE,
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'addon' => [
                                'prepend' => [
                                    'content' => Html::icon('lightbulb-o', ['class' => 'unoymedio'], 'fa fa-')
                                ],
                                'append' => [
                                    'content' => Html::icon('search', ['class' => 'unoymedio'], 'fa fa-')
                                ]
                            ],
                        ])->label('');
                ?>
            </div>
        <?php ActiveForm::end(); ?></div>
    </div>
</div>
