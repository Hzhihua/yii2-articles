<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleAndCategory */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article And Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article And Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-and-category-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
