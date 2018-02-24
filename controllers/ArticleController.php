<?php

namespace hzhihua\articles\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use hzhihua\articles\ControllerTrait;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\NotifyHelper;
use hzhihua\articles\EditorDataHandleTrait;

/**
 * ArticleController implements the CRUD actions for Article model.
 *
 * @property \hzhihua\articles\models\Article $model Article object
 * @property \hzhihua\articles\models\Article $staticModel Article class name
 * @property \hzhihua\articles\models\search\ArticleSearch $searchModel ArticleSearch object
 * @see \hzhihua\articles\behaviors\ControllerBehavior
 * @author: cnzhihua
 * @github: https://github.com/Hzhihua
 */
class ArticleController extends Controller
{
    use EditorDataHandleTrait;

    /**
     * Lists all Article models.
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
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->model;

        if (Yii::$app->getRequest()->isPost) {
            $model->setScenario('insert');

            if ($model->load($this->getEditorDataHandle()) && $model->save()) {
                NotifyHelper::success(Yii::t('articles',
                    'Insert article({title}) successfully',
                    ['title' => HtmlHelper::a($model->title, ['view', 'id' => $model->id])]
                ));
                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->getRequest()->isPost) {
            $model->setScenario('update');

            if ($model->load($this->getEditorDataHandle()) && $model->save()) {
                NotifyHelper::success(Yii::t('articles',
                    'Update article({title}) successfully',
                    ['title' => HtmlHelper::a($model->title, ['view', 'id' => $model->id])]
                ));
                return $this->redirect(['index']);
            }

        }

        $model->content = HtmlHelper::decode($model->content);
        $model->preview_content = HtmlHelper::decode($model->preview_content);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            NotifyHelper::success(Yii::t('articles',
                'Delete article({title}) successfully',
                ['title' => $model->title]
            ));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \hzhihua\articles\models\Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        $className = $this->staticModel;
        if (($model = $className::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('articles', 'The requested page does not exist.'));
        }
    }
}
