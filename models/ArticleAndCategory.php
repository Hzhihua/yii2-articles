<?php

namespace hzhihua\articles\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use hzhihua\articles\behaviors\I18NBehavior;

/**
 * This is the model class for table "{{%article_and_category}}".
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $category_id 分类ID
 * @property int $created_at 创建时间
 */
class ArticleAndCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return (Yii::$app->controller->module->tableName)['article_and_category'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['article_id', 'category_id', 'created_at'], 'required'],
            [['article_id', 'category_id', 'created_at'], 'integer'],
        ]);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            I18NBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => null,
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            // 添加数据时允许接受的字段
            'insert' => [
                'article_id',
                'category_id',
            ],
            // 更新数据时允许接受的字段
            'update' => [
                'article_id',
                'category_id',
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
            'article_id' => Yii::t('articles', 'Article ID'),
            'category_id' => Yii::t('articles', 'Category ID'),
            'created_at' => Yii::t('articles', 'Created At'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

}
