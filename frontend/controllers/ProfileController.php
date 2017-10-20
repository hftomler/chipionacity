<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Profile;
use frontend\models\search\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;
use common\models\Pais;
use common\models\Provincia;
use common\models\Municipio;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only'  => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
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

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {

        if ($id_perfil_usuario = RecordHelpers::userHas('profile')) {
            return $this->render('view', [
                'model' => $this->findModel($id_perfil_usuario),
            ]);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
       if ($id_perfil_usuario = RecordHelpers::userHas('profile')) {
            return $this->render('view', [
                'model' => $this->findModel($id_perfil_usuario),
            ]);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();

        // Asignamos al user_id del perfil con el id de usuario activo.
        $model -> user_id = \Yii::$app->user->identity->id;

        if ($id_perfil_usuario = RecordHelpers::userHas('profile')) {
            return $this->render('view', [
                'model' => $this->findModel($id_perfil_usuario),
            ]);

        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view']);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        PermissionHelpers::requireUpgradeTo('Suscrito');

        if ($model = Profile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('No existe el perfil');
        }
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = Profile::find()->where(['user_id' => Yii::$app->user->id])->one();

        $this->findModel($model->id)->delete();

        return $this->redirect(['site/index']);
    }

    public function actionListaprov($id) {
        $contProvincias = Provincia::find()->where(['pais_id' => $id]) ->count();
        $provincias = Provincia::find()->where(['pais_id' => $id])->all();
        ArrayHelper::multisort($provincias, 'nombre_provincia', SORT_ASC);
        if ($contProvincias >0) {
            foreach($provincias as $provincia) {
                echo "<option value='" . $provincia->id . "'>" . $provincia->nombre_provincia . "</option>";
            }
        } else {
            echo "<option> -- </option>";
        }
    }

    public function actionListamuni($id) {
        $contMunicipios = Municipio::find()->where(['provincia_id' => $id]) ->count();
        $municipios = Municipio::find()->where(['provincia_id' => $id])->all();
        ArrayHelper::multisort($municipios, 'nombre_municipio', SORT_ASC);
        if ($contMunicipios >0) {
            foreach($municipios as $municipio) {
                echo "<option value='" . $municipio->id . "'>" . $municipio->nombre_municipio . "</option>";
            }
        } else {
            echo "<option> -- </option>";
        }
    }


    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
