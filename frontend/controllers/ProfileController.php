<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Profile;
use frontend\models\search\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;
use common\models\Pais;
use common\models\Provincia;
use common\models\Municipio;
use yii\web\UploadedFile;
use backend\models\ImagenProfile;

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
                'class' => AccessControl::className(), // \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'avatar', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'avatar', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::userMustBeOwner('profile', RecordHelpers::userHas('profile'))
                                      && PermissionHelpers::requireStatus('Activo');
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
         $model->user_id = \Yii::$app->user->identity->id;

         if ($id_perfil_usuario = RecordHelpers::userHas('profile')) {
             return $this->render('view', [
                 'model' => $this->findModel($id_perfil_usuario),
             ]);

         } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
             // Capturamos la instancia del fichero subido en el form y guardamos la imagen
             // Si no hay fichero y existe un avatar subido lo guardamos.
             $mensajeFlash = Yii::t('app', 'Saved record successfully') . '<br/>';
             $model->fichImage = UploadedFile::getInstance($model, 'fichImage');
             if ($model->fichImage !== null) {
                 // Creamos el registro de ImagenProfile y Guardo la trayectoria de la imagen en el campo url.
                 $imgPerfil = new ImagenProfile();
                 $imgPerfil->profile_id = $model->id;
                 $nomImg = "";
                 $nomImg = 'imagenes/imgPerfil/' . $model->id . '-' .
                                                                          $model->fichImage->baseName . '-' .
                                                                          $model->fichImage->size .
                                                                          '.' . $model->fichImage->extension;

                 if (!file_exists($nomImg)) {
                     $mensajeFlash += Yii::t('app', 'The new profile image has been saved.');
                     $imgPerfil->url = $nomImg;
                     $imgPerfil->save();
                     $model->save();
                     $model->fichImage->saveAs($nomImg);
                 }
             } else {
                 if (Yii::$app->request->post('valueAvatar')) {
                     $imgPerfil = new ImagenProfile();
                     $imgPerfil->profile_id = $model->id;
                     $imgPerfil->url = Yii::$app->request->post('valueAvatar');
                     $imgPerfil->save();
                 }
             }
             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('create', [
                 'model' => $model,
                 'sinPerfil' => 'imagenes/imgPerfil/sinPerfil.jpg',
             ]);
         }
     }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        PermissionHelpers::requireUpgradeTo('Suscrito');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Capturamos la instancia del fichero subido en el form y guardamos la imagen
            $mensajeFlash = Yii::t('app', 'Saved record successfully') . '<br/>';
            $model->fichImage = UploadedFile::getInstance($model, 'fichImage');
            if ($model->fichImage !== null) {
                // Creamos el registro de ImagenProfile y Guardo la trayectoria de la imagen en el campo url.
                $imgPerfil = new ImagenProfile();
                $imgPerfil->profile_id = $model->id;
                $nomImg = "";
                $nomImg = 'imagenes/imgPerfil/' . $model->id . '-' .
                                                                         $model->fichImage->baseName . '-' .
                                                                         $model->fichImage->size .
                                                                         '.' . $model->fichImage->extension;

                if (!file_exists($nomImg)) {
                    $mensajeFlash += Yii::t('app', 'The new profile image has been saved.');
                    $imgPerfil->url = $nomImg;
                    $imgPerfil->save();
                    $model->save();
                    $model->fichImage->saveAs($nomImg);
                }
            } else {
                if (Yii::$app->request->post('valueAvatar')) {
                    $imgPerfil = new ImagenProfile();
                    $imgPerfil->profile_id = $model->id;
                    $imgPerfil->url = Yii::$app->request->post('valueAvatar');
                    $imgPerfil->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'sinPerfil' => 'imagenes/imgPerfil/sinPerfil.jpg',
            ]);
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
     * Muestra página de avatar para selección.
     * @return mixed
     */
    public function actionAvatar()
    {

        return $this->render('avatar', [
            'model' => 'profile',
        ]);
    }

}
