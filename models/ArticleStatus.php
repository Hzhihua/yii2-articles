<?php

namespace hzhihua\articles\models;

use Yii;
use yii\base\Model;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\UnauthorizedHttpException;
use hzhihua\articles\traits\EventTrait;
use hzhihua\articles\behaviors\UserBehavior;
use hzhihua\articles\behaviors\I18NBehavior;

/**
 * This is the model class for table "{{%article_status}}".
 *
 * @property int $id
 * @property string $name 文章状态名称
 * @property int $child 子状态
 * @property int $created_by 由谁创建
 * @property int $is_default_status 是否是默认状态
 * @property int $is_allow_public 此状态的文章是否允许发布
 * @property int $created_at 创建时间
 * @property int $updated_at 最近修改时间
 * @property \hzhihua\articles\behaviors\UserBehavior $userId user who had logined identity
 */
class ArticleStatus extends ActiveRecord
{
    const DEFAULT_STATUS_VALUE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return (Yii::$app->controller->module->tableName)['article_status'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'child', 'is_allow_public', 'created_at', 'updated_at'], 'required'],
            [['child', 'created_by', 'is_default_status','is_allow_public', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['is_default_status', 'default', 'value' => 0],
        ]);
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
     * @param ModelEvent $event
     * @return bool
     */
    public function beforeInsert(ModelEvent $event)
    {
        if ($this->id) {
            unset($this->id);
        }

        if ((int)$this->child === $this->id) {
            return $event->isValid = false;
        }
    }

    /**
     * @param ModelEvent $event
     * @return bool
     */
    public function beforeUpdate(ModelEvent $event)
    {
        if ($this->oldAttributes['id'] !== $this->id) {
            return $event->isValid = false;
        }

        if ((int)$this->child === $this->id) {
            return $event->isValid = false;
        }

        /* check whether child is exists */
        if (! static::find()->where(['child' => $this->child])->count()) {
            return $event->isValid = false;
        }
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            // 添加数据时允许接受的字段
            'insert' => [
                'id',
                'name',
                'child',
                'is_default_status',
                'is_allow_public',
            ],
            // 更新数据时允许接受的字段
            'update' => [
                'name',
                'child',
                'is_default_status',
                'is_allow_public',
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
            'name' => Yii::t('articles', 'Name'),
            'child' => Yii::t('articles', 'Child'),
            'created_by' => Yii::t('articles', 'Created By'),
            'is_default_status' => Yii::t('articles', 'Is Default Status'),
            'is_allow_public' => Yii::t('articles', 'Is Allow Public'),
            'created_at' => Yii::t('articles', 'Created At'),
            'updated_at' => Yii::t('articles', 'Updated At'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['status_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getDefaultStatus()
    {
        $userId = Yii::$app->user->identity->getId();
        return static::find()->where(['is_default_status' => self::DEFAULT_STATUS_VALUE, 'created_by' => $userId])->limit(1)->asArray()->one();
    }

    /**
     * @return int
     */
    public static function getDefaultStatusId()
    {
        $status = static::getDefaultStatus();
        return $status['id'];
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getStatusNameById($id)
    {
        static $statusData = [];
        if (empty($statusData)) {
            $userId = Yii::$app->user->identity->getId();
            $statusData = static::find(['created_by' => $userId])->asArray()->all();
        }

        foreach ($statusData as $_v) {
            if ($id === (int)$_v['id'])
                return $_v['name'];
        }

        return '';
    }

    /**
     * select all data as array by login user id
     * @return array|ActiveRecord[]
     */
    public static function selectAll()
    {
        $userId = Yii::$app->user->identity->getId();

        if (!$userId) {
            throw new UnauthorizedHttpException(Yii::t('articles', 'You must be sign in before further operation'));
        }

        return static::find()->where(['created_by' => $userId])->asArray()->all();
    }

}
