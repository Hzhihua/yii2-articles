<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-21 19:28
 * @Github: https://github.com/Hzhihua
 */

use kartik\grid\GridView;
use kartik\editable\Editable;
use hzhihua\articles\helpers\DateHelper;
use hzhihua\articles\models\ArticleStatus;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\UrlHelper;
use hzhihua\articles\helpers\ArrayHelper;

$userId = Yii::$app->getUser()->identity->getId();
$is_topData = [0 => Yii::t('articles', 'No'), 1 => Yii::t('articles', 'Yes')];
$statusData = ArticleStatus::find()->where(['created_by' => $userId])->asArray()->all();

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\CheckboxColumn',
        "name" => "id",
    ],
    [
        'attribute' => 'title',
//        'class'=>'kartik\grid\EditableColumn',
//        'editableOptions'=>[
//            'asPopover' => false,
//            'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
//            'options' => [
//                'rows' => 4,
//            ],
//        ],
    ],
    [
        'attribute' => 'description',
//            'headerOptions' => [
//                'style' => [
//                    'width' => '80%',
//                ],
    ],
//                'content:ntext',
        [
            'attribute' => 'is_top',
//            'class'=>'kartik\grid\EditableColumn',
            'format' => 'boolean',
//            'editableOptions' => [
//                'inputType' => Editable::INPUT_DROPDOWN_LIST,
//                'asPopover' => true,
//                'data' => $is_topData,
//            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $is_topData,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder' => Yii::t('articles', 'Search')],
        ],
        [
            'attribute' => 'status',
//            'class'=>'kartik\grid\EditableColumn',
            'value' => function ($model) {
                return ArticleStatus::getStatusNameById($model->status_id);
            },
            'hAlign' => GridView::ALIGN_CENTER,
            'vAlign' => GridView::ALIGN_MIDDLE,
//            'editableOptions' => [
//                'inputType' => Editable::INPUT_DROPDOWN_LIST,
//                'asPopover' => true,
//                'data' => ArrayHelper::map($statusData, 'name', 'name'),
//            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map($statusData, 'id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder' => Yii::t('articles', 'Search')],
        ],
        [
            'attribute' => 'public_time',
            'value' => function ($model) {
                return DateHelper::show($model->public_time);
            },
        ],
//                [
//                    'attribute' => 'created_at',
//                    'value' => function ($model) {
//                        return DateHelper::show($model->created_at);
//                    },
//                ],
//                [
//                    'attribute' => 'updated_at',
//                    'value' => function ($model) {
//                        return DateHelper::show($model->updated_at);
//                    },
//                ],

        ['class' => 'kartik\grid\ActionColumn'],
];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
//    'layout' => "{items}\n{summary}\n{pager}",
// set your toolbar
    'toolbar' =>  [
        ['content' =>
            HtmlHelper::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('articles', 'Create Article'), 'class' => 'btn btn-success', 'onclick' => 'window.location.href="'.UrlHelper::to(['create']).'"']) . ' '.
            HtmlHelper::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => Yii::t('articles', 'Reset Grid')])
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => Yii::t('articles', 'Article'),
    ],
    'hover' => true,
//    'toggleDataOptions' => ['minCount' => 5],
    'showPageSummary' => false,
    'responsive' => true,

]); ?>