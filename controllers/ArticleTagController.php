<?php

namespace hzhihua\articles\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\NotifyHelper;

/**
 * ArticleTagController implements the CRUD actions for ArticleTag model.
 *
 * @property \hzhihua\articles\models\ArticleTag $model ArticleTag object
 * @property \hzhihua\articles\models\ArticleTag $staticModel ArticleTag class name
 * @property \hzhihua\articles\models\search\ArticleTagSearch $searchModel ArticleTagSearch object
 * @see \hzhihua\articles\behaviors\ControllerBehavior
 * @author: cnzhihua
 * @github: https://github.com/Hzhihua
 *
 */
class ArticleTagController extends Controller
{
    /**
     * Lists all ArticleTag models.
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
     * Displays a single ArticleTag model.
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
     * Creates a new ArticleTag model.
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
                    'Insert article tag({name}) successfully',
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
     * Updates an existing ArticleTag model.
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
                    'Update article tag({name}) successfully',
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
     * Deletes an existing ArticleTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            NotifyHelper::success(Yii::t('articles',
                'Delete article tag({name}) successfully',
                ['name' => $model->name]
            ));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \hzhihua\articles\models\ArticleTag the loaded model
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
