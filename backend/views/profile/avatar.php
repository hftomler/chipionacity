<?php

$this->registerJsFile(
    '@web/js/avatar.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = Yii::t('app', 'Selecciona tu Avatar');
?>
<h1 id="titulo" class="text-center"><?= $this->title ?></h1>
