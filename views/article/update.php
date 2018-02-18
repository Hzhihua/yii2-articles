<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */

$this->title = Yii::t('articles', 'Update') . Yii::t('articles', 'Article') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('articles', 'Update');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
