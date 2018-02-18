<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleStatus */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-status-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
