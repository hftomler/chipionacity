<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">


    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <p><?= Yii::t('app','Please fill out the following fields to signup:') ?></p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableAjaxValidation' => true]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-check-circle" aria-hidden="true"></i> Continuar', ['class' => 'btn btn-success btn-login collapse col-xs-12', 'name' => 'signup-button', 'id' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    $('#form-signup input').blur (function () {
        var camposRellenados = true;
        $('#form-signup').find("input").each(function() {
        var $this = $(this);
                if( $this.val().length <= 0 ) {
                    camposRellenados = false;
                    return false;
                }
        });
        if(camposRellenados == false) {
            $('#signup-button').collapse("hide");
        }
        else {
            $('#signup-button').collapse("show");
        }
    });

</script>
