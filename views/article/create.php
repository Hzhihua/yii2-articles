<?php

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */

$this->title = Yii::t('articles', 'Create') . Yii::t('articles', 'Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
