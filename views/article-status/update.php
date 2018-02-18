<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleStatus */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article Status') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
