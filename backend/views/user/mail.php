<?php

/* @var $this yii\web\View
   @var $form yii\bootstrap\ActiveForm
   @var $user_id int
/* @var $model \backend\models\MailForm */

use Yii;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Mail to User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-mail">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('app', 'Mail to: ') . User::findModel($id)->email ?>
    </p>

    <div class="row">
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'mail-form']); ?>
                <div class="col-xs-12">
                    <?= $form->field($model, 'subject')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'mail-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
