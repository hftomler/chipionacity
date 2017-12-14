<?php

$this->registerJsFile(
    '@web/js/logos.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = Yii::t('app', 'Select the Home Frontend Logo');
?>
<h1 id="titulo" class="text-center"><?= $this->title ?></h1>
