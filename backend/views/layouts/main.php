<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\assets\FontAwesomeAsset;
use frontend\models\Profile;
use backend\models\ImagenProfile;
use common\models\RecordHelpers;
use common\models\PermissionHelpers;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $is_admin = PermissionHelpers::requireMinRol('admin');
    $is_prov = PermissionHelpers::requireMinRol('proveedor');
    $isAvatar = ((Yii::$app->controller->action->id == 'avatar') ? true : false);
    $isIndex =  ((Yii::$app->controller->action->id == 'index') ? true : false);
    setcookie("isIndex", $isIndex);
    if (!Yii::$app->user->isGuest) { //Logo para administradores
        NavBar::begin([
            'brandLabel' => '<img id="logo" class="js-tilt" src="imagenes/logofb.png" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
               'class' => 'navbar',
            ],
        ]);
    } else {  //Logo para usuarios NO administradores
        NavBar::begin([
            'brandLabel' => '<img id="logo" class="js-tilt" src="imagenes/logo70px.png" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
               'class' => 'navbar',
            ],
        ]);
    }

    if (!$isAvatar) {
        $menuItems = [
            ['label' => '<i class="fa fa-home" aria-hidden="true"></i><br/>Home', 'url' => ['/site/index']],
        ];
    } else {
        $menuItems = [];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i><br/>' . Yii::t('app', 'Login') , 'url' => ['/site/login']];
    } else {
        if ($is_admin && !$isAvatar) {
            $menuItems[] = ['label' => '<i class="fa fa-users" aria-hidden="true"></i><br/>' . Yii::t('app', 'Users') , 'url' => ['user/index']];
            $menuItems[] = ['label' => '<i class="fa fa-address-card-o" aria-hidden="true"></i><br/>' . Yii::t('app', 'Profiles') , 'url' => ['profile/index']];
            $menuItems[] = ['label' => '<i class="fa fa-universal-access" aria-hidden="true"></i><br/>' . Yii::t('app', 'Roles') , 'url' => ['/rol/index']];
            $menuItems[] = ['label' => '<i class="fa fa-eye-slash" aria-hidden="true"></i><i class="fa fa-eye" aria-hidden="true"></i><br/>' . Yii::t('app', 'User Types') , 'url' => ['/user-type/index']];
            $menuItems[] = ['label' => '<i class="fa fa-check" aria-hidden="true"></i><br/>' . Yii::t('app', 'Status') , 'url' => ['/status/index']];
        }
        if ($is_prov) {
            $menuItems[] = ['label' => '<i class="fa fa-users" aria-hidden="true"></i><br/>' . Yii::t('app', 'Services') , 'url' => ['/servicio']];
        }
        $profileId = RecordHelpers::userHas('profile') ? Profile::find()->where(['user_id' => Yii::$app->user->id])->one()->id : false;
        if ($profileId) {
            $prof = ['label' => '<i class="fa fa-eye" aria-hidden="true"></i> Profile', 'url' => ['/profile/view']];
            $imgNav = ImagenProfile::getLastImg($profileId);
        } else {
            $prof = ['label' => '<i class="fa fa-plus-square" aria-hidden="true"></i> Profile', 'url' => ['/profile/view']];
            $imgNav = "imagenes/imgPerfil/sinPerfil.jpg";
        }
        $menuItems[] = [ 'label' => '<img src="' . $imgNav . '" class="imgPerfilInicio-xs img-circle" title="' . Yii::$app->user->identity->username . '"/>',
                        'items' => [
                             ['label' => '<i class="fa fa-sign-out" aria-hidden="true"></i>' . Yii::t('app', 'Logout') .
                                         ' <span class="cnred">(' . Yii::$app->user->identity->username . ')</span>',
                                         'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
                             '<li class="divider"></li>',
                             $prof,
                        ],
                    ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    echo ' <img src="imagenes/iconos/adminzone.png" class="ribbon-left" />';
    echo ' <img src="imagenes/iconos/restrictedAreaOr.png" class="ribbon" />';
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="pull-left text-left col-xs-4">&copy; My Company <?= date('Y') ?></div>
            <div class="text-center col-xs-4">
                <div class="small col-xs-4"><?= Yii::t('app', "Languages:") ?> </div>
                <?php
                foreach(Yii::$app->params['languages'] as $key => $language) {
                    echo '<div class="col-xs-2">';
                    echo ' <img src="imagenes/iconos/' . $key . '.png"  id="' . $key . '" class="language" title="' . $language . '"/>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="pull-right text-right col-xs-4"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>
})
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
