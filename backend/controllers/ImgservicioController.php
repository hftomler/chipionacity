<?php

namespace backend\controllers;

use Yii;
use backend\models\ImagenServicio;
use backend\models\search\ImagenServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * ImgservicioController implements the CRUD actions for ImagenServicio model.
 */
class ImgservicioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ImagenServicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagenServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImagenServicio model.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ImagenServicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImagenServicio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ImagenServicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ImagenServicio model->description.
     * @param int $id
     * @param string $desc
     * @return mixed
     */
    public function actionUpdatedescajax($id, $desc)
    {
        var_dump($id, $desc);
        $model = $this->findModel($id);
        $model->descripcion = $desc;
        $model->update();

    }

    /**
     * Updates an existing ImagenServicio model desde ajax.
     * no devuelve nada
     * @param int $id
     */
    public function actionUpdateajax($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = new Expression('NOW()');
        $model->update();
    }

    /**
     * Deletes an existing ImagenServicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing ImagenServicio model desde ajax.
     * @param int $id
     * @return mixed
     */
    public function actionDeleteajax($id)
    {
        $imgBorrar = $this->findModel($id)->url;
        $imgThumbBorrar = $this->findModel($id)->urlthumb;
        if (!strstr($imgBorrar, 'imgServ')) {
            unlink($imgBorrar);
            unlink($imgThumbBorrar);
        }
        $this->findModel($id)->delete();
    }

    /**
     * Finds the ImagenServicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return ImagenServicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImagenServicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
