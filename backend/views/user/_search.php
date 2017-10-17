<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'rol_id')->dropDownList(User::getrolList(), [ 'prompt' => 'Rol' ]);?>
    <?= $form->field($model, 'user_type_id')->dropDownList(User::getuserTypeList(), [ 'prompt' => 'Tipo Usuario' ]);?>
    <?= $form->field($model, 'status_id')->dropDownList($model->statusList, [ 'prompt' => 'Estado' ]);?>

    <?= $form->field($model, 'proveedor')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
