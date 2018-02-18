<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleCategory */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article Category') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
