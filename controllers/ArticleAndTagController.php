<?php

namespace hzhihua\articles\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticleAndTagController implements the CRUD actions for ArticleAndTag model.
 *
 * @property \hzhihua\articles\models\ArticleAndTag $model ArticleCategory object
 * @property \hzhihua\articles\models\ArticleAndTag $staticModel ArticleCategory class name
 * @property \hzhihua\articles\models\search\ArticleAndTagSearch $searchModel ArticleCategorySearch object
 * @see \hzhihua\articles\behaviors\ControllerBehavior
 * @author: cnzhihua
 * @github: https://github.com/Hzhihua
 */
class ArticleAndTagController extends Controller
{
    /**
     * Lists all ArticleAndTag models.
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
     * Displays a single ArticleAndTag model.
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
     * Finds the ArticleAndTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \hzhihua\articles\models\ArticleAndTag the loaded model
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
