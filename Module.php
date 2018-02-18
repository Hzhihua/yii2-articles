<?php

namespace hzhihua\articles;

use hzhihua\articles\behaviors\UserBehavior;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use hzhihua\articles\behaviors\I18NBehavior;
use hzhihua\articles\behaviors\ControllerBehavior;

/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'hzhihua\articles\controllers';

    /**
     * default route
     * @var string
     */
    public $defaultRoute = 'article/index';

    /**
     * editor class name
     * You can customize your editor class, but it must be implements [[\hzhihua\articles\EditorInterface]]
     * @var \hzhihua\articles\EditorInterface
     */
//    public $editor = '';

    /**
     * @var \yii\db\Connection
     */
    public $db = 'db';

    /**
     * model table name
     * @var array
     */
    public $tableName = [
        'article' => '{{%article}}',
        'article_status' => '{{%article_status}}',
        'article_tag' => '{{%article_tag}}',
        'article_category' => '{{%article_category}}',
        'article_and_tag' => '{{%article_and_tag}}',
        'article_and_category' => '{{%article_and_category}}',
    ];

    /**
     * php date format for display in actionIndex/actionView
     * @var string
     */
    public $dateFormat = 'Y-m-d H:i:s';

    /**
     * attach behaviors to current controller
     *
     * ```php
     * [
     *      'hzhihua\articles\behaviors\I18NBehavior',
     *      'hzhihua\articles\behaviors\ControllerBehavior',
     * ],
     * ```
     * or
     * ```php
     * [
     *      [
     *          'class' => 'hzhihua\articles\behaviors\ControllerBehavior',
     *          'modelMap' => [
     *              'article' => 'hzhihua\articles\models\Article',
     *              'article-category' => [
     *                  'class' => 'hzhihua\articles\models\ArticleCategory',
     *                  'property1' => 'value1',
     *                  'property2' => 'value2',
     *              ],
     *          ],
     *      ],
     * ],
     * ```
     * @var array
     */
    public $controllerBehaviors = [];

    /**
     * register asset source
     * @var string
     */
    public $asset = 'dmstr\web\AdminLteAsset';

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        // register asset source
        ($this->asset)::register(Yii::$app->controller->getView());

        // attach behaviors for current controller
        $this->attachControllerBehaviors();

        return parent::beforeAction($action);
    }

    /**
     * attach behaviors to current controller
     * @return array
     */
    public function attachControllerBehaviors()
    {
        $behaviors = ArrayHelper::merge($this->controllerBehaviors, [
            I18NBehavior::className(),
            ControllerBehavior::className()
        ]);

        Yii::$app->controller->attachBehaviors($behaviors);
    }

}
