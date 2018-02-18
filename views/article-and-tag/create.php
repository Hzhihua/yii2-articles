<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleAndTag */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article And Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article And Tag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-and-tag-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
