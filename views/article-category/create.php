<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleCategory */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
