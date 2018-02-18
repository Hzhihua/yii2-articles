<?php

namespace hzhihua\articles\models;

use hzhihua\articles\helpers\HtmlHelper;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use hzhihua\articles\helpers\ArrayHelper;
use hzhihua\articles\behaviors\UserBehavior;
use hzhihua\articles\behaviors\I18NBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property string $title 文章标题
 * @property string $description 文章简述
 * @property string $content 文章内容
 * @property int $is_top 文章是否置顶
 * @property int $created_by 由谁创建
 * @property int $status_id 文章状态ID
 * @property int $public_time 定时发布时间
 * @property int $created_at 创建时间
 * @property int $updated_at 最近修改时间
 * @property \hzhihua\articles\behaviors\UserBehavior $userId user who had logined identity
 * @method boolean checkUserPermission \hzhihua\articles\behaviors\UserBehavior
 */
class Article extends ActiveRecord
{
    /**
     * @var string
     */
    public $articleStatusClass = 'hzhihua\articles\models\ArticleStatus';

    /**
     * @var string
     */
    public $articleTagClass = 'hzhihua\articles\models\ArticleTag';

    /**
     * @var string
     */
    public $articleCategoryClass = 'hzhihua\articles\models\ArticleCategory';

    /**
     * @var string
     */
    public $articleAndTagClass = 'hzhihua\articles\models\ArticleAndTag';

    /**
     * @var string
     */
    public $articleAndCategoryClass = 'hzhihua\articles\models\ArticleAndCategory';

    /**
     * @var string
     */
    public $tag;

    /**
     * @var int
     */
    public $status;

    /**
     * @var string
     */
    public $category;

    /**
     * ArticleStatus table data
     * @var array
     */
    private $_statusData = [];

