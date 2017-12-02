<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PermissionHelpers;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [ 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireMinRol('proveedor') && PermissionHelpers::requireStatus('Activo');
                        }
                    ],
                    [
                        'actions' => [ 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::isProveedor(Yii::$app->user->identity->id) && !PermissionHelpers::RequireMinRol('admin')) {
            $this->redirect(['/servicio/index']);
        } else {
            return $this->render('index');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLanguage() {
        if (isset($_POST['lang'])) {
            Yii::$app->language = $_POST['lang'];
            $cookie = new yii\web\Cookie([
                'name' => 'lang',
                'value' =>$_POST['lang']
            ]);

            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
    }

}
