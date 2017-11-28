<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;

class UpgradeController extends \yii\web\Controller {

    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only'  => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireStatus('Activo');
                        }
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {

       	if ($id_perfil_usuario = RecordHelpers::userHas('profile')) {

	    	$nombre = Profile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
	        return $this->render('index', ['perfil' => $nombre]);
       	
       	} else {
       		return $this->redirect(['profile/create']);
       	}

    }

}
