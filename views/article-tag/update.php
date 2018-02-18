<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleTag */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article Tag') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article Tag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-tag-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
