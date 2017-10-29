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
use common\models\ValueHelpers;
use frontend\assets\FontAwesomeAsset;
use frontend\models\Profile;
use common\models\RecordHelpers;

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
    $is_admin = ValueHelpers::getRolValue('admin');
    if (!Yii::$app->user->isGuest) { //Logo para administradores
        NavBar::begin([
            'brandLabel' => '<img id="logo" src="imagenes/logo70px.png" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
               'class' => 'navbar',
            ],
        ]);
    } else {  //Logo para usuarios NO administradores
        NavBar::begin([
            'brandLabel' => '<img id="logo" src="imagenes/logo70px.png" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
               'class' => 'navbar',
            ],
        ]);
    }

    $menuItems = [
        ['label' => '<i class="fa fa-home" aria-hidden="true"></i><br/>Home', 'url' => ['/site/index']],
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i><br/>Login', 'url' => ['/site/login']];
    } elseif (Yii::$app->user->identity->rol_id >= $is_admin) {
        $menuItems[] = ['label' => '<i class="fa fa-users" aria-hidden="true"></i><br/>Usuarios', 'url' => ['user/index']];
        $menuItems[] = ['label' => '<i class="fa fa-address-card-o" aria-hidden="true"></i><br/>Perfiles', 'url' => ['profile/index']];
        $menuItems[] = ['label' => '<i class="fa fa-universal-access" aria-hidden="true"></i><br/>Roles', 'url' => ['/rol/index']];
        $menuItems[] = ['label' => '<i class="fa fa-eye-slash" aria-hidden="true"></i><i class="fa fa-eye" aria-hidden="true"></i><br/>Tip. Usuarios', 'url' => ['/user-type/index']];
        $menuItems[] = ['label' => '<i class="fa fa-check" aria-hidden="true"></i><br/>Status', 'url' => ['/status/index']];
        $imgNav =  RecordHelpers::userHas('profile') ?
                            Profile::find()->where(['user_id' => Yii::$app->user->id])->one()->imgPath :
                            "imagenes/imgPerfil/sinPerfil.jpg";
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<img src="' . $imgNav . '" class="imgPerfil-xs img-circle" title="' . Yii::$app->user->identity->username . '"/>',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
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
    </div>
</div>

<footer class="footer">
    <div class="container text-center">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <?php
            foreach(Yii::$app->params['languages'] as $key => $language) {
                echo ' <img src="imagenes/iconos/' . $key . '.png"  id="' . $key . '" class="language" title="' . $language . '"/> ';
            }
        ?>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
