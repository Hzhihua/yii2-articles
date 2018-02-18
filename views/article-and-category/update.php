<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\ArticleAndCategory */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article And Category') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Article And Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-and-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
