<?php

namespace hzhihua\articles\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\NotifyHelper;

/**
 * ArticleStatusController implements the CRUD actions for ArticleStatus model.
 *
 * @property \hzhihua\articles\models\ArticleStatus $model ArticleStatus object
 * @property \hzhihua\articles\models\search\ArticleStatusSearch $searchModel ArticleStatusSearch object
 * @property \hzhihua\articles\models\ArticleStatus $staticModel ArticleStatus class name
 * @see \hzhihua\articles\behaviors\ControllerBehavior
 * @author: cnzhihua
 * @github: https://github.com/Hzhihua
 */
class ArticleStatusController extends Controller
{
    /**
     * Lists all ArticleStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleStatus model.
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
     * Creates a new ArticleStatus model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->model;

        if (Yii::$app->getRequest()->isPost) {
            $model->setScenario('insert');

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                NotifyHelper::success(Yii::t('articles',
                    'Insert article status({name}) successfully',
                    ['name' => HtmlHelper::a($model->name, ['view', 'id' => $model->id])]
                ));
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleStatus model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->getRequest()->isPost) {
            $model->setScenario('update');

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                NotifyHelper::success(Yii::t('articles',
                    'Update article status({name}) successfully',
                    ['name' => HtmlHelper::a($model->name, ['view', 'id' => $model->id])]
                ));
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            NotifyHelper::success(Yii::t('articles',
                'Delete article status({name}) successfully',
                ['name' => $model->name]
            ));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \hzhihua\articles\models\ArticleStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $className = $this->staticModel;
        if (($model = $className::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('articles', 'The requested page does not exist.'));
        }
    }
}
