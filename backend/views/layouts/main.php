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
use yii\bootstrap\Modal;
use frontend\assets\FontAwesomeAsset;
use frontend\models\Profile;
use backend\models\ImagenProfile;
use common\models\RecordHelpers;
use common\models\PermissionHelpers;
use kartik\dialog\Dialog;

// Inializando la instancia del Kartik Dialog
echo Dialog::widget([
   'libName' => 'krajeeDialog',
   'options' => [
        'title' => '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '
                  . Yii::t('app', 'Delete confirm')
                  . ' <i class="fa fa-exclamation-circle" aria-hidden="true"></i>',
        'draggable' => true,
        'type' => Dialog::TYPE_PRIMARY,
        'btnOKClass' => 'btn-danger',
        'btnOKLabel' => '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' . Yii::t('app', 'Confirm'),
        'btnCancelClass' => 'btn-success',
        'btnCancelLabel' => '<i class="fa fa-bullseye" aria-hidden="true"></i> ' . Yii::t('app', 'Exit')
   ], // default options
]);
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
    $isAdmin = PermissionHelpers::requireMinRol('admin');
    $isSadmin = PermissionHelpers::requireMinRol('superAdmin');
    $isProv = PermissionHelpers::requireMinRol('proveedor');
    $isAvatar = ((Yii::$app->controller->action->id == 'avatar') ? true : false);
    $isSite = ((Yii::$app->controller->id == 'site') ? true : false);
    $isIndex =  ((Yii::$app->controller->action->id == 'index') ? true : false);
    setcookie("inicio", ($isSite && $isIndex));
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
               'class' => 'navbar text-left',
            ],
        ]);
    }

    if (!$isAvatar) {
        $menuItems = [
            ['label' => '<i class="fa fa-home unoycuarto" aria-hidden="true"></i><br/>Home', 'url' => ['/site/index']],
        ];
    } else {
        $menuItems = [];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i><br/> ' . Yii::t('app', 'Login') , 'url' => ['/site/login']];
    } else {
        $profileId = RecordHelpers::userHas('profile') ? Profile::find()->where(['user_id' => Yii::$app->user->id])->one()->id : false;
        if ($profileId) {
            $prof = ['label' => '<i class="fa fa-eye" aria-hidden="true"></i>' . Yii::t('app', 'Profile'), 'url' => Url::toRoute(['profile/view', 'id' => $profileId])];
            $imgNav = ImagenProfile::getLastImg($profileId);
        } else {
            $prof = ['label' => '<i class="fa fa-plus-square" aria-hidden="true"></i> ' . Yii::t('app', 'Profile'), 'url' => ['/profile/create']];
            $imgNav = "imagenes/imgPerfil/sinPerfil.jpg";
        }
        if ($isAdmin && !$isAvatar) {
            $menuItems[] = [ 'label' => '<i class="fa fa-bars unoycuarto" aria-hidden="true"></i><br/>',
                             'items' => [
                                    ['label' => '<i class="fa fa-users" aria-hidden="true"></i> ' . Yii::t('app', 'Users') , 'url' => ['user/index']],
                                    ['label' => '<i class="fa fa-address-card-o" aria-hidden="true"></i> ' . Yii::t('app', 'Profiles') , 'url' => ['profile/index']],
                                    ['label' => '<i class="fa fa-universal-access" aria-hidden="true"></i> ' . Yii::t('app', 'Roles') , 'url' => ['/rol/index']],
                                    ['label' => '<i class="fa fa-eye-slash" aria-hidden="true"></i> <i class="fa fa-eye" aria-hidden="true"></i> ' . Yii::t('app', 'User Types') , 'url' => ['/user-type/index']],
                                    ['label' => '<i class="fa fa-check" aria-hidden="true"></i> ' . Yii::t('app', 'Status') , 'url' => ['/status/index']],
                                    ['label' => '<i class="fa fa-comments" aria-hidden="true"></i> ' . '<i class="fa fa-map-signs" aria-hidden="true"></i> ' . Yii::t('app', 'Services') , 'url' => ['/servicio']]
                                ]
                            ];
            $configIcon = ($isSadmin) ? ['label' => '<i class="fa fa-cogs" aria-hidden="true"></i> Config', 'url' => Url::toRoute(['configvars/update', 'id' => 1])]: '';
            $menuItems[] = [ 'label' => '<img src="' . $imgNav . '" class="imgPerfilInicio-xs img-circle" title="' . Yii::$app->user->identity->username . '"/>',
                'items' => [
                    ['label' => '<i class="fa fa-sign-out" aria-hidden="true"></i> ' . Yii::t('app', 'Logout') .
                    ' <span class="cnred">(' . Yii::$app->user->identity->username . ')</span>',
                    'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
                    '<li class="divider"></li>',
                    $prof,
                    $configIcon,
                ],
            ];
        } else {
            if ($isProv && !$isAvatar) {
                $menuItems[] = [ 'label' => '<img src="' . $imgNav . '" class="imgPerfilInicio-xs img-circle" title="' . Yii::$app->user->identity->username . '"/>',
                    'items' => [
                        ['label' => '<i class="fa fa-sign-out" aria-hidden="true"></i> ' . Yii::t('app', 'Logout') .
                        ' <span class="cnred">(' . Yii::$app->user->identity->username . ')</span>',
                        'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
                        '<li class="divider"></li>',
                        ['label' => '<i class="fa fa-comments" aria-hidden="true"></i> ' . '<i class="fa fa-map-signs" aria-hidden="true"></i> ' . Yii::t('app', 'Services') , 'url' => ['/servicio']],
                        $prof,
                    ],
                ];
            }
        }
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
<?php
$modalHeader = '<p class="text-center">
                                <img class="text-center" id="logo" src="imagenes/logo.png" alt="logo">
                            </p>';
$modalFooter = '<p>
                                <i class="fa fa-copyright" aria-hidden="true"></i> Chipiona City ' .
                                date('Y') .
                           '</p>';
Modal::begin([
    'header'=>$modalHeader,
    'id'=>'modalMailContent',
    'size'=>'modal-md',
    'footer'=>$modalFooter,
]);

echo "<div id='modalContentMail'></div>";

Modal::end();
?>
</body>
</html>
<?php $this->endPage() ?>
