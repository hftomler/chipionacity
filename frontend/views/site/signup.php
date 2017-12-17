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

                <div id="errorSignup" class="alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p></p>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-check-circle" aria-hidden="true"></i> Continuar',
                                          ['class' => 'btn btn-success btn-login collapse col-xs-12',
                                           'name' => 'signup-button', 'id' => 'signup-button', 'disabled' => 'disabled'])
                    ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
        $('#errorSignup').hide();
        $('#signupform-username').change(function() {
            $('#errorSignup').hide();
            if (valida()) {
                $('#errorLogin').hide();

                $('#signup-button').collapse("show");
                $('#signup-button').removeAttr('disabled');
            } else {
                $('#signup-button').collapse("hide");
            }
        });

        $('#signupform-email').change(function() {
            $('#errorSignup').hide();
            if (valida()) {
                $('#signup-button').collapse("show");
                $('#signup-button').removeAttr('disabled');
            } else {
                $('#signup-button').collapse("hide");
            }
        });

        $('#signupform-password').change(function() {
            $('#errorSignup').hide();
            if (valida()) {
                $('#signup-button').collapse("show");
                $('#signup-button').removeAttr('disabled');
            } else {
                $('#signup-button').collapse("hide");
            }
        });

        function valida() {
            var result = true;
            var patremail = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if ($('#signupform-username').val().length <6 ) {
                muestraError("El nombre de usuario debe tener al menos 6 caracteres.");
                $('#signupform-username').select();
                $('#signupform-username').focus();
                return false;
            }
            if (!patremail.test($('#signupform-email').val())) {
                muestraError("El email no es válido");
                $('#signupform-email').select();
                $('#signupform-email').focus();
                return false;
            }
            if ($('#signupform-password').val().length == 0) {
                muestraError("La contraseña debe contener algún carácter");
                $('#signupform-password').select();
                $('#signupform-password').focus();
                return false;
            }
            return result;
        }

        function muestraError($error) {
            $('#errorSignup > p').html($error);
            $('#errorSignup').show();        }

</script>
