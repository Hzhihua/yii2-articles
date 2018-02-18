<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-6 20:14
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;

class ControllerBehavior extends Behavior
{
    /**
     * controller model map
     * ```php
     * [
     *      'article' => [
     *          'class' => 'your\models\class\name',
     *          'property1' => 'value1',
     *          'property2' => 'value2',
     *      ],
     * ],
     * ```
     * it will be instance by [[\Yii::createObject()]],
     * and it will be used to controller
     *
     * Usage in controller:
     * ```php
     * $this->model->load(\Yii::$app->getRequest()->post());
     * $this->model->save();
     * ```
     * @var array
     */
    public $modelMap = [
        'article' => 'hzhihua\articles\models\Article',
        'article-tag' => 'hzhihua\articles\models\ArticleTag',
        'article-and-tag' => 'hzhihua\articles\models\ArticleAndTag',
        'article-category' => 'hzhihua\articles\models\ArticleCategory',
        'article-and-category' => 'hzhihua\articles\models\ArticleAndCategory',
        'article-status' => 'hzhihua\articles\models\ArticleStatus',
    ];

    /**
     * controller search model map
     * @var array
     * @see $modelMap
     */
    public $searchModelMap = [
        'article' => 'hzhihua\articles\models\search\ArticleSearch',
        'article-tag' => 'hzhihua\articles\models\search\ArticleTagSearch',
        'article-and-tag' => 'hzhihua\articles\models\search\ArticleAndTagSearch',
        'article-category' => 'hzhihua\articles\models\search\ArticleCategorySearch',
        'article-and-category' => 'hzhihua\articles\models\search\ArticleAndCategorySearch',
        'article-status' => 'hzhihua\articles\models\search\ArticleStatusSearch',
    ];

    /**
     * current controller name
     * @var string
     */
    private $_controllerName = '';

    /**
     * current model object in controller
     * @var null
     */
    private $_model = null;

    /**
     * current search model object in controller
     * @var null
     */
    private $_modelSearch = null;

    public function init()
    {
        $this->_controllerName = Yii::$app->controller->id;
        parent::init();
    }

    protected function getClassName($class)
    {
        if (is_string($class)) {
            return $class;
        }

        if (is_array($class)) {
            if (isset($class['class'])) {
                return $class['class'];
            } else {
                throw new InvalidConfigException('class must be set');
            }
        }

        if (is_object($class)) {
            return get_called_class($class);
        }

        throw new ErrorException('params must in string|array|object');
    }

    /**
     * get static model for current controller
     * @return mixed|string
     */
    public function getStaticModel()
    {
        $currentModelClass = $this->modelMap[$this->_controllerName];
        return $this->getClassName($currentModelClass);
    }

    /**
     * get static searchModel for current controller
     * @return mixed|string
     */
    public function getStaticSearchModel()
    {
        $currentModelClass = $this->searchModelMap[$this->_controllerName];
        return $this->getClassName($currentModelClass);
    }

    /**
     * get model object for current controller
     * @return null|object
     */
    public function getModel()
    {
        if (empty($this->_model)) {
            $currentModelClass = $this->modelMap[$this->_controllerName];
            $this->_model = Yii::createObject($currentModelClass);
        }

        return $this->_model;
    }

    /**
     * get searchModel object for current controller
     * @return mixed|null|object|string
     */
    public function getSearchModel()
    {
        if (empty($this->_modelSearch)) {
            $currentSearchModelClass = $this->searchModelMap[$this->_controllerName];
            $this->_modelSearch = Yii::createObject($currentSearchModelClass);
        }

        return $this->_modelSearch;
    }
}