    /**
     * @var \yii\db\Connection
     */
    private $db;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return (Yii::$app->controller->module->tableName)['article'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['title', 'content', 'is_top', 'status', 'public_time', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string', 'max' => 65535],
            [['description'], 'string', 'max' => 255],
            [['is_top', 'created_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['public_time', 'string', 'message' => Yii::t('articles', 'You must select a date format value')],
        ]);
    }

    public function init()
    {
        parent::init();

        $dbName = Yii::$app->controller->module->db;
        $this->db = Yii::$app->$dbName;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            I18NBehavior::className(),
            UserBehavior::className(),
            TimestampBehavior::className(),
        ]);
    }

    /**
     * @see ActiveRecord::transactions()
     * @return array
     */
    public function transactions()
    {
        return [
            'insert' => self::OP_INSERT, // scenarios
            'update' => self::OP_UPDATE, // scenarios
        ];
    }

    /**
     * check whether $arr is a empty array by trim function
     * @param array $arr
     * @return bool
     */
    protected function isEmptyArray(array &$arr)
    {
        foreach ($arr as $key => $value) {
            $tmpValue = trim($value);
            if (empty($tmpValue))
                unset($arr[$key]);
            else
                $arr[$key] = $tmpValue;
        }

        return empty($arr);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->public_time) {
            $this->public_time = strtotime($this->public_time); // string to timestamp
        }

        $this->status_id = (int) $this->status;
        $tagArray = explode(',', trim($this->tag, ','));
        $categoryArray = explode(',', trim($this->category, ','));
        $this->description = $this->description ?: mb_substr(HtmlHelper::removeHtmlTags($this->content), 0, 100, 'utf-8');

        /**
         * validate $this->tag
         */
        if ($this->isEmptyArray($tagArray)) {
            $this->addError('tag', Yii::t('articles', 'Tag format error'));
            Yii::warning(sprintf('article tag(%s) format error', $this->tag), __METHOD__);
            return false;
        }

        /**
         * validate $this->category
         */
        if ($this->isEmptyArray($categoryArray)) {
            $this->addError('category', Yii::t('articles', 'Category format error'));
            Yii::warning(sprintf('article category(%s) format error', $this->category), __METHOD__);
            return false;
        }

        /**
         * check whether article status is exists
         */
        if (0 === (int)
            ($this->articleStatusClass)::findByCondition(['id' => $this->status_id, 'created_by' => $this->userId])->count('`id`')
        ) {
            $this->addError('status', Yii::t('articles', 'Status is not exists'));
            Yii::warning(sprintf("article status(%d) is not exists in table(%s)", $this->status_id, ($this->articleStatusClass)::tableName()), __METHOD__);
            return false;
        }

        /**
         * check whether article tag is exists
         */
        if (count($this->tag) !== (int)
            ($this->articleTagClass)::findByCondition(['id' => $tagArray, 'created_by' => $this->userId])->count('`id`')
        ) {
            $this->addError('tag', Yii::t('articles', 'Some tags are not exists'));
            Yii::warning(sprintf(
                "some article tag(%s) is not all exists in table(%s)",
                $this->tag,
                $this->db->quoteSql(($this->articleTagClass)::tableName())
            ), __METHOD__);
            return false;
        }

        /**
         * check whether article category is exists
         */
        if (count($this->category) !== (int)
            ($this->articleCategoryClass)::findByCondition(['id' => $categoryArray, 'created_by' => $this->userId])->count('`id`')
        ) {
            $this->addError('category', Yii::t('articles', 'Some categories are not exists'));
            Yii::warning(sprintf(
                "some article categories(%s) are not exists in table(%s)",
                $this->category,
                $this->db->quoteSql(($this->articleCategoryClass)::tableName())
            ), __METHOD__);
            return false;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @return bool|void
     */
    public function afterSave($insert, $changedAttributes)
    {
        $rst = [];
        $time = time();
        $articleId = $this->id;
        $articleAndTagRows = [];
        $articleAndCategoryRows = [];

        foreach ((array)$this->tag as $key => $value) {
            $articleAndTagRows[$key]['tag_id'] = $value;
            $articleAndTagRows[$key]['article_id'] = $articleId;
            $articleAndTagRows[$key]['created_at'] = $time;
        }

        foreach ((array)$this->category as $key => $value) {
            $articleAndCategoryRows[$key]['category_id'] = $value;
            $articleAndCategoryRows[$key]['article_id'] = $articleId;
            $articleAndCategoryRows[$key]['created_at'] = $time;
        }

        if (!$insert) { // update, deleteAll data about this article_id
            $rst[] = ($this->articleAndTagClass)::deleteAll(['article_id' => $articleId]);
            $rst[] = ($this->articleAndCategoryClass)::deleteAll(['article_id' => $articleId]);
        }

        $rst[] = $this->db->createCommand()
            ->batchInsert(
                ($this->articleAndTagClass)::tableName(),
                ['tag_id', 'article_id', 'created_at'], // map $articleAndTagRows
                $articleAndTagRows
            )->execute();

        $rst[] = $this->db->createCommand()
            ->batchInsert(
                ($this->articleAndCategoryClass)::tableName(),
                ['category_id', 'article_id', 'created_at'], // map $articleAndCategoryRows
                $articleAndCategoryRows
            )->execute();

        foreach ($rst as $value) {
            if (!$value) {
                if ($insert) {
                    $msg = sprintf('batch insert article tag and article category failed in article_id(%d)', $articleId);
                } else {
                    $msg = sprintf('batch update article tag and article category failed in article_id(%d)', $articleId);
                }

                Yii::warning($msg, __METHOD__);
                return false; // batch insert/update failed
            }
        }

        return parent::afterSave($insert, $changedAttributes);

    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if (!$this->checkUserPermission()) {
            Yii::warning(sprintf(
                'this article item(created_by:%d) is not belong to the user(id:%d) who had been logined, delete failed',
                $this->created_by,
                $this->userId
            ), __METHOD__);
            return false;
        }

        ($this->articleAndTagClass)::deleteAll(['article_id' => $this->id]);
        ($this->articleAndCategoryClass)::deleteAll(['article_id' => $this->id]);

        return parent::beforeDelete();
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            // 添加数据时允许接受的字段
            'insert' => [
                'title',
                'description',
                'content',
                'is_top',
                'status',
                'tag',
                'category',
                'public_time',
            ],
            // 更新数据时允许接受的字段
            'update' => [
                'title',
                'description',
                'content',
                'is_top',
                'status',
                'tag',
                'category',
                'public_time',
            ],
        ]);

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'id' => Yii::t('articles', 'ID'),
            'title' => Yii::t('articles', 'Title'),
            'description' => Yii::t('articles', 'Description'),
            'content' => Yii::t('articles', 'Content'),
            'is_top' => Yii::t('articles', 'Is Top'),
            'created_by' => Yii::t('articles', 'Created By'),
            'status' => Yii::t('articles', 'Status'),
            'status_id' => Yii::t('articles', 'Status Id'),
            'category' => Yii::t('articles', 'Category'),
            'tag' => Yii::t('articles', 'Tag'),
            'public_time' => Yii::t('articles', 'Public Time'),
            'created_at' => Yii::t('articles', 'Created At'),
            'updated_at' => Yii::t('articles', 'Updated At'),
        ]);
    }

    /**
     * 与 Articlestatus_id 表一对一关系
     *
     * ```php
     * Article::find()->with('articleStatus')->asArray()->all();
     * ```
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleStatus()
    {
        // id 是 ArticleStatus 表的 id
        return $this->hasOne(ArticleStatus::className(), ['id' => 'status_id']);
    }

    /**
     * article 与 article_category 表 多对多关系
     * article_and_category表 为中间表
     * 通过 article_and_category表 获取 category表数据
     *
     * ```php
     * Article::find()->with('articleAndStatus')->asArray()->all();
     * ```
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAndCategory()
    {
        return $this->hasMany(ArticleAndCategory::className(), ['article_id' => 'id'])->joinWith('articleCategory');
    }

    /**
     * article 与 article_tag 表 多对多关系
     * article_and_tag 为中间表
     * 通过 article_and_tag表 获取 article_tag表 数据
     *
     * ```php
     * Article::find()->with('articleAndTag')->asArray()->all();
     * ```
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAndTag()
    {
        return $this->hasMany(ArticleAndTag::className(), ['article_id' => 'id'])->joinWith('articleTag');
    }

}
