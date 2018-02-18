<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\grids\GridView;
use hzhihua\articles\helpers\DateHelper;
use hzhihua\articles\models\ArticleStatus;

/* @var $this \yii\web\View */
/* @var $searchModel \hzhihua\articles\models\search\ArticleStatusSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('articles', 'Article Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-status-index box box-primary">
    <div class="box-header with-border">
        <?= HtmlHelper::a(Yii::t('articles', 'Create') . Yii::t('articles', 'Article Status'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'child',
                    'value' => function ($model) {
                        return $model->child ? ArticleStatus::getStatusNameById($model->child) : Yii::t('articles', 'null');
                    },
                ],
                [
                    'attribute' => 'is_default_status',
                    'format' => 'boolean',
                ],
                [
                    'attribute' => 'is_allow_public',
                    'format' => 'boolean',
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return DateHelper::show($model->created_at);
                    },
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => function ($model) {
                        return DateHelper::show($model->updated_at);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
