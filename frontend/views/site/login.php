<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\backend\controllers\UserController;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <p>
                <?= Yii::t('app','Please fill out the following fields to login:') ?>
            </p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?= Yii::t('app','If you forgot your password you can') ?>
                    <?= Html::a(Yii::t('app','reset it'), ['site/request-password-reset']) ?>.
                </div>

                <p id="errorLogin" class="alert-danger"></p>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-check-circle" aria-hidden="true"></i> Continuar',
                                          ['class' => 'btn btn-success btn-login collapse col-xs-12',
                                           'name' => 'login-button', 'id' => 'login-button', 'disabled' => 'disabled'])
                    ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
		$('#loginform-username').change(function() {
            if ($('#loginform-password').val()) {
                $('#errorLogin').html("");
                $.post('index.php?r=user/usexists&username=' +
                       $(this).val() + '&password=' + $('#loginform-password').val() ,
                            function(data) {
                                if (!data) {
                                    $('#login-button').collapse("hide");
                                    $('#loginform-username').select();
                                    $('#loginform-username').focus();
                                    muestraError();
                                } else {
                                    $('#login-button').collapse("show");
                                    $('#login-button').removeAttr('disabled');
                                };
                            });
            }
		});

        $('#loginform-password').change(function() {
            if ($('#loginform-username').val()) {
                $('#errorLogin').html("");
                $.post('index.php?r=user/usexists&username=' +
                        $('#loginform-username').val() + '&password=' + $(this).val() ,
                            function(data) {
                                if (!data) {
                                    $('#login-button').collapse("hide");
                                    $('#loginform-username').select();
                                    $('#loginform-username').focus();
                                    muestraError();
                                } else {
                                    $('#login-button').collapse("show");
                                    $('#login-button').removeAttr('disabled');
                                };
                            });
            }
        });

        function muestraError() {
            $('#errorLogin').html("El nombre de usuario y contraseña no son válidos");
        }
</script>
