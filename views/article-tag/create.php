<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleTag */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Tag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-tag-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
