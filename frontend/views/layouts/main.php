<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use frontend\assets\FontAwesomeAsset;
use frontend\models\Profile;
use backend\models\ImagenProfile;
use common\models\RecordHelpers;
use backend\models\ConfigVars;
use backend\models\Ventas;

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
    $controller = Yii::$app->controller;
    $default_controller = Yii::$app->defaultRoute;
    $isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
    $navClass = $isHome ? 'navbar inicio' : 'navbar';
    NavBar::begin([
        'brandLabel' => $isHome ? '<img id="logo" class="invisible " alt="Logotipo de Chipiona City" src="' . ConfigVars::find()->one()->logoHomeft . '">' : '<img id="logo" src="imagenes/logo.png" alt="logo">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
           'class' => $navClass,
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [ 'label' => '<i class="fa fa-id-card-o" aria-hidden="true"></i> ' . Yii::t('app', 'My Profile'),
                     'items' => [
                         ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i> ' . Yii::t('app', 'Sign In'),  'url' => ['/site/login'],
                         'linkOptions' => [
                             'value' => Url::to('index.php?r=site/login'),
                             'id'=>'modalLogin'],
                         ],
                          ['label' => '<i class="fa fa-id-card-o" aria-hidden="true"></i> ' . Yii::t('app', 'Are you new?'), 'url' => ['/site/signup'],
                                       'linkOptions' => [
                                             'value' => Url::to('index.php?r=site/signup'),
                                             'id'=>'modalSignup'],
                            ],
                        ['label' => '<i class="fa fa-envelope-o" aria-hidden="true"></i> ' . Yii::t('app', 'Contact with us!'), 'url' => ['/site/contact'],
                                     'linkOptions' => [
                                           'value' => Url::to('index.php?r=site/contact'),
                                           'id'=>'modalContact'],
                          ],
                      ],
                  ];
    } else {
        $profileId = RecordHelpers::userHas('profile') ? Profile::find()->where(['user_id' => Yii::$app->user->id])->one()->id : false;
        if ($profileId) {
            $prof = ['label' => '<i class="fa fa-eye" aria-hidden="true"></i> ' . Yii::t('app', 'Profile'), 'url' => ['/profile/view']];
            $imgNav = ImagenProfile::getLastImg($profileId);
        } else {
            $prof = ['label' => '<i class="fa fa-plus-square" aria-hidden="true"></i> ' . Yii::t('app', 'Profile'), 'url' => ['/profile/create']];
            $imgNav = "imagenes/imgPerfil/sinPerfil.jpg";
        }
        $menuItems[] = ['label' => '<div id="carroNav">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="numServCarro">' . Ventas::numLineas() . '</span></div>', 'url' => ['/venta/vercarro']];
        $menuItems[] = [ 'label' => '<img src="' . $imgNav . '" class="imgPerfil-xs img-circle" title="' . Yii::$app->user->identity->username . '"/>',
                        'items' => [
                             ['label' => '<i class="fa fa-sign-out" aria-hidden="true"></i> ' . Yii::t('app', 'Logout') .
                                         ' <span class="cnred">(' . Yii::$app->user->identity->username . ')</span>',
                                         'url' => ['/site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
                             '<li class="divider"></li>',
                             $prof,
                             ['label' => '<i class="fa fa-envelope-o" aria-hidden="true"></i> ' . Yii::t('app', 'Contact with us!'), 'url' => ['/site/contact'],
                             'linkOptions' => [
                                 'value' => Url::to('index.php?r=site/contact'),
                                 'id'=>'modalContact'],
                             ],
                        ],
                    ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="toplinkChici"><a href="#" class="h1" title="ir al inicio"><span class="glyphicon glyphicon-arrow-up"></a></div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="pull-left text-left col-xs-4">&copy; Chipiona City<?= date('Y') ?></div>
            <div class="text-center col-xs-4">
                <div class="small col-xs-4"><?= Yii::t('app', "Languages:") ?> </div>
                <?php
                foreach(Yii::$app->params['languages'] as $key => $language) {
                    echo '<div class="col-xs-2">';
                    echo ' <img src="imagenes/iconos/' . $key . '.png"  id="' . $key . '" class="language" title="' . $language . '" alt="' . $language . '"/>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="pull-right text-right col-xs-4"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

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
    'id'=>'modalLoginContent',
    'size'=>'modal-md',
    'footer'=>$modalFooter,
]);

echo "<div id='modalContentLogin'></div>";

Modal::end();
?>
<?php
Modal::begin([
    'header'=>$modalHeader,
    'id'=>'modalSignupContent',
    'size'=>'modal-md',
    'footer'=>$modalFooter,
]);

echo "<div id='modalContentSignup'></div>";

Modal::end();
?>
<?php
Modal::begin([
    'header'=>$modalHeader,
    'id'=>'modalContactContent',
    'size'=>'modal-lg',
    'footer'=>$modalFooter,
]);

echo "<div id='modalContentContact'></div>";

Modal::end();
?>
</body>
</html>
<?php $this->endPage() ?>
