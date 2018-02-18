<?php

namespace hzhihua\articles\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hzhihua\articles\models\Article;
use hzhihua\articles\behaviors\UserBehavior;

/**
 * ArticleSearch represents the model behind the search form of `hzhihua\articles\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'is_top', 'status', 'public_time', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'content'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        $query->where(['created_by' => $this->userId]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_top' => $this->is_top,
            'status_id' => $this->status,
            'public_time' => $this->public_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
