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

                <p id="errorLogin" class="alert-danger"></p>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-check-circle" aria-hidden="true"></i> Continuar', ['class' => 'btn btn-success btn-login collapse col-xs-12', 'name' => 'signup-button', 'id' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
		$('#signupform-username').change(function() {
                $('#errorLogin').html("");
                $.post('index.php?r=user/usexists&username=' +
                       $(this).val(),
                            function(data) {
                                if (!data) {
                                    $('#signup-button').collapse("hide");
                                    $('#signupform-username').select();
                                    $('#signupform-username').focus();
                                    muestraError("El nombre de usuario ya existe");
                                } else {
                                    $('#login-button').collapse("show");
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
                                };
                            });
            }
        });

        function muestraError($error) {
            $('#errorLogin').html($error);
        }

        function validate() {

        }

</script>
