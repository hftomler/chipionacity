<?php

use yii\helpers\Html;
use common\models\ValueHelpers;

/* @var $this yii\web\View */

$this->title = Yii::t('app', "Administrator's Zone");
$isAdmin = ValueHelpers::getRolValue('Admin');
$isProv = ValueHelpers::getRolValue('Proveedor');
?>
<div class="site-index">
    <div class="jumbotron">
        <h1><i class="fa fa-cog" aria-hidden="true"></i> <?= Yii::t('app', "Welcome to Administrator's Zone") ?></h1>
        <p class="lead"><?= Yii::t('app', "You can manage users, roles and more with theese tools") ?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><i class="fa fa-users" aria-hidden="true"></i> <?= Yii::t('app', "Users") ?></h2>

                <p><?= Yii::t('app', "This is the place to manage users.") ?> <?= Yii::t('app', "You can edit status and roles from here.") ?>
                      <?= Yii::t('app', "The UI is easy to use and intuitive, just click the link below to get started.") ?>
                 </p>

                <p>
                    <?php
                        if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isAdmin) {
                            echo Html::a(Yii::t('app', 'Manage users'), ['user/index'], ['class' => 'btn btn-success']);
                        }
                    ?>
                </p>
            </div>

            <div class="col-lg-4">
                <h2><i class="fa fa-universal-access" aria-hidden="true"></i> <?= Yii::t('app', "Roles") ?></h2>

                <p><?= Yii::t('app', "This is where you manage Roles.") ?>
                      <?= Yii::t('app', "You can decide who is admin and who is not.") ?>
                      <?= Yii::t('app', "You can add a new role if you like, just click the link below to get started.") ?>
                 </p>

                <p>
                    <?php
                        if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isAdmin) {
                            echo Html::a(Yii::t('app', 'Manage roles'), ['rol/index'], ['class' => 'btn btn-success']);
                        }
                    ?>
                </p>
            </div>

            <div class="col-lg-4">
                <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> <?= Yii::t('app', "Profiles") ?></h2>

                <p><?= Yii::t('app', "Need to review Profiles?") ?>
                      <?= Yii::t('app', "This is the place to get it done.") ?>
                      <?= Yii::t('app', "These are easy to manage via UI. Just click the link below to manage profiles.") ?>
                 </p>

                <p>
                    <?php
                        if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isAdmin) {
                            echo Html::a(Yii::t('app', 'Manage profiles'), ['profile/index'], ['class' => 'btn btn-success']);
                        }
                    ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h2><i class="fa fa-check" aria-hidden="true"></i> <?= Yii::t('app', "Statuses") ?></h2>

                <p><?= Yii::t('app', "This is where you manage Statutes.") ?>
                    <?= Yii::t('app', "You can add or delete.") ?>
                    <?= Yii::t('app', "You can add a new status if you like, just click the link below to get started.") ?>
                </p>

                <p>
                    <?php
                    if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isAdmin) {
                        echo Html::a(Yii::t('app', 'Manage statuses'), ['status/index'], ['class' => 'btn btn-success']);
                    }
                    ?>
                </p>
            </div>

            <div class="col-lg-4">
                <h2><i class="fa fa-eye-slash" aria-hidden="true"></i>
                        <i class="fa fa-eye" aria-hidden="true"></i> <?= Yii::t('app', "User Types") ?>
                </h2>

                <p><?= Yii::t('app', "This is the place to manage user types.") ?>
                    <?= Yii::t('app', "You can edit user types from here.") ?>
                    <?= Yii::t('app', "The UI is easy to use and intuitive, just click the link below to get started") ?>
                </p>

                <p>
                    <?php
                    if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isAdmin) {
                        echo Html::a(Yii::t('app', 'Manage users type'), ['user-type/index'], ['class' => 'btn btn-success']);
                    }
                    ?>
                </p>
            </div>

                        <div class="col-lg-4">
                            <h2><i class="fa fa-comments" aria-hidden="true"></i>
                                    <i class="fa fa-map-signs" aria-hidden="true"></i> <?= Yii::t('app', "Services") ?>
                            </h2>

                            <p><?= Yii::t('app', "This is the place to manage site Services.") ?>
                                <?= Yii::t('app', "You can edit services from here.") ?>
                                <?= Yii::t('app', "The UI is easy to use and intuitive, just click the link below to get started") ?>
                            </p>

                            <p>
                                <?php
                                if (!Yii::$app->user->isGuest  && Yii::$app->user->identity->rol_id >=$isProv) {
                                    echo Html::a('Manage Services', ['servicio/index'], ['class' => 'btn btn-success']);
                                }
                                ?>
                            </p>
                        </div>
            </div>
    </div>
</div>
