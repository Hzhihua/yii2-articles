<?php

namespace hzhihua\articles\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use hzhihua\articles\behaviors\I18NBehavior;

/**
 * This is the model class for table "{{%article_and_tag}}".
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $tag_id 标签ID
 * @property int $created_at 创建时间
 */
class ArticleAndTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return (Yii::$app->controller->module->tableName)['article_and_tag'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['article_id', 'tag_id', 'created_at'], 'required'],
            [['article_id', 'tag_id', 'created_at'], 'integer'],
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
                'tag_id',
            ],
            // 更新数据时允许接受的字段
            'update' => [
                'article_id',
                'tag_id',
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
            'tag_id' => Yii::t('articles', 'Tag ID'),
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
    public function getArticleTag()
    {
        return $this->hasOne(ArticleTag::className(), ['id' => 'tag_id']);
    }
}
