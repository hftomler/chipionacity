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
    NavBar::begin([
        'brandLabel' => '<img id="logo" src="imagenes/logo.png" alt="logo">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
           'class' => 'navbar',
        ],
    ]);
    $menuItems = [
        ['label' => '<i class="fa fa-home" aria-hidden="true"></i><br/>Home', 'url' => ['/site/index']],
        ['label' => '<i class="fa fa-building-o" aria-hidden="true"></i><br/>About', 'url' => ['/site/about']],
        ['label' => '<i class="fa fa-envelope-o" aria-hidden="true"></i><br/>Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-id-card-o" aria-hidden="true"></i><br/>Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i><br/>Login',  'url' => ['/site/login'],
                     'linkOptions' => [
                           'value' => Url::to('index.php?r=site/login'),
                           'id'=>'modalLogin'],
                     ];
    } else {
        $menuItems[] = ['label' => '<i class="fa fa-user-plus" aria-hidden="true"></i><br/>Profile', 'url' => ['/profile/view']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="fa fa-power-off" aria-hidden="true"></i><br/>'  . Yii::$app->user->identity->username,
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
    <?php
        Modal::begin([
                'header'=>'<h3>Login</h3>',
                'id'=>'modalLoginContent',
                'size'=>'modal-md',
                'footer'=>'<h3>Pié de modal',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><img id="logo" src="imagenes/logo.png" alt="logo" height="35"></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
