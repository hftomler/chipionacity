<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->dropDownList($model->statusList, [ 'prompt' => 'Elige Estado' ]); ?>
    <?= $form->field($model, 'rol_id')->dropDownList($model->rolList, [ 'prompt' => 'Elige Rol' ]);?>
    <?= $form->field($model, 'user_type_id')->dropDownList($model->userTypeList, [ 'prompt' => 'Elige Tipo de Usuario' ]);?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'proveedor')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
