<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\DateHelper;
use hzhihua\articles\models\ArticleStatus;
use hzhihua\articles\grids\GridView;

/* @var $this \yii\web\View */
/* @var $searchModel \hzhihua\articles\models\search\ArticleSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('articles', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
    $(document).on(\'click\', \'.gridview\', function () {
        var keys = $("#grid").yiiGridView("getSelectedRows");
        console.log(keys);
    });
');
?>
<div class="article-index box box-primary">
    <div class="box-header with-border">
        <?= HtmlHelper::a(Yii::t('articles', 'Create') . Yii::t('articles', 'Article'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            "options" => [
                "class" => "grid-view",
                "style"=>"overflow:auto",
                "id" => "grid",
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    "class" => "yii\grid\CheckboxColumn",
                    "name" => "id",
                ],

                'title',
                [
                    'attribute' => 'description',
                    'headerOptions' => [
                        'style' => [
//                            'width' => '80%',
                        ],
                    ],
                ],
//                'content:ntext',
                [
                    'attribute' => 'is_top',
                    'format' => 'boolean',
                    'headerOptions' => [
                        'style' => [
                            'width' => '80px',
                            'display' => 'inline-block',
                        ],
                    ],
                ],
                [
                    'attribute' => 'status',

                    'value' => function ($model) {
                        return ArticleStatus::getStatusNameById($model->status_id);
                    },
                ],
                [
                    'attribute' => 'public_time',
                    'value' => function ($model) {
                        return DateHelper::show($model->public_time);
                    },
                ],
//                [
//                    'attribute' => 'created_at',
//                    'value' => function ($model) {
//                        return DateHelper::show($model->created_at);
//                    },
//                ],
//                [
//                    'attribute' => 'updated_at',
//                    'value' => function ($model) {
//                        return DateHelper::show($model->updated_at);
//                    },
//                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => [
                        'style' => [
                            'width' => '68px',
                            'display' => 'inline-block',
                        ],
                    ],
                ],
            ],
        ]); ?>
        <?= HtmlHelper::a("批量删除", "javascript:void(0);", ["class" => "btn btn-success gridview"]) ?>

    </div>
</div>
