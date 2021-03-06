<?php

namespace frontend\controllers;

use Yii;
use backend\models\Ventas;
use backend\models\LineasVenta;
use backend\models\Servicios;
use frontend\models\search\VentasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
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
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ventas model.
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
     * Creates a new Ventas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ventas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ventas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Ventas model.
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
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ventas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Añade una línea a una venta existente. Para ello comprueba si el usuario está logueado
     * Si no lo está, le manda a la página de login. Si lo está comprueba si tiene alguna venta
     * abierta y si la hay añade este servicio a la misma
     * @param int $id_servicio
     * @return mixed
     */
    public function actionAddcart($id_servicio) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Sorry, but you are not logged in. Please enter the system and try again.'));
            return $this->goBack();
        } else {
            var_dump("Está logueado");
            $venta = Ventas::find()->where(['usuario_id' => Yii::$app->user->id, 'estado_id' => 3])->one();
            $serv = Servicios::find()->where(['id' => $id_servicio])->one();
            if (!$venta) {
                $venta = new Ventas();
                $venta->usuario_id = Yii::$app->user->id;
                $venta->importe = $serv->precio;
                $venta->importe_iva = 0;
                $venta->total_venta = $serv->precio;
                $venta->total_comision = 0;
                $venta->estado_id = 3;
                $venta->save();
                var_dump($venta);
            }

            $nuevaLinea = new LineasVenta();
            $nuevaLinea->venta_id = $venta->id;
            $nuevaLinea->servicio_id = $id_servicio;
            $nuevaLinea->precio_unit = $serv->precio;
            $nuevaLinea->cantidad = 1;
            $nuevaLinea->total_comision_linea = 0;
            $nuevaLinea->total_linea = $serv->precio * $nuevaLinea->cantidad;
            $nuevaLinea->save();
            return $this->goHome();
        }
    }
}
