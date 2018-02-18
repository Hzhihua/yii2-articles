<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\grids\GridView;
use hzhihua\articles\helpers\DateHelper;

/* @var $this \yii\web\View */
/* @var $searchModel \hzhihua\articles\models\search\ArticleAndTagSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('articles', 'Article And Tag');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-and-tag-index box box-primary">
    <div class="box-header with-border">
        <?= HtmlHelper::a(Yii::t('articles', 'Create') . Yii::t('articles', 'Article And Tag'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'article_id',
                'tag_id',
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return DateHelper::show($model->created_at);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
