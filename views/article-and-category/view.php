<?php

use hzhihua\articles\widgets\DetailView;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\DateHelper;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleAndCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article And Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-and-category-view box box-primary">
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
                'article_id',
                'category_id',
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return DateHelper::show($model->created_at);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
