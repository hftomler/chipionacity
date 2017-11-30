<?php

namespace backend\controllers;

use Yii;
use backend\models\Servicios;
use backend\models\search\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PermissionHelpers;
use yii\web\UploadedFile;
use backend\models\ImagenServicio;


/**
 * ServicioController implements the CRUD actions for Servicios model.
 */
class ServicioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(), // \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return (PermissionHelpers::requireMinRol('proveedor') && PermissionHelpers::requireStatus('Activo'));
                        }
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return (PermissionHelpers::requireMinRol('superAdmin') && PermissionHelpers::requireStatus('Activo'))
                                        /*|| PermissionHelpers::userMustBeOwner('profile', $this->findModel(Yii::$app->user->identity->id))*/;
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
     * Lists all Servicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Servicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Servicios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Capturamos la instancia de los ficheros subidos en el form y guardamos las imágenes
            $mensajeFlash = Yii::t('app', 'Saved record successfully') . '<br/>';
            $model->fichImage = UploadedFile::getInstances($model, 'fichImage');
            if ($model->fichImage !== null) {
                foreach ($model->fichImage as $key => $file) {
                    // Creamos el registro de ImagenServicio y Guardo la trayectoria de la imagen en el campo url.
                    $imgServicio = new ImagenServicio();
                    $imgServicio->servicio_id = $model->id;
                    $nomImg = "";
                    $nomImg = 'imagenes/imgServ/' . $model->id . '-' .
                    $file->baseName . '-' . $file->size .  '.' . $file->extension;
                    $imgServicio->url = $nomImg;
                    $imgServicio->save();
                    $model->fichImage = null;
                    $model->save();
                    $file->saveAs($nomImg);
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Servicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Capturamos la instancia de los ficheros subidos en el form y guardamos las imágenes
            $mensajeFlash = Yii::t('app', 'Saved record successfully') . '<br/>';
            $model->fichImage = UploadedFile::getInstances($model, 'fichImage');
            if ($model->fichImage !== null) {
                foreach ($model->fichImage as $key => $file) {
                    // Creamos el registro de ImagenServicio y Guardo la trayectoria de la imagen en el campo url.
                    $imgServicio = new ImagenServicio();
                    $imgServicio->servicio_id = $model->id;
                    $nomImg = "";
                    $nomImg = 'imagenes/imgServ/' . $model->id . '-' .
                    $file->baseName . '-' . $file->size .  '.' . $file->extension;
                    $imgServicio->url = $nomImg;
                    $imgServicio->save();
                    $model->fichImage = null;
                    $model->save();
                    $file->saveAs($nomImg);
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Servicios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Servicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
