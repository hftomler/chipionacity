<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\ValueHelpers;
use backend\assets\FontAwesomeAsset;
use common\widgets\Alert;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */

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
    $is_admin = ValueHelpers::getRolValue('Admin');
    if (!Yii::$app->user->isGuest) {
        NavBar::begin([
            'brandLabel' => 'Chipiona City <i class="fa fa-plug"></i> Administración',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
    } else {
        NavBar::begin([
            'brandLabel' => 'Chipiona City <i class="fa fa-plug"></i>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);        
    }

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id >= $is_admin) {
        $menuItems[] = ['label' => 'Usuarios', 'url' => ['user/index']];
        $menuItems[] = ['label' => 'Perfiles', 'url' => ['profile/index']];
        $menuItems[] = ['label' => 'Roles', 'url' => ['/rol/index']];
        $menuItems[] = ['label' => 'Tipos Usuario', 'url' => ['/user-type/index']];
        $menuItems[] = ['label' => 'Tipos Estatus', 'url' => ['/status/index']];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span><br/>Login',  'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<span class="glyphicon glyphicon-off"></span><br/>'  . Yii::$app->user->identity->username,
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
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
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
