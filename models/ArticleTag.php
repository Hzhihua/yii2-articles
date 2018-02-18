<?php

namespace hzhihua\articles\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use hzhihua\articles\behaviors\UserBehavior;
use hzhihua\articles\behaviors\I18NBehavior;

/**
 * This is the model class for table "{{%article_tag}}".
 *
 * @property int $id
 * @property string $name 标签云名称
 * @property string $description 标签云简述
 * @property int $created_by 由谁创建
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 * @property \hzhihua\articles\behaviors\UserBehavior $userId user who had logined identity
 */
class ArticleTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return (Yii::$app->controller->module->tableName)['article_tag'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
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
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            // 添加数据时允许接受的字段
            'insert' => [
                'name',
                'description',
                'created_by',
            ],
            // 更新数据时允许接受的字段
            'update' => [
                'name',
                'description',
                'created_by',
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
            'description' => Yii::t('articles', 'Description'),
            'created_by' => Yii::t('articles', 'Created By'),
            'created_at' => Yii::t('articles', 'Created At'),
            'updated_at' => Yii::t('articles', 'Updated At'),
        ]);
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
