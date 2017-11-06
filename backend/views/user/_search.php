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
    <div class="col-xs-2 col-sm-3 col-lg-4">
        <?= $form->field($model, 'id')?>
    </div>
    <div class="col-xs-10 col-sm-9 col-lg-8">
        <?= $form->field($model, 'username')?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'rol_id')->dropDownList(User::getrolList(), [ 'prompt' => Yii::t('app', 'Role') ]);?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'user_type_id')->dropDownList(User::getuserTypeList(), [ 'prompt' => Yii::t('app', 'User Type')  ]);?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'status_id')->dropDownList($model->statusList, [ 'prompt' => Yii::t('app', 'State') ]);?>
    </div>
    <div class="form-group col-xs-12">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
