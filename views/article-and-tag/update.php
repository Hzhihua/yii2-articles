<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleAndTag */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article And Tag') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article And Tag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-and-tag-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
