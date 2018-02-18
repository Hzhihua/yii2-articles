<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\DateHelper;
use hzhihua\articles\widgets\DetailView;
use hzhihua\articles\models\ArticleStatus;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleStatus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-status-view box box-primary">
    <div class="box-header">
        <?= HtmlHelper::a(Yii::t('articles', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= HtmlHelper::a(Yii::t('articles', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('articles', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                [
                    'attribute' => 'child',
                    'value' => function ($model) {
                        return $model->child ? ArticleStatus::getStatusNameById($model->child) : Yii::t('articles', 'null');
                    },
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
            ],
        ]) ?>
    </div>
</div>
