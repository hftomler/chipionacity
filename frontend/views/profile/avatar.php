<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;
use common\models\User;
use backend\models\ImagenProfile;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Selecciona tu Avatar');
?>
<h1 id="titulo" class="text-center"><?= $this->title ?></h1>